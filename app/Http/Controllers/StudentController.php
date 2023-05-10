<?php

namespace App\Http\Controllers;

use App\Exports\StudentClassExport;
use App\Exports\StudentExport;
use App\Exports\TemplateExport;
use App\Http\Requests\StudentRequest;
use App\Imports\StudentImport;
use App\Models\Clas;
use App\Models\Fossil;
use App\Models\Guardian;
use App\Models\Memorization;
use App\Models\Period;
use App\Models\Student;
use App\Models\StudentClass;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;

class StudentController extends Controller
{
    public function export()
    {
        return Excel::download(new StudentExport, 'students.xlsx');
    }

    public function exportIdClass($id)
    {
        $class = Clas::findOrFail($id);

        return Excel::download(new StudentClassExport($id), date('d-m-Y').'-'.$class->name.'.xlsx');
    }

    public function template()
    {
        return Excel::download(new TemplateExport, 'template.xlsx');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,csv,xls'
        ], [
            'file.required' => 'File harus diisi',
            'file.mimes' => 'File harus diisi dengan type file xlsx, csv atau xls',
        ]);

        // $name = time().'.'.$request->file('file')->getClientOriginalExtension();

        // $request->file->move(public_path('data_murid'), $name);

        Excel::import(new StudentImport, $request->file);

        return redirect()->back()->with('notification-success-import', '');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->class) {
            if ($request->class == 'all') {
                $filter = 'all';
                $clas = NULL;
                $students = Student::get();
            } else {
                $filter = $request->class;
                $clas = Clas::findOrFail($request->class);
                $students = StudentClass::where('class_id', $request->class)->get();
            }
        } else {
            $filter = 'all';
            $clas = NULL;
            $students = Student::get();
        }

        $periods = Period::all();

        $classes = Clas::all();

        return view('pages.student.index',[
            'students' => $students,
            'clas' => $clas,
            'periods' => $periods,
            'classes' => $classes,
            'filter' => $filter,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StudentRequest $request)
    {
        $data = $request->all();

        $data['password'] = Hash::make(1234);

        Student::create($data);

        if ($request->class_id != 'all') {
            $class = Clas::findOrFail($request->class_id);
            return redirect()->route('student.index', 'class='.$class->id)->with('notification-success-add', '');
        } else {
            return redirect()->route('student.index')->with('notification-success-add', '');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $students = Student::with('fossil','guardian')->find($id);

        $fossils = Fossil::where('student_id', $id)->get();

        $ayah = Fossil::where('student_id', $id)->where('status', 'Ayah')->first();

        $ibu = Fossil::where('student_id', $id)->where('status', 'Ibu')->first();

        $teachers = User::where('role', 'Teacher')->get();

        $studentClass = StudentClass::where('student_id', $id)->first();

        $memorizations = Memorization::where('student_id', $id)->get();

        $guardian = Guardian::where('student_id', $id)->first();

        return view('pages.student.detail',[
            'students' => $students,
            'studentClass' => $studentClass,
            'fossils' => $fossils,
            'ayah' => $ayah,
            'ibu' => $ibu,
            'teachers' => $teachers,
            'memorizations' => $memorizations,
            'guardian' => $guardian
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(StudentRequest $request, $id)
    {
        $data = $request->all();

        $request->validate([
            'nik' => 'required|min:16|max:16|unique:students,nik,'.$id,
        ], [
            'nik.unique' => 'NIK sudah terpakai',
        ]);

        $students = Student::find($id);

        $studentClass = StudentClass::where('student_id', $id)->first();

        if (!empty($request->password)) {
            $data['password'] = Hash::make($request->password);
        } else {
            $data['password'] = $students->password;
        }

        $studentClass->update([
            'period_id' => $request->period_id,
        ]);

        $students->update($data);

        return redirect()->route('student.index', 'class='.$request->class_id)->with('notification-success-edit', '');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $students = Student::findOrFail($id);

        $studentClass = StudentClass::where('student_id', $id)->first();

        $students->studentClass()->delete();

        $students->delete();

        return redirect()->route('student.index', 'class='.$studentClass->class_id)->with('notification-success-delete', '');
    }

    public function reset($id)
    {
        $student = Student::findOrFail($id);

        $data = [
            'password' => Hash::make('1234'),
        ];

        $student->update($data);

        return redirect()->route('student.index')->with('notification-success-reset', '');
    }
}
