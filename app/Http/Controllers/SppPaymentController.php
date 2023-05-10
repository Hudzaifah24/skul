<?php

namespace App\Http\Controllers;

use App\Http\Requests\SppPaymentRequest;
use App\Models\Clas;
use App\Models\Period;
use App\Models\SPP;
use App\Models\SppPayment;
use App\Models\Student;
use App\Models\StudentClass;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class SppPaymentController extends Controller
{
    public function index(Request $request)
    {
        if ($request->month) {
            $spps = SPP::where('month', $request->month)->get();
        } else {
            $spps = SPP::all();
        }

        $students = StudentClass::get();

        return view('pages.spp_payment.index', [
            'month' => $request->month,
            'spps' => $spps,
            'students' => $students,
        ]);
    }

    public function show($id)
    {
        $lunas = SppPayment::where('spp_id', $id)->where('status', 'lunas')->get();

        $cicil = SppPayment::where('spp_id', $id)->where('status', 'belum lunas')->get();

        $spp = SPP::findOrFail($id);

        $class = Clas::findOrFail($spp->class_id);

        $belum = StudentClass::where('class_id', $class->id)->get();

        return view('pages.spp_payment.detail', [
            'lunas' => $lunas,
            'cicil' => $cicil,
            'belum' => $belum,
            'class' => $class,
            'spp' => $spp,
        ]);
    }

    public function update(SppPaymentRequest $request, $id)
    {
        $sppId = $id;

        $spp = SPP::findOrFail($id);

        $payments = SppPayment::where('spp_id', $sppId)->where('student_id', $request->student_id)->get();

        $lunas = SppPayment::orderBy('id', 'desc')->where('spp_id', $sppId)->where('student_id', $request->student_id)->first();

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

        // dd($value + $request->amount);

        if ($request->amount >= $spp->amount || $value + $request->amount == $spp->amount) {
            $status = 'lunas';
        } elseif ($request->amount < $spp->amount) {
            $status = 'belum lunas';
        }

        if ($request->file('proof')) {
            $proof = time().'.'.$request->file('proof')->getClientOriginalExtension();

            $request->file('proof')->move(public_path('bukti/spp'), $proof);
        }

        $createPayment = [
            'status' => $status,
            'amount' => $request->amount,
            'proof' => $proof,
            'student_id' => $request->student_id,
            'spp_id' => $sppId,
        ];

        SppPayment::create($createPayment);

        return redirect()->route('spppayment.show', $sppId)->with('notification-success-pay', '');
    }

    public function destroy($id)
    {
        //
    }
}
