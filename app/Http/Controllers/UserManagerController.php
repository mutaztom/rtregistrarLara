<?php

namespace App\Http\Controllers;

use App\Models\Staffuser;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

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
        $request->merge(['password' => Hash::make($request->get('password'))]);
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
    public function edit(Request $request)
    {
        //update user password in database
        $validator = Validator::make($request->input(),
            [
                'name' => ['required',
                    Rule::unique('staffuser')->ignore($request->get('userid'), 'id')],
                'email' => ['required', Rule::unique('staffuser')->ignore($request->get('userid'))],
            ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        Staffuser::where('id', $request->get('userid'))
            ->update(['name' => $request->get('name'),
                'email' => $request->get('email'), ]);

        return redirect()->route('usermanager')->with('success', 'User updated successfully');
    }

    /**
     * Update the specified resource in storage.
     */
    public function updatePassword(Request $request)
    {
        //update user in database, and not to update password
        $request->validate([
            'password' => 'required|string|min:8|confirmed',
        ]);
        Staffuser::where('id', $request->get('userid'))
            ->update([
                'password' => Hash::make($request->get('password')),
            ]);

        return redirect()->route('usermanager')->with('success', 'User updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        if (staffuser::all()->count() == 1) {
            return redirect()->route('usermanager')->with('error', 'Cannot delete the last admin user');
        }
        staffuser::where('id', $request->get('userid'))->delete($request->get('userid'));

        return redirect()->route('usermanager')->with('success', 'User deleted successfully');
    }

    public function updatePhoto(Request $request)
    {
        if (! $request->hasFile('userphoto')) {
            return redirect()->back()->with('error', 'No photo was selected');
        }
        $userid = $request->get('photo_userid');
        $staff = Staffuser::find($userid);
        $fname = $staff->name.'.'.$request->file('userphoto')->extension();
        Storage::putFileAs('public/photos/', $request->file('userphoto'), $fname);
        $staff->photo = $fname;
        $staff->save();

        return redirect()->back()->with('success', 'Photo updated successfully');
    }
}
