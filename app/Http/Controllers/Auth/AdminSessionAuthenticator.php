<?php

namespace App\Http\Controllers\Auth;
 
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class AdminSessionAuthenticator extends Controller
{
    public function getLogin(){
        return view('admin.auth.stafflogin');
    }

    public function postLogin(Request $request)
    {
        $validatedData = $request->validate( [
            'name' => 'required|max:255',
            'password' => 'required',
        ]);

        if(auth()->guard('admin')->attempt(['name' => $request->input('name'),  'password' => $request->input('password')])){
            $user = auth()->guard('admin')->user();
            return redirect()->route('inbox')->with('success','You are Logged in sucessfully.');
        }else {
            return back()->with('error','Whoops! invalid username and password.');
        }
    }

    public function adminLogout(Request $request)
    {
        auth()->guard('admin')->logout();
        Session::flush();
        Session::put('success', 'You are logout sucessfully');
        return redirect(route('staff.login'));
    }
}
