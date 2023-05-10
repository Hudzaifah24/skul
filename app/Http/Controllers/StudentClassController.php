<?php

namespace App\Http\Controllers;

use App\Http\Requests\StudentClasRequest;
use App\Http\Requests\StudentClassRequest;
use App\Models\Clas;
use App\Models\Period;
use App\Models\Presence;
use App\Models\Student;
use App\Models\StudentClass;
use Illuminate\Http\Request;

class StudentClassController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $classes = Clas::all();

        $students = Student::doesntHave('studentClass')->get();

        $periods = Period::all();

        return view('pages.student_class.index', [
            'classes' => $classes,
            'students' => $students,
            'periods' => $periods,
        ]);
    }

    public function show(Request $request, $id)
    {
        if ($request->period) {
            $studentClasses = StudentClass::where('class_id', $id)->where('period_id', $request->period)->get();
        } else {
            $studentClasses = StudentClass::where('class_id', $id)->get();
        }

        $filter = $request->period;

        $class = Clas::findOrFail($id);

        $students = Student::doesntHave('studentClass')->get();

        $periods = Period::all();

        return view('pages.student_class.detail', [
            'studentClasses' => $studentClasses,
            'class' => $class,
            'students' => $students,
            'periods' => $periods,
            'filter' => $filter,
            'id' => $id,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StudentClasRequest $request)
    {
        for ($i=0; $i < count($request->student_id); $i++) {
            $data = [
                'period_id' => $request->period_id,
                'class_id' => $request->class_id,
                'student_id' => $request->student_id[$i]
            ];

            Presence::create([
                'student_id' => $request->student_id[$i],
            ]);

            StudentClass::create($data);
        }

        return redirect()->route('studentClass.show', $request->class_id)->with('notification-success-add', '');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\StudentClass  $studentClass
     * @return \Illuminate\Http\Response
     */
    public function update(StudentClasRequest $request, $id)
    {
        $data = $request->all();

        $studentClass = StudentClass::findOrFail($id);

        $studentClass->update($data);

        return redirect()->route('studentClass.show', $request->class_id)->with('notification-success-edit', '');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\StudentClass  $studentClass
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $studentClass = StudentClass::findOrFail($id);

        $studentClass->delete();

        return redirect()->route('studentClass.show', $studentClass->clas->id)->with('notification-success-delete', '');
    }
}
