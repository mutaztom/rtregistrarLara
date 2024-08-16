<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tblregisterrequest;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ApprovalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(int $orderid)
    {
        $order = Tblregisterrequest::find($orderid);
        $order->approvalDate = $order->approvalDate ? $order->approvalDate : Carbon::now();
        $order->meetingdate = $order->meetingdate ? $order->meetingdate : Carbon::now();
        $order->paid = true;
        return view('approval', compact('order'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, int $orderid)
    {
        $validated = $request->validate(
            [
                'meetingno' => 'required',
                'meetingdate' => 'required',
                // 'approval' => 'required',
                'engcouncilNumber' => 'required',
                'approvalDate' => 'required',
                'decision' => 'required',
                'committeecomment' => 'required',
            ]);

        $order = Tblregisterrequest::find($orderid);

        $request->merge(['status' => $request->get('approval') ? 'Approved' : 'Rejected',
            'rpin' => rand(1000000000, 1000000000000000).'-'.$orderid,
        ]);
        $order->where('id', $orderid)
            ->update($request->except(['_token', '_csrf', '_method', 'approval']));

        return redirect()->route('regrequest.view', ['orderid' => $orderid])->with('success', 'Order has been approved');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
