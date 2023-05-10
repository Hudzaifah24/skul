<?php

namespace App\Http\Controllers;

use App\Http\Requests\PresenceRequest;
use App\Models\Clas;
use App\Models\Learning;
use App\Models\Presence;
use App\Models\PresenceDetail;
use App\Models\Student;
use App\Models\StudentClass;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class PresenceController extends Controller
{
    public function index()
    {
        $presences = Presence::all();

        $students = Student::all();

        if (Auth::user()->role == 'Admin') {
            $classes = Clas::all();
        } else {
            $classes = Clas::whereHas('learning', function(Builder $query){
                $query->where('day', date('N'))->where('user_id', Auth::user()->id);
            })->get();
        }

        return view('pages.presences.index', [
            'presences' => $presences,
            'students' => $students,
            'classes' => $classes,
        ]);
    }

    public function show($id)
    {
        $class = Clas::findOrFail($id);

        $studentClasses = StudentClass::where('class_id', $id)->get();

        $presenceDetail = PresenceDetail::OrderBy('id', 'desc')->first();

        $learnings = Learning::orderBy('order', 'asc')->where('class_id', $id)->where('day', date('N'))->get();

        return view('pages.presences.detail', [
            'class' => $class,
            'learnings' => $learnings,
            'presenceDetail' => $presenceDetail,
            'studentClasses' => $studentClasses,
        ]);
    }

    public function update(PresenceRequest $request, $id)
    {
        $data = $request->all();

        $presence = Presence::findOrFail($id);

        $presence->update($data);

        return redirect()->route('presence.index')->with('notification-success-edit', '');
    }

    public function destroy($id)
    {
        $presence = Presence::findOrFail($id);

        $presence->presenceDetail()->delete();

        $presence->delete();

        return redirect()->route('presence.index')->with('notification-success-delete', '');
    }
}
