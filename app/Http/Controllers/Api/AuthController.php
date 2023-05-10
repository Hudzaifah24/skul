<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    use ApiResponser;

    public function login(Request $request)
    {
        // return $this->error('Mohon isi NIS dan Password');

        $validator = Validator::make($request->all(), [
            'nisn' => 'required',
            'password' => 'required',
        ]);

        if ($validator->fails()) {

        //pass validator errors as errors object for ajax response
            return $this->error('Mohon isi NISN dan Password');
        }

        $student = Student::where('nisn', $request->nisn)->with(['clas', 'studentClass'])->first();

        if (!$student) {
            return $this->error('NISN tidak terdaftar', $request->all());
        }

        if (Hash::check($request->password, $student->password)) {
            $data = [
                'token' => $student->createToken('token-auth')->plainTextToken,
                'token_type' => 'Bearer',
                'student_data' => $student,
            ];

            return $this->success($data, 'Login success');
        } else {
            return $this->error('Password salah');
        }
    }

    public function logout()
    {
        $user = Auth::user()->tokens()->delete();

        return $this->success($user, 'Logout success');
    }
}
