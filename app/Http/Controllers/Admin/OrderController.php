<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ProfileController;
use App\Mail\CustomMail;
use App\Mail\RejctOrderMail;
use App\Models\Tblfee;
use App\Models\Tblpayment;
use App\Models\Tblregisterrequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\Mime\Email;

class OrderController extends Controller
{
    protected static $qualactions = [
        "icon:eye | tip:View Certificate |color:blue | click:window.open('/certs/{pdf}','_blank')",
    ];

    //view order by its id
    public function index(String $orderid)
    {
        $order = Tblregisterrequest::where('id', $orderid)->first();
        $fees = Tblfee::where(['regclass' => $order->engclass, 'regdegree' => $order->engdegree])
            ->select('amount')->first();
        $comp = ProfileController::calculateProfile($order->registrant);

        return view('vieworder', ['order' => $order, 'fees' => $fees,
            'qualactions' => OrderController::$qualactions, 'comp' => $comp, 'errors' => collect([])]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('vieworder'); //,['order'=>$order]);
    }

    public function deleteOrder()
    {
        Tblregisterrequest::where('id', $request())->get('orderid')->delete();

        return redirect()->back()->with('success', 'Order has been deleted successfully');
    }

    public function rejectOrder(Request $request)
    {
        Validator::make($request->all(), [
            'orderid' => 'required',
            'reject_reason' => 'required',
        ])->validate();
        Tblregisterrequest::where('id', $request->get('orderid'))
            ->update(['status' => 'Rejected',
                'rejectreason' => $request->get('reject_reason'), ]);
        //send order rejected email
        $order = Tblregisterrequest::find($request->get('orderid'));
        //send rejected order email to registrant
        Mail::to($order->registrant->email)->send(new RejctOrderMail($order));

        return redirect()->back()->with('success', 'Order has been rejected, Registrant was notified.');
    }

    public function approveOrder(Request $request, int $orderid)
    {
        // Tblregisterrequest::where('id', $request->get('orderid'))
        // ->update(['status'=>'Processing']);
        // return redirect()->back()->with('success', 'Order has been approved');
        $order = Tblregisterrequest::find($orderid);
        return view('approval', ['order' => $order]);
    }

    public function inspectOrder(int $orderid)
    {
        $errors = collect([]);
        $order = Tblregisterrequest::find($orderid);
        $qualactions = OrderController::$qualactions;
        $fees = Tblfee::where(['regclass' => $order->regclass,
            'regdegree' => $order->regdegree])->select('amount')->first() ?: 0.0;
        //check if registrant has qualifications
        $errors = OrderController::checkOrder($orderid);
        $comp = ProfileController::calculateProfile($order->registrant);
        if (! empty($errors)) {
            return view('vieworder', ['order' => $order,
                'qualactions' => OrderController::$qualactions, 'comp' => $comp,
                'inspectResult' => $errors, 'fees' => 0.0])->with('error', 'Inspection found problems in the order');
        }

        return redirect()->back()->with('success', 'Order has been inspected, everything is good');
    }

    public function payOrder(Request $request, int $orderid): RedirectResponse
    {
        $order = Tblregisterrequest::find($orderid);
        $fees = DB::table('tblfee')->
        where(['engclass' => $order->engclass, 'regdegree' => $order->regdegree]);
        Validator::make($request->all(), [
            'amount' => 'required|min:$fees',
            'receipt' => 'required',
            'type' => 'required',
            'amount' => 'required|numeric',
        ])->validate();
        $request->merge(['item' => 'Payment of order '.$orderid, 'paid' => true]);
        Tblpayment::updateOrCreate($request->except(['_token', '_method']))
            ->where('orderid', '=', $orderid);
        //if payment saved successfully update order payment status
        Tblregisterrequest::where('id', $orderid)->update(['status' => 'Paid']);
        $order->where('id', '=', $orderid)->update(['payed' => true]);
        //send email notification to registrant informing about order payment
        Mail::to($order->registrant->email)->
        send(new CustomMail('Your order has been paid, you will soon recieve commitee decission. \n regards', $order->registrant->name, 'Payment Confirmation'));
        return redirect()->route('regrequest.view', ['orderid' => $orderid])->with('success',
         'Payment has been made. registrant has been notified');
    }

    public function mailRegistrant(Request $request)
    {
        $id = $request->input('orderid');
        $order = Tblregisterrequest::findOrfail($id);
        $text = $request->input('email_message');
        Mail::to($order->registrant->email)->send(new CustomMail($text, $order->registrant->name, $request->input('subject')));

        return redirect()->back()->with('success', 'Email has been sent to registrant');
    }

    protected function checkOrder(int $orderid)
    {
        $errors = collect([]);
        $order = Tblregisterrequest::find($orderid);
        if ($order->registrant->qualifications()->count() == 0) {
            $errors->put('Qualifcation Missing', "Registrant didn't provide his qualifications");
        }
        //check all attached pdf for qualifications if missing
        foreach ($order->registrant->qualifications as $qual) {
            if ($qual->pdf == null) {
                $errors->put('Certificate Missing', "Registrant didn't provide his certificate for qualification type: ".$qua->item);
            } else {
                if (! Storage::disk('public')->exists('certs/'.$qual->pdf)) {
                    $errors->put('Missing PDF attachment', "Registrant didn't provide his PDF attachment for qualification type: ".$qual->item);
                }
            }
        }
        //check if registrant has memberships
        if ($order->registrant->memberships()->count() == 0) {
            $errors->put('Membership Missing', "Registrant didn't provide his memberships");
        }
        if ($order->registrant->specialization == null || $order->registrant->specialization <= 0) {
            $errors->put('Specialization Missing', "Registrant didn't provide his specialization");
        }
        //check registratin degree and registration class
        if ($order->regcat == null || $order->regcat <= 0) {
            $errors->put('Registration Degree Missing', "Registrant didn't provide his registration degree");
        }
        if ($order->regclass == null || $order->regclass <= 0) {
            $errors->put('Registration Class Missing', "Registrant didn't provide his registration class");
        }
        //check if order has payment and status is pending
        if ($order->payment == null || $order->status != 'pending') {
            $errors->put('Payment Missing', 'Order has no payment or payment status is not pending');
        }

        return $errors;
    }
}
