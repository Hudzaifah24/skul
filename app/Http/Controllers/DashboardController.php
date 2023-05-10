<?php

namespace App\Http\Controllers;

use App\Models\Clas;
use App\Models\Student;
use App\Models\User;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $students = Student::count();

        $teachers = User::where('role', 'Teacher')->count();

        $classes = Clas::count();

        $users = User::where('role', 'Admin')->count();

        return view('pages.dashboard', [
            'students' => $students,
            'teachers' => $teachers,
            'classes' => $classes,
            'users' => $users,
        ]);
    }

}
