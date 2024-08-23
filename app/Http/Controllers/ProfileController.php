<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Tblregistrant;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        $dat = Tblregistrant::where('id', Auth()->user()->id)->get()->first();
        $param = RegRequestController::lockups();
        $profilecompletion = $this->calculateProfile($dat);

        //dd($dat);
        return view('profile.edit', $param, ['user' => Auth()->user(), 'registrant' => $dat, 'profcomp' => $profilecompletion]);
    }

    public function viewProfile(Request $request, int $regid): View
    {
        $registrant = Tblregistrant::find($regid);

        return view('ProfileView', compact('registrant'));
    }

    public static function calculateProfile(Tblregistrant $profile): int
    {
        //add your logic here to calculate profile completion percentage
        //for example, assuming you have 5 fields in tblregistrant table
        $percomp = 0;
        $qual = round((DB::table('tblqualification')->where('empid', $profile->id)->count()));
        //insure at leaset one academic qualification
        $academic = round((DB::table('tblqualification')->where(['empid' => $profile->id, 'qualtype' => 'AcademicDegree'])->count()));
        $memb = round((DB::table('tblregmemberships')->where('regid', $profile->id)->count()));
        $profile->nationality !== null;

        //check for all empty fields in reg
        $percomp = ($qual >= 1 ? 20 : 0) + ($memb >= 1 ? 20 : 0)
        + ($profile->nationality != null ? 10 : 0)
        + ($profile->birthdate != null ? 10 : 0)
        + ($academic >= 1 ? 10 : 0)
        + ($profile->idnumber ? 10 : 0);
        +($profile->city ? 10 : 0)
        + ($profile->photoFile ? 10 : 0);

        return $percomp;
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
        $profile = new Tblregistrant;
        $request->merge(['regname' => $request->get('name')]);
        $profile->where('id', Auth()->user()->id)->update($request->except(['_token', '_method', 'name']));

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }
}
