<?php

namespace App\Http\Controllers;

use App\Http\Requests\FossilRequest;
use App\Models\Fossil;
use App\Models\Guardian;
use Illuminate\Http\Request;

class FossilController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FossilRequest $request)
    {
        $data = $request->all();
        $id = $request->student_id;
        Fossil::create($data);

        return redirect()->route('student.show',$id.'orangTua')->with('notification-success-add', '');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Fossil  $fossil
     * @return \Illuminate\Http\Response
     */
    public function update(FossilRequest $request,$id)
    {
        $fossils = Fossil::with('student')->find($id);
        $student = $fossils->student->id;
        $data = $request->all();
        $fossils->update($data);
        return redirect()->route('student.show',$student.'orangTua')->with('notification-success-edit', '');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Fossil  $fossil
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $fossil = Fossil::findOrFail($id);

        $guardian = Guardian::where('student_id', $fossil->student_id)->first();

        if (!$guardian->error) {
            if ($guardian->relationship == $fossil->status) {
                $guardian->delete();
            }
        }

        $fossil->delete();

        return redirect()->route('student.show',$fossil->student_id.'orangTua')->with('notification-success-delete', '');
    }

    public function change(Request $req, $id)
    {
        $fossil = Fossil::findOrFail($id);

        if ($req->status == 'Ayah') {
            $relationship = 'Ayah';
        } elseif ($req) {
            $relationship = 'Ibu';
        }

        Guardian::create([
            'name' => $fossil->name,
            'relationship' => $relationship,
            'work' => $fossil->work,
            'phone_number' => $fossil->phone_number,
            'religion' => $fossil->religion,
            'education' => $fossil->education,
            'student_id' => $fossil->student_id,
        ]);

        return redirect()->route('student.show', $fossil->student_id.'guardians')->with('notification-success-add', '');
    }
}
