<?php

namespace App\Http\Controllers;

use App\Models\Tblcity;
use App\Models\Tblengclass;
use App\Models\Tblengdegree;
use App\Models\Tblidcardtype;
use App\Models\Tbljob;
use App\Models\Tblmembership;
use App\Models\Tblnationality;
use App\Models\Tblqualdegree;
use App\Models\Tblqualification;
use App\Models\Tblqualtype;
use App\Models\Tblregisterrequest;
use App\Models\Tblregmembership;
use App\Models\Tblsociety;
use App\Models\Tblspecialization;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class RegRequestController extends Controller
{
    public static function lockups(): array
    {
        $cities = Tblcity::select('id', 'item')->get();
        $nationalities = Tblnationality::select('id', 'item')->get();
        $countries = Tblnationality::select('id', 'item')->get();
        $engclass = Tblengclass::select('id', 'item')->get();
        $jobs = Tbljob::select('id', 'item')->get();
        $idtypes = Tblidcardtype::select('id', 'item')->get();
        $engdegree = Tblengdegree::select('id', 'item')->get();
        $membership = Tblmembership::select('id', 'item')->get();
        $qualification = Tblqualification::where('empid', 866)->get();
        $qualtype = Tblqualtype::select('id', 'item')->get();
        $qualdegree = Tblqualdegree::select('id', 'item')->get();
        $societies = Tblsociety::select('id', 'item')->get();
        $specialization = Tblspecialization::select('id', 'item')->get();
        $loarray = ['cities' => $cities,
            'nationalities' => $nationalities,
            'countries' => $countries,
            'jobs' => $jobs,
            'engclass' => $engclass,
            'engdegree' => $engdegree,
            'idtypes' => $idtypes,
            'title' => 'regform',
            'qualification' => $qualification,
            'qualtype' => $qualtype,
            'qualdegree' => $qualdegree,
            'membership' => $membership,
            'startdate' => Carbon::now(),
            'enddate' => Carbon::now(),
            'societies' => $societies,
            'specialization' => $specialization,
            'membertype' => DB::table('tblmemberships')->select('id', 'item')->get(),
            'memberships' => Tblregmembership::where('regid', Auth()->user()->regid)->get(),
            'entity' => 'University',
        ];

        return $loarray;
    }

    public function registerrequest(Request $request)
    {

        //process form data
        $param = RegRequestController::lockups();
        $order = new TblregisterRequest;
        $order->ownerid = Auth()->user()->regid;
        $param['order'] = $order;

        return view('regorder', $param);
    }

    public static function fees(int $orderid): float
    {
        $reg = DB::table('tblregisterrequest')->select('regclass', 'regcat')
            ->where('id', $orderid)->get();
        $fees = DB::table('tblfees')->select('amount')->where(['regclass' => $reg->regclass,
            'regdegree' => $reg->regcat])->first();

        return $fees ?: 0.0;
    }

    public function saveorder(Request $request)
    {
        $command = $request->get('command');
        if ($command == 'saveorder') {
            //save data to databas
            $orderid = $request->get('orderid');
            if ($orderid > 0) {
                DB::table('tblregisterrequest')->where('id', $orderid)->update($request->except(['_crsrf', '_method', '_token', 'command', 'orderid']));
            } else {
                $request->merge(['ownerid' => Auth()->user()->regid]);
                $request->merge(['ondate' => Carbon::now()]);
                //generate rpin
                $request->merge(['status' => 'Requested'])
                    ->merge(['item' => 'New order request']);
                DB::table('tblregisterrequest')->insert($request->except(['_crsrf', '_method', '_token', 'command', 'orderid']));
                $regid = DB::table('tblregisterrequest')->where('ownerid', Auth()->user()->regid)->get()->last()->id;
                //update rpin for the new id
                DB::table('tblregisterrequest')->where('id', $regid)->update(['rpin' => rand(1000000000, 1000000000000000).'-'.$regid]);
            }

            return redirect()->route('order.modify', ['orderid' => $orderid])->with('success', 'Request order saved successfully!');
        } elseif ($command == 'close') {
            return redirect()->route('order.list');
        } elseif (str_starts_with($command, 'deletequal')) {
            $qualid = explode('_', $command)[1];
            $this->deletequalification($request->get('qualid'));

            //return redirect()->back()->with('success', 'Qualification deleted successfully!');
            return redirect()->back();
        } elseif (str_starts_with($command, 'uploadcert')) {
            $qualid = explode('_', $command)[1];
            //upload certificate of registrant
            if ($request->hasfile('certificate')) {
                $ext = $request->file('certificate')->getClientOriginalExtension();
                $fname = 'certificate_'.str($qualid).'.'.$ext;
                if ($ext != 'pdf') {
                    return redirect()->back()->with('error', 'Only PDF files are allowed!');
                }
                $path = $request->file('certificate')->storeAs('public/certs', $fname);
                $qual = new Tblqualification;
                if ($qualid > 0) {
                    Tblqualification::where($qualid)->update(['pdf' => $fname]);
                } else {
                    //if saving new qualification
                    $qid = $this->saveQualification($request);
                    $fname = 'certificate_'.$qid.'.'.$ext;
                    Tblqualification::where('id', $qid)->update(['pdf' => $fname]);
                }

                return redirect()->route('regorder')->with('success', 'Certificate pdf uploaded successfully!');
            } else {
                return redirect()->route('regorder')->with('error', 'No file selected!');
            }
            //upload photo of registrant
        } elseif (str_starts_with($command, 'viewqual')) {
            $qualid = explode('_', $command)[1];
            $qual = Tblqualification::find($qualid);

            return $this->registerrequest($request);
        } elseif (str_starts_with($command, 'deletequal')) {
            $qualid = explode('_', $command)[1];
            $this->deletequalification($request->get('qualid'));

            return redirect()->back()->with('success', 'Qualification deleted successfully!');
        } elseif ($command == 'uploadphoto') {
            return $this->uploadphoto($request);
        } elseif ($command == 'createmembership') {
            $mm = new MembershipController;

            return $mm->create($request);
        } elseif (str_starts_with($command, 'updatemembership')) {
            $id = explode('_', $command)[1];
            $mm = new MembershipController;

            return $mm->update($request, $id);
        } elseif (str_starts_with($command, 'removemembership')) {
            $id = explode('_', $command)[1];
            $mm = new MembershipController;

            return $mm->destroy($id);
        }
    }

    public function deletequalification($id)
    {
        //delete data from database
        $q = Tblqualification::find($id);
        error_log("delete qualification: $id");
        //if($q){
        $q->delete();
        //}
    }

    public function orderList(Request $request): View
    {
        $regid = Auth()->user()->regid;
        $icons = [
            "icon:pencil | tip:edit order | color:green | click:window.open('/modifyorder/'+{id},'_self')",
            'icon:trash | tip:delete order | color:red | click:confirmDelete({id})',
        ];
        $engcouncilid = Auth()->user()->registrant->engcouncilid ?: 'None!';
        $orders = DB::table('vwregisterrequest')->where('ownerid', $regid)
            ->select('id', 'item', 'engclass', 'engdegree', 'ondate', 'status', 'payed')->get();

        return view('myorders', compact('orders', 'icons', 'engcouncilid'));
    }

    public function modifyOrder(Request $request, $orderid)
    {
        $order = DB::table('tblregisterrequest')->where('id', $orderid)->first();
        $param = RegRequestController::lockups();
        $param['order'] = $order;

        return view('regorder', $param);
    }

    public function destroy(Request $request, int $orderid)
    {
        DB::table('tblregisterrequest')->where('id', $orderid)->delete();

        return redirect()->route('order.list')->with('success', 'Order deleted successfully!');
    }
}
