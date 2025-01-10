<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class CustomRegistrationController extends Controller
{

    public function __construct()
    {
        $this->middleware('guest');
    }

    public function customRegister(Request $request)
    {
        // dd($request);
        $request->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'required',
            'password' => 'required',
            'password_confirmation' => 'required',
        ]);

        // dd($request->only('email'));
        $inputs = $request->only('firstname', 'lastname', 'email', 'password', 'password_confirmation');
        $user = User::create($inputs);
        Auth::login($user);

       return redirect()->route('post.index');
    }
}
