<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tblregisterrequest;
class OrderController extends Controller
{
    //
    public function index(){
        return view('vieworder');
    }
    
    public function deleteOrder(){
        Tblregisterrequest::where('id',$request()->get('orderid'))->delete();
        return redirect()->back()->with('success', 'Order has been deleted successfully');
    }
    public function modifyOrder($request){
        return redirect()->back()->with('success', 'Order has been modified');
    }
}
