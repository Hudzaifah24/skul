<?php

namespace App\Http\Controllers;

use App\Http\Requests\SppRequest;
use App\Models\Clas;
use App\Models\Period;
use App\Models\SPP;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SppController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->month) {
            $spps = SPP::where('month', 'like', $request->month)->get();
        } else {
            $spps = SPP::all();
        }

        $classes = Clas::all();

        $periods = Period::all();

        return view('pages.spp.index', [
            'month' => $request->month,
            'spps' => $spps,
            'classes' => $classes,
            'periods' => $periods,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SppRequest $request)
    {
        $data = $request->all();

        $data['user_id'] = Auth::user()->id;

        SPP::create($data);

        return redirect()->route('spp.index')->with('notification-success-add', '');
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SPP  $sPP
     * @return \Illuminate\Http\Response
     */
    public function update(SppRequest $request, $id)
    {
        $data = $request->all();

        $spp = SPP::findOrFail($id);

        $spp->update($data);

        return redirect()->route('spp.index')->with('notification-success-edit', '');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SPP  $sPP
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $spp = SPP::findOrFail($id);

        $spp->delete();

        return redirect()->route('spp.index')->with('notification-success-delete', '');
    }
}
