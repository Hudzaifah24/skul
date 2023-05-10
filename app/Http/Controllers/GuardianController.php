<?php

namespace App\Http\Controllers;

use App\Http\Requests\GuardianRequest;
use App\Models\Guardian;
use Illuminate\Http\Request;

class GuardianController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GuardianRequest $request)
    {
        $data = $request->all();

        $id = $request->student_id;

        Guardian::create($data);

        return redirect()->route('student.show',$id.'guardians')->with('notification-success-add', '');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Guardian  $guardian
     * @return \Illuminate\Http\Response
     */
    public function update(GuardianRequest $request, $id)
    {
        $data = $request->all();

        $guardians = Guardian::findOrFail($id);

        $guardians->update($data);

        return redirect()->route('student.show',$guardians->student_id.'guardians')->with('notification-success-edit', '');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Guardian  $guardian
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $guardians = Guardian::findOrFail($id);

        $guardians->delete();

        return redirect()->route('student.show',$guardians->student_id.'guardians')->with('notification-success-delete', '');
    }
}
