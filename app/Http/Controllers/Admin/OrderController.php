<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tblfee;
use App\Models\Tblregisterrequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    protected static $qualactions = [
        "icon:eye | tip:View Certificate |color:blue | click:window.open('/certs/{pdf}','_blank')",
    ];

    //view order by its id
    public function index(int $orderid)
    {
        $order = Tblregisterrequest::where('id', $orderid)->first();
        $fees = Tblfee::where(['regclass' => $order->engclass, 'regdegree' => $order->engdegree])
            ->select('amount')->first();

        return view('vieworder', ['order' => $order, 'fees' => $fees,
            'qualactions' => OrderController::$qualactions, 'errors' => collect([])]);
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

        return redirect()->back()->with('success', 'Order has been rejected');
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
        if (! empty($errors)) {
            return view('vieworder', ['order' => $order,
                'qualactions' => OrderController::$qualactions,
                'inspectResult' => $errors, 'fees' => 0.0])->with('error', 'Inspection found problems in the order');
        }

        return redirect()->back()->with('success', 'Order has been inspected, everything is good');
    }

    public function payOrder($request)
    {
        return redirect()->back()->with('success', 'Payment has been made');
    }

    public function mailRegistrant($request)
    {
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
