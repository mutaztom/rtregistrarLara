<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tblregisterrequest;
use Illuminate\Support\Facades\Validators;

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
                'ecnumber' => 'required',
                'approval_date' => 'required',
                'commitesecretary' => 'required',
            ]);
        
        $order = Tblregisterrequest::find($orderid);
        $order->where('id', $orderid)
            ->update($request->except(['_token','_csrf','_method']));

        return redirect()->route('order.view', ['orderid' => $order->id])->with('success', 'Order has been approved');

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
