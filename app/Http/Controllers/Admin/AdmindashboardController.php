<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class AdmindashboardController extends Controller
{
    //
    public function index()
    {
        $neworders = DB::table('tblregisterrequest')->where('status', 'Requested')->count();
        $processing = DB::table('tblregisterrequest')->where('status', 'Processing')->count();
        $rejected = DB::table('tblregisterrequest')->where('status', 'Rejected')->count();
        $done = DB::table('tblregisterrequest')->where('status', 'Approved')->count();
        $totalfees = DB::table('tblpayment')->sum('amount');
        $lastorders = DB::table('vwregisterrequest')->orderby('id', 'desc')->limit(7)->get();
        $recentorders = DB::table('vwregisterrequest')->where('status', 'Approved')->orderby('id', 'desc')->limit(7)->get();
        $payments = DB::table('tblpayment')->where('paid', true)->orderby('id', 'desc')->limit(7)->get();

        return view('admin.admindashboard', compact('rejected', 'processing', 'neworders',
            'totalfees', 'done', 'lastorders', 'recentorders','payments'));
    }
}
