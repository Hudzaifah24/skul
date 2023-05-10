<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClasRequest;
use App\Models\Clas;
use App\Models\Period;
use App\Models\Student;
use App\Models\StudentClass;
use Illuminate\Http\Request;

class ClasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (!$request->period) {
            $request->period = Period::orderBy('year_end', 'desc')->first()->id;
        }

        $classDetail = StudentClass::where('period_id', $request->period)->get();

        $filter = $request->period;

        $classes = Clas::all();

        $periods = Period::all();

        return view('pages.class.index', [
            'classes' => $classes,
            'periods' => $periods,
            'classDetail' => $classDetail,
            'filter' => $filter,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\ClasRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ClasRequest $request)
    {
        $data = $request->all();

        Clas::create($data);

        return redirect()->route('class.index')->with('notification-success-add', '');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\ClasRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ClasRequest $request, $id)
    {
        $data = $request->all();

        $class = Clas::findOrFail($id);

        $class->update($data);

        return redirect()->route('class.index')->with('notification-success-edit', '');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $class = Clas::findOrFail($id);

        $class->learning()->delete();

        $class->studentClass()->delete();

        $class->delete();

        return redirect()->route('class.index')->with('notification-success-delete', '');
    }
}
