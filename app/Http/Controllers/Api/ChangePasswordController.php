<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ChangePasswordController extends Controller
{
    use ApiResponser;

    public function change(Request $req)
    {
        $auth = Auth::user()->id;

        $student = Student::findOrFail($auth);

        if ($req->newpassword && $req->oldpassword) {
            $hashedPassword = $student->password;
            if (Hash::check($req->oldpassword, $hashedPassword)) {
                if (!Hash::check($req->newpassword, $hashedPassword)) {
                    $data['password'] = Hash::make($req->newpassword);

                    $student->update($data);
                } else {
                    return back()->with('message', 'Kata sandi baru tidak bisa jadi kata sandi lama!');
                }
            } else {
                return back()->with('message', 'Kata sandi lama tidak cocok');
            }
        }

        return $this->success($student, 'Password berhasil diubah');
    }
}
