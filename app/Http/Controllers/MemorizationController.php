<?php

namespace App\Http\Controllers;

use App\Http\Requests\MemorizationRequest;
use App\Models\Clas;
use App\Models\Memorization;
use App\Models\Period;
use App\Models\Student;
use App\Models\StudentClass;
use App\Models\User;
use Illuminate\Http\Request;

class MemorizationController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $students = Student::with('fossil','guardian')->find($id);

        $memorizations = Memorization::where('student_id', $id)->get();

        $teachers = User::where('role', 'Teacher')->get();

        return view('pages.student.detail',[
            'students' => $students,
            'teachers' => $teachers,
            'memorizations' => $memorizations,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\MemorizationRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MemorizationRequest $request)
    {
        $data = $request->all();

        $id = $request->student_id;

        $data['student_id'] = $id;

        $student = Student::findOrFail($id);

        Memorization::create($data);

        return redirect()->route('student.show',$id.'hafalan')->with('notification-success-add', '');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\MemorizationRequest  $request
     * @param  \App\Models\Memorization  $memorization
     * @return \Illuminate\Http\Response
     */
    public function update(MemorizationRequest $request, $id)
    {
        $data = $request->all();

        $memo = Memorization::findOrFail($id);

        $student = Student::findOrFail($memo->student_id);

        $memo->update($data);

        return redirect()->route('student.show',$student->id.'hafalan')->with('notification-success-edit', '');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Memorization  $memorization
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $memo = Memorization::findOrFail($id);

        $student = Student::find($memo->student_id);

        $memo->delete();

        return redirect()->route('student.show',$student->id.'hafalan')->with('notification-success-delete', '');
    }

    public function change(Request $req, $id)
    {
        $req->validate([
            'memorization_juz' => 'max:30|integer',
            'memorization_page' => 'max:114|integer',
        ], [
            'memorization_juz.max' => 'Al-quran hanya memiliki 30 Juz',
            'memorization_page.max' => 'Al-quran hanya memiliki 114 Page',
        ]);

        $data = $req->all();

        $student = Student::findOrFail($id);

        $student->update($data);

        return redirect()->route('student.show', $id.'hafalan')->with('notification-success-edit', '');
    }
}
