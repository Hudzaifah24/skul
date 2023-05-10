<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use App\Models\BillClas;
use App\Models\BillPayment;
use App\Models\Clas;
use App\Models\Student;
use App\Models\StudentClass;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class BillClassesController extends Controller
{
    public function index(Request $req)
    {
        if ($req->class) {
            $filter = $req->class;
            $billClasses = BillClas::where('class_id', $req->class)->get();
        } else {
            $filter = NULL;
            $billClasses = BillClas::all();
        }

        $classes = Clas::all();

        return view('pages.bill_payment_class.index', [
            'billClasses' => $billClasses,
            'classes' => $classes,
            'filter' => $filter,
        ]);
    }

    public function show($id)
    {
        $bill = Bill::findOrFail($id);

        $lunas = BillPayment::where('status', 'lunas')->where('bill_id', $id)->get();

        $cicil = BillPayment::where('status', 'belum lunas')->where('bill_id', $id)->get();

        $billClass = BillClas::where('bill_id', $id)->first();

        $belum = StudentClass::where('class_id', $billClass->class_id)->get();

        return view('pages.bill_payment_class.detail', [
            'bill' => $bill,
            'lunas' => $lunas,
            'cicil' => $cicil,
            'belum' => $belum,
        ]);
    }

    public function update(Request $request, $id)
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

        return redirect()->route('billPaymentClass.show', $id)->with('notification-success-pay', '');
    }
}
