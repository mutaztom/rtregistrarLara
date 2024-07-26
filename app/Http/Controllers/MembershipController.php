<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class MembershipController extends Controller
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
    public function create(Request $request)
    {
        //write form data to database Tblregmembership
        DB::table('tblregmemberships')->insert(['socityid'=>$request->get('society'),
        'memtype'=>$request->get('membertype'),'regid'=>Auth()->user()->regid,
        'ondate'=>$request->get('membersince'),]);
        
        return redirect()->route('regorder')
        ->with('success', 'Membership saved successfully!');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //update database Tblregmembership
        DB::table('tblregmemberships')->where('id', $id)
        ->insert(['socityid'=>$request->get('society'),
        'memtype'=>$request->get('membertype'),'ondate'=>$request->get('membersince')])->execute();
        return redirect()->route('regorder')
        ->with(['success', 'Membership updated successfully!','showmempan'=>false]);
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
        DB::table('tblregmemberships')->where('id', $id)
        ->update(['socityid'=>$request->get('society'),
        'memtype'=>$request->get('membertype'),'ondate'=>$request->get('membersince')]);
        return redirect()->route('regorder')
        ->with('success', 'Membership updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        //destroy data from database Tblregmembership
        DB::table('tblregmemberships')->where('id', $id)->delete();
        return redirect()->route('regorder')
        ->with('success', 'Membership deleted successfully!');
    }
}
