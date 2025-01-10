<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use App\Models\User;

class CustomLoginController extends Controller
{
    public function customShowLoginForm()
    {
        return view('custom-login');
    }

    public function customShowLinkForm()
    {
        return view('custom-show-link-form');
    }

    public function customShowResetForm(Request $request, $token)
    {
        $email = $request->query('email');

        return view('custom-password-reset', ['email'=> $email, 'token'=> $token]);
    }

    public function customPasswordUpdate(Request $request)
    {
        //  dd($request);
         $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed',
            'password_confirmation' => 'required',
        ]);

        $status = Password::reset($request->only('email', 'password', 'password_confirmation', 'token'), function(User $user, $password) {

            $user->forceFill([
                'password' => Hash::make($password),

            ])->setRememberToken(Str::random(40));

            $user->save();
        });

        if($status === Password::PASSWORD_RESET)
        {
            return redirect()->route('custom.login')->with(['status' => __($status)]);
        }else{
            return back()->withErrors(['email' => __($status)]);
        }
    }

    public function customReset(Request $request)
    {
        $request->validate([
            'email' => 'required|email'
        ]);

        $status = Password::sendResetLink($request->only('email'));

        if($status === Password::RESET_LINK_SENT)
        {
            return back()->with(['status'=> __($status)]);
        }else{
            return back()->withErrors(['email'=> __($status)]);
        }
    }

    public function customLogin(Request $request)
    {

        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        if(Auth::attempt(['email'=> $request->email, 'password'=> $request->password ], $request->remember));
        {
            return redirect()->route('admin.posts.index');
        }

        return redirect()->route('custom.login');
    }

    public function customLogout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('custom.login');
    }
}
