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
        $dat=Tblregistrant::where('id',866)->get()->first();
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
        //write data to tblregistrant
        $profile=new Tblregistrant();
        $profile->regid = $request->user()->regid;
        $profile->nationality=$request->get('nationality');
        $profile->city=$request->get('city');
        $profile->phone=$request->get('phone');
        $profile->email=$request->get('email');
        $profile->address=$request->get('address');
        $profile->birthdate=$request->get('birthdate');
        $profile->gender=$request->get('gender');
        $profile->socityMember=$request->get('socityMember');
        $profile->mobile=$request->get('mobile');
        $profile->hieducid=$request->get('hieducid');
        $profile->birthplace=$request->get('birthplace');
        $profile->workplace=$request->get('workplace');
        $profile->job=$request->get('job');
        $profile->higheducid=$request->get('higheducid');
        $profile->workaddress=$request->get('workaddress');
        $profile->specialization=$request->get('specialization');
        $profile->engsociety=$request->get('engsociety');
        $profile->save();
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
}
