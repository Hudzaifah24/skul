<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ResetPasswordController extends Controller
{
    public function index()
    {
        return view('pages.reset_password.reset');
    }

    public function update(Request $req, $id)
    {
        $user = User::findOrFail($id);

        if ($req->password == 1234) {
            return back()->with('failed', 'Ganti Password harus selain dari "1234"');
        }

        $user->update([
            'password' => Hash::make($req->password),
        ]);

        return redirect()->route('dashboard')->with('notification-success-gantiPassword', 'Berhasil Mengganti Password');
    }
}
