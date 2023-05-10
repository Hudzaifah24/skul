<?php

namespace App\Http\Controllers;

use App\Http\Requests\BillRequest;
use App\Models\Bill;
use App\Models\BillClas;
use App\Models\Clas;
use App\Models\Period;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class BillController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->class) {
            if ($request->class != 'all') {
                $filter = Clas::findOrFail($request->class);
                $bills = Bill::whereHas('billClass', function(Builder $query){
                    $query->where('class_id', request('class'));
                })->get();
            } elseif ($request->class == 'all') {
                $filter = 'all';
                $bills = Bill::doesntHave('billClass')->get();
            }
        } else {
            $filter = NULL;
            $bills = Bill::all();
        }

        $classes = Clas::all();

        $periods = Period::orderBy('year_start', 'asc')->get();

        return view('pages.bill.index', [
            'bills' => $bills,
            'classes' => $classes,
            'periods' => $periods,
            'filter' => $filter,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BillRequest $request)
    {
        $data = $request->all();

        $bill_id = Bill::create($data)->id;

        if ($request->class_id != 'all') {
            $billClass = [
                'bill_id' => $bill_id,
                'class_id' => $data['class_id'],
                'period_id' => $data['period_id'],
            ];

            BillClas::create($billClass);
        }

        return redirect()->route('bill.index')->with('notification-success-add', '');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Bill  $bill
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $bill = Bill::findOrFail($id);

        return view('pages.bill.index', [
            'bill' => $bill
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Bill  $bill
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();

        $bill = Bill::findOrFail($id);

        if ($request->class_id || $request->period_id) {
            if ($request->class_id != 'all') {
                if ($bill->billClass != NULL) {
                    $bill->billClass()->update([
                        'class_id' => $data['class_id'],
                        'period_id' => $data['period_id'],
                    ]);
                } else {
                    BillClas::create([
                        'bill_id' => $id,
                        'class_id' => $data['class_id'],
                        'period_id' => $data['period_id'],
                    ]);
                }
            } else {
                $bill->billClass()->delete();
            }
        }

        $bill->update($data);

        return redirect()->route('bill.index')->with('notification-success-edit', '');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Bill  $bill
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $bill = Bill::findOrFail($id);

        $bill->delete();

        return redirect()->route('bill.index')->with('notification-success-delete', '');
    }
}
