<?php

namespace App\Http\Controllers;

use App\Http\Requests\PeriodRequest;
use App\Models\Period;
use Illuminate\Http\Request;

class PeriodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $periods = Period::all();

        return view('pages.period.index', [
            'periods' => $periods
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\PeriodRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PeriodRequest $request)
    {
        $data = $request->all();

        $period = Period::create($data);

        return redirect()->route('period.index')->with('notification-success-add', '');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\PeriodRequest  $request
     * @param  \App\Models\Period  $period
     * @return \Illuminate\Http\Response
     */
    public function update(PeriodRequest $request, $id)
    {
        $data = $request->all();

        $period = Period::findOrFail($id);

        $period->update($data);

        return redirect()->route('period.index')->with('notification-success-edit', '');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Period  $period
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $period = Period::findOrFail($id);

        $period->delete();

        return redirect()->route('period.index')->with('notification-success-delete', '');
    }

    // Edit Active Or Not Active

    public function isActive(Request $request, $id)
    {
        $period = Period::findOrFail($id);

        if ($request->status == 'active') {
            $period->update([
                'status' => 'Active'
            ]);
        } else{
            $period->update([
                'status' => 'Not active'
            ]);
        }

        return redirect()->route('period.index')->with('notification-success-'.$request->status, '');
    }
}
