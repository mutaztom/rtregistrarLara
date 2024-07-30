<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\Tblregistrant;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        $dat=Tblregistrant::where('id',Auth()->user()->regid)->get()->first();
        $param=RegRequestController::lockups();
        //dd($dat);
        return view('profile.edit', $param,['user'=>Auth()->user(),'registrant'=>$dat]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());
        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }
        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    public function updatereginfo(ProfileUpdateRequest $request): RedirectResponse
    {
        //write data to tblregistrant
        $profile=new Tblregistrant();
       $request->merge(['regname'=>$request->get('name')]);
        $profile->where('id',Auth()->user()->regid)->update($request->except(['_token','_method','name']));
        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }
    
}
