<?php

namespace App\Http\Controllers;

use App\Models\Staffuser;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
class UserManagerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userlist = Staffuser::all();
        $userlist = (($userlist));

        return view('usermanager', compact('userlist'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): RedirectResponse
    {
        $validated = $request->validate(
            [
                'name' => 'required|unique:staffuser|string|max:255',
                'email' => 'required|string|email|max:255|unique:staffuser',
                'password' => 'required|string|min:8|confirmed',
            ]
        );
        $request->mergeIfMissing(['photo' => 'nophoto.png',
            'usertype' => 'admin', 'remember_token' => 'false', 'email_verified_at' => Carbon::now(),
            'status' => 'active', 'ondate' => Carbon::now()]);
        Staffuser::create($request->except(['_token', '_method']));

        return redirect()->route('usermanager')->with('success', 'User created successfully');
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
        staffuser::delete($request->get('userid'));

        return redirect()->route('usermanager')->with('success', 'User deleted successfully');
    }

    public function updatePhoto(Request $request)
    {
        $userid = $request->get('userid');
        $staff = Staffuser::find($userid);
        $fname=$staff->name.'.'.$request->file('userphoto')->extension();
        Storage::putFileAs('public/photos/',$request->file('userphoto'),$fname);
        $staff->photo =$fname;
        $staff->save();

        return redirect()->back()->with('success', 'Photo updated successfully');
    }
}
