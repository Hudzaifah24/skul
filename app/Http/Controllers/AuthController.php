<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function postLogin(Request $request)
    {
        if (Auth::attempt($request->only(['email', 'password']))) {
            $account = User::where('email', $request->email)->first();

            if ($account->role == 'Teacher') {
                if ($request->password != 1234) {
                    Auth::loginUsingId($account->id);
                    return redirect()->route('dashboard')->with('success', 'Anda berhasil login');
                } else {
                    Auth::loginUsingId($account->id);
                    return redirect()->route('password.index')->with('success', 'Anda berhasil login');
                }
            } else {
                return redirect()->route('dashboard');
            }
        } else {
            return back()->with('failed', 'Akun anda belom terdaftar');
        }
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->route('login')->with('logout', '');
    }
}
