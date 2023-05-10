<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdminRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $admin = User::where('role', 'Admin')->get();

        return view('pages.pengguna.index', [
            'admin' => $admin
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\AdminRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdminRequest $request)
    {
        $data = $request->all();

        $request->validate([
            'password' => 'required|max:200'
        ],
        [
            'password.required' => 'Password harus diisi',
            'password.max' => 'Password tidak boleh lebih dari 200 angka dan huruf'
        ]);

        if ($request->password) {
            $data['password'] = Hash::make($request->password);
        }

        $data['role'] = 'Admin';

        User::create($data);

        return redirect()->route('admin.index')->with('notification-success-add', '');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\AdminRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AdminRequest $request, $id)
    {
        $data = $request->all();

        $admin = User::findOrFail($id);

        if ($request->newpassword && $request->oldpassword) {
            $hashedPassword = $admin->password;
            if (Hash::check($request->oldpassword, $hashedPassword)) {
                if (!Hash::check($request->newpassword, $hashedPassword)) {
                    $data['password'] = Hash::make($request->newpassword);

                    $admin->update($data);
                } else {
                    return back()->with('message', 'Kata sandi baru tidak bisa jadi kata sandi lama!');
                }
            } else {
                return back()->with('message', 'Kata sandi lama tidak cocok');
            }
        }

        $admin->update($data);

        if ($request->back) {
            return redirect()->route('dashboard')->with('notification-success-edit', '');
        } else {
            return redirect()->route('admin.index')->with('notification-success-edit', '');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $admin = User::findOrFail($id);

        $admin->delete();

        return redirect()->route('admin.index')->with('notification-success-delete', '');
    }

    public function reset($id)
    {
        $admin = User::findOrFail($id);

        $data = [
            'password' => Hash::make('1234'),
        ];

        $admin->update($data);

        return redirect()->route('admin.index')->with('notification-success-reset', '');
    }
}
