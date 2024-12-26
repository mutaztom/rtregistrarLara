<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Vwregisterrequest;
use Illuminate\Http\Request;
use App\Models\Tblregisterrequest;
class InboxController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //action buttons
        $actionbuttons = [
            "icon:eye |tip:View Order for processing |color:blue | click:window.open('/viewregrequest/'+{id},'_self')",
            'icon:trash |tip:Delete selected order | color:red | click:deleteOrder({id})',

        ];
        //load orders with action buttons
        $neworders = Vwregisterrequest::select()->where('status', 'Requested')
            ->orderBy('id', 'desc')->paginate(10);
        $processing = Vwregisterrequest::select('id', 'item', 'regname', 'engclass', 'engdegree', 'ondate', 'status')
            ->where('status','!=','Requested')->orderBy('id', 'desc')->paginate(10);

        return view('admin.inbox', ['processing' => $processing,
            'actionButtons' => $actionbuttons, 'neworders' => $neworders]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $orders = Tblregisterrequest::all();

        return view('admin.inbox', ['orders' => $orders]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
    public function destroy(Request $request)
    {
        //show request id
        Tblregisterrequest::where('id', $request->get('orderid'))->delete();

        return redirect()->back()->with('success', 'Order has been deleted successfully');
    }
}
