<?php

namespace App\Http\Controllers;

use App\Http\Requests\TeacherRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $teachers = User::where('role', 'Teacher')->get()->sortBy('name');

        return view('pages.guru.index', [
            'teachers' => $teachers
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\TeacherRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TeacherRequest $request)
    {
        $data = $request->all();

        $data['role'] = 'Teacher';

        if ($request->password) {
            $data['password'] = Hash::make('1234');
        }

        User::create($data);

        return redirect()->route('teacher.index')->with('notification-success-add', '');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\TeacherRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TeacherRequest $request, $id)
    {
        $data = $request->all();

        $teacher = User::findOrFail($id);

        if ($request->oldpassword && $request->newpassword) {

            $hashedPassword = Auth::user()->password;

            if (Hash::check($request->oldpassword, $hashedPassword)) {
                if (!Hash::check($request->newpassword, $hashedPassword)) {
                    $data['password'] = Hash::make($request->newpassword);
                } else {
                    return back()->with('message', 'Kata sandi baru tidak bisa jadi kata sandi lama!');
                }
            } else {
                return back()->with('message', 'Kata sandi lama tidak cocok');
            }
        }

        $teacher->update($data);

        return redirect()->route('teacher.index')->with('notification-success-edit', '');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $teacher = User::findOrFail($id);

        $teacher->delete();

        return redirect()->route('teacher.index')->with('notification-success-delete', '');
    }

    public function reset($id)
    {
        $teacher = User::findOrFail($id);

        $data = [
            'password' => Hash::make('1234'),
        ];

        $teacher->update($data);

        return redirect()->route('teacher.index')->with('notification-success-reset', '');
    }
}
