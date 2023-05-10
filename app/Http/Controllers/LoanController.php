<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use App\Http\Requests\LoanRequest;
use App\Models\Student;

class LoanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $loans = Loan::all();

        $students = Student::with('clas')->get();
        // dd($students->toArray());
        return view('pages.library.index', [
            'loans' => $loans,
            'students' => $students
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\LoanRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LoanRequest $request)
    {
        $data = $request->all();

        $request->validate([
                'student_id' => 'required',
            ],
            [
                'student_id.required' => 'Murid harus diisi',
            ]
        );

        Loan::create($data);

        return redirect()->route('loan.index')->with('notification-success-add', '');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\LoanRequest  $request
     * @param  \App\Models\Loan  $loan
     * @return \Illuminate\Http\Response
     */
    public function update(LoanRequest $request, $id)
    {
        $data = $request->all();

        $loan = Loan::findOrFail($id);

        $loan->update($data);

        return redirect()->route('loan.index')->with('notification-success-edit', '');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Loan  $loan
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $loan = Loan::findOrFail($id);

        $loan->delete();

        return redirect()->route('loan.index')->with('notification-success-delete', '');
    }
}
