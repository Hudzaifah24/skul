<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ResetPasswordMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $user = User::findOrFail(Auth::user()->id);

        if (Auth::user()->role == 'Teacher') {
            if (Hash::check(1234, $user->password) != false) {
                return redirect()->route('password.index');
            } else {
                return $next($request);
            }
        } else {
            return $next($request);
        }
    }
}
