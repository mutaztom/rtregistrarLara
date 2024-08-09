<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Tblregisterrequest;
use App\Http\Controllers\Controller; 
use Illuminate\Support\Facades\Storage;

class OrderController extends Controller
{
    //view order by its id
    public function index(int $orderid){
        $qualactions=[
            "icon:eye | tip:View Certificate |color:blue | click:window.open('/certs/{pdf}','_blank')",
            ];
       $order= Tblregisterrequest::where('id',$orderid)->first();
            return view('vieworder',['order'=>$order,'qualactions'=>$qualactions]);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('vieworder');//,['order'=>$order]);
    }
    public function deleteOrder(){
        Tblregisterrequest::where('id',$request())->get('orderid')->delete();
        return redirect()->back()->with('success', 'Order has been deleted successfully');
    }
    public function rejectOrder($request){
        return redirect()->back()->with('success', 'Order has been rejected');
    }
    public function approveOrder($request){
        return redirect()->back()->with('success', 'Order has been approved');
    }

    public function inspectOrder(int $orderid){
        $errors=array();
        //check if registrant has qualifications
        $order=Tblregisterrequest::find($orderid);
        if($order->registrant->qualifications()->count()==0)
            $errors['Qualifcation Missing'] = "Registrant didn't provide his qualifications";
        //check all attached pdf for qualifications if missing
        foreach($order->registrant->qualifications as $qual)
        {
            if($qual->pdf==null)
                $errors['Certificate Missing'] = "Registrant didn't provide his certificate for qualification type: ".$qua->item;
            else
            {
                if(!Storage::disk('public')->exists('certs/'.$qual->pdf))
                $error['Missing PDF attachment'] = "Registrant didn't provide his PDF attachment for qualification type: ".$qual->item;
            }
        }
        $error['Just missing up'] = "Registration missing somethin";
        //check if registrant has memberships
        if($order->registrant->memberships()->count()==0)
            $errors['Membership Missing'] = "Registrant didn't provide his memberships";
        if($order->registrant->specialization==null || $order->registrant->specialization<=0)
            $errors['Specialization Missing'] = "Registrant didn't provide his specialization";
        if(!empty($errors))
            return redirect()->back()->with('error',$errors);
           
        return redirect()->back()->with('success', 'Order has been inspected, everything is good');
    }
    public function payOrder($request){
        return redirect()->back()->with('success', 'Payment has been made');
    }
    public function mailRegistrant($request){
        return redirect()->back()->with('success', 'Email has been sent to registrant');
    }
}
