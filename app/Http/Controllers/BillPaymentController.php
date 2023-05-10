<?php

namespace App\Http\Controllers;

use App\Http\Requests\BillPaymentRequest;
use App\Models\Bank;
use App\Models\Bill;
use App\Models\BillPayment;
use App\Models\Student;
use Illuminate\Http\Request;

class BillPaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bills = Bill::doesntHave('billClass')->get();

        $students = Student::all();

        return view('pages.bill_payment_general.index', [
            'bills' => $bills,
            'students' => $students,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BillPayment  $billPayment
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $bill = Bill::findOrFail($id);

        $lunas = BillPayment::where('status', 'lunas')->where('bill_id', $id)->get();

        $cicil = BillPayment::where('status', 'belum lunas')->where('bill_id', $id)->get();

        $belum = Student::all();

        return view('pages.bill_payment_general.detail', [
            'lunas' => $lunas,
            'cicil' => $cicil,
            'belum' => $belum,
            'bill' => $bill,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BillPayment  $billPayment
     * @return \Illuminate\Http\Response
     */
    public function update(BillPaymentRequest $request, $id)
    {
        $data = $request->all();

        $data['bill_id'] = $id;

        $bill = Bill::findOrFail($id);

        $payments = BillPayment::where('bill_id', $id)->where('student_id', $request->student_id)->get();

        $lunas = BillPayment::orderBy('id', 'desc')->where('bill_id', $id)->where('student_id', $request->student_id)->first();

        if ($lunas != NULL) {
            if ($lunas->status == 'lunas') {
                return back()->with('notification-success-lunas', '');
            }
        }

        if ($payments->count() != 0) {
            foreach ($payments as $payment) {
                $array[] = $payment->amount;
            }

            $value = array_sum($array);
        } else {
            $value = null;
        }

        if ($request->amount >= $bill->sum || $value + $request->amount == $bill->sum) {
            $status = 'lunas';
            // for ($i=0; $i < count($payments); $i++) {
            //     $pay = SppPayment::where('spp_id', $sppId)->update(['status'=>$status]);
            // }
        } elseif ($request->amount < $bill->sum) {
            $status = 'belum lunas';
        }

        if ($request->file('proof')) {
            $proof = time().'.'.$request->file('proof')->getClientOriginalExtension();

            $request->file('proof')->move(public_path('bukti/tagihan'), $proof);
        }

        $createPayment = [
            'status' => $status,
            'amount' => $data['amount'],
            'proof' => $proof,
            'student_id' => $data['student_id'],
            'bank_id' => NULL,
            'bill_id' => $id,
        ];

        BillPayment::create($createPayment);

        return redirect()->route('billPaymentGeneral.show', $id)->with('notification-success-pay', '');
    }
}
