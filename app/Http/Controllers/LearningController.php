<?php

namespace App\Http\Controllers;

use App\Http\Requests\LearningRequest;
use App\Models\Learning;
use App\Models\Clas;
use App\Models\Loan;
use App\Models\User;

class LearningController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $classes = Clas::all();

        return view('pages.learning.index', [
            'classes' => $classes
        ]);
    }

    public function show($id)
    {
        $learnings = Learning::orderBy('order', 'asc')->where('class_id', $id)->with('teachers')->get();
        $teachers = User::where('role','teacher')->get();
        $classId = Clas::findOrFail($id);

        // dd($learnings->toArray());
        return view('pages.learning.detail', [
            'learnings' => $learnings,
            'classId' => $classId,
            'teachers' => $teachers,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\LearningRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LearningRequest $request)
    {
        $data = $request->all();

        $class = $request->class_id;

        $learning = Learning::create($data);

        if ($request->day == 1) {
            return redirect()->route('learning.show', $class)->with('notification-success-add', '');
        } elseif ($request->day == 2) {
            return redirect()->route('learning.show', $class.'selasa')->with('notification-success-add', '');
        } elseif ($request->day == 3) {
            return redirect()->route('learning.show', $class.'rabu')->with('notification-success-add', '');
        } elseif ($request->day == 4) {
            return redirect()->route('learning.show', $class.'kamis')->with('notification-success-add', '');
        } elseif ($request->day == 5) {
            return redirect()->route('learning.show', $class.'jumat')->with('notification-success-add', '');
        } elseif ($request->day == 6) {
            return redirect()->route('learning.show', $class.'sabtu')->with('notification-success-add', '');
        } elseif ($request->day == 7) {
            return redirect()->route('learning.show', $class.'ahad')->with('notification-success-add', '');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\LearningRequest  $request
     * @param  \App\Models\Learning  $learning
     * @return \Illuminate\Http\Response
     */
    public function update(LearningRequest $request, $id)
    {
        $data = $request->all();

        $learning = Learning::findOrFail($id);

        $learning->update($data);

        if ($request->day == 1) {
            return redirect()->route('learning.show', $learning->class_id)->with('notification-success-edit', '');
        } elseif ($request->day == 2) {
            return redirect()->route('learning.show', $learning->class_id.'selasa')->with('notification-success-edit', '');
        } elseif ($request->day == 3) {
            return redirect()->route('learning.show', $learning->class_id.'rabu')->with('notification-success-edit', '');
        } elseif ($request->day == 4) {
            return redirect()->route('learning.show', $learning->class_id.'kamis')->with('notification-success-edit', '');
        } elseif ($request->day == 5) {
            return redirect()->route('learning.show', $learning->class_id.'jumat')->with('notification-success-edit', '');
        } elseif ($request->day == 6) {
            return redirect()->route('learning.show', $learning->class_id.'sabtu')->with('notification-success-edit', '');
        } elseif ($request->day == 7) {
            return redirect()->route('learning.show', $learning->class_id.'ahad')->with('notification-success-edit', '');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Learning  $learning
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $learning = Learning::findOrFail($id);

        $id = $learning->class->id;

        $learning->delete();

        if ($learning->day == 1) {
            return redirect()->route('learning.show', $learning->class_id)->with('notification-success-delete', '');
        } elseif ($learning->day == 2) {
            return redirect()->route('learning.show', $learning->class_id.'selasa')->with('notification-success-delete', '');
        } elseif ($learning->day == 3) {
            return redirect()->route('learning.show', $learning->class_id.'rabu')->with('notification-success-delete', '');
        } elseif ($learning->day == 4) {
            return redirect()->route('learning.show', $learning->class_id.'kamis')->with('notification-success-delete', '');
        } elseif ($learning->day == 5) {
            return redirect()->route('learning.show', $learning->class_id.'jumat')->with('notification-success-delete', '');
        } elseif ($learning->day == 6) {
            return redirect()->route('learning.show', $learning->class_id.'sabtu')->with('notification-success-delete', '');
        } elseif ($learning->day == 7) {
            return redirect()->route('learning.show', $learning->class_id.'ahad')->with('notification-success-delete', '');
        }
    }
}
