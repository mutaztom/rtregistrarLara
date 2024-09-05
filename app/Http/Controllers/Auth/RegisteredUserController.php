<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\WelcomeMailer;
use App\Models\Tblregistrant;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        try {
            $request->validate([
                'regname' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.Tblregistrant::class],
                'password' => ['required', 'confirmed', Rules\Password::defaults()],
            ]);

            $user = Tblregistrant::create([
                'regname' => $request->regname,
                'email' => $request->email,
                'pwd' => Hash::make($request->password),
                'remember_token' => 'false',
                'idtype' => -1,
                'idnumber' => '-1',
            ]);
            event(new Registered($user));
            //notify user of registration
            Mail::to($user->email)->send(new WelcomeMailer($user));
            Auth::login($user);
        } catch (Exception $exp) {
            return redirect()->back()->with('error', $exp->getMessage());
        }

        return redirect(route('dashboard', absolute: false));
    }
}
