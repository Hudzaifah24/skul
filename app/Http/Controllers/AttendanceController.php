<?php

namespace App\Http\Controllers;

use App\Models\Clas;
use App\Models\Period;
use App\Models\Presence;
use App\Models\PresenceDetail;
use App\Models\StudentClass;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function index(Request $request)
    {
        if ($request->class) {
            $clas = Clas::findOrFail($request->class);
            $students = StudentClass::where('class_id', $request->class)->get();
        } else {
            $clas = Clas::first();
            $students = StudentClass::where('class_id', $clas->id)->get();
        }

        $presences = Presence::with('student')->get();

        $classes = Clas::all();

        return view('pages.attendance.index',[
            'students' => $students,
            'clas' => $clas,
            'classes' => $classes,
            'presences' => $presences
        ]);
    }

    public function show($id)
    {
        $presenceDetail = PresenceDetail::where('presence_id', $id)->get();

        $presences = Presence::findOrFail($id);

        return view('pages.attendance.detail', [
            'presenceDetail' => $presenceDetail,
            'presences' => $presences,
        ]);
    }
}
