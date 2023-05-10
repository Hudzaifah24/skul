<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Bank;
use App\Models\SPP;
use App\Models\SppPayment;
use App\Models\StudentClass;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SppController extends Controller
{
    use ApiResponser;

    public function index()
    {
        $studentClass = StudentClass::where('student_id', Auth::user()->id)->first();

        $spps = SPP::with(['class', 'user'])->where('class_id', $studentClass->class_id)->get();

        return $this->success($spps, 'Success');
    }

    public function detail()
    {
        $auth = Auth::user()->id;

        $sppPayment = SppPayment::with(['spp', 'bank', 'student'])->where('student_id', $auth)->get();

        return $this->success($sppPayment, 'Success');
    }

    public function SppPayment(Request $request)
    {
        $data = $request->all();

        $month = $data['month'];

        $spp = SPP::where('month', $month)->first();

        $payments = SppPayment::where('spp_id', $spp->id)->where('student_id', Auth::user()->id)->get();

        if ($payments->count() != 0) {
            foreach ($payments as $payment) {
                $array[] = $payment->amount;
            }

            $value = array_sum($array);
        } else {
            $value = null;
        }

        $data['student_id'] = Auth::user()->id;

        // $request->validate([
        //     'proof' => 'required|mimes:png,jpg,gif,jpeg'
        // ], [
        //     'proof.required' => 'Bukti harus diisi',
        //     'proof.mimes' => 'Bukti harus diisi dengan gambar',
        // ]);

        $createBank = [
            'name_bank' => $request->name_bank,
            'account_number' => $request->account_number,
            'nasabah' => $request->nasabah,
            'student_id' => Auth::user()->id,
        ];

        if ($request->name_bank != NULL) {
            $bankId = Bank::create($createBank);
        } else {
            $bankId = NULL;
        }

        if ($request->amount >= $spp->amount || $value + $request->amount == $spp->amount) {
            $status = 'lunas';
        } elseif ($request->amount < $spp->amount) {
            $status = 'belum lunas';
        }

        if ($request->file('proof')) {
            $proof = time().'.'.$request->file('proof')->getClientOriginalExtension();

            $request->file('proof')->move(public_path('bukti'), $proof);
        }

        $createPayment = [
            'status' => $status,
            'amount' => $request->amount,
            'proof' => $request->proof,
            'student_id' => $request->student_id,
            'bank_id' => $bankId != NULL ? $bankId->id : NULL,
            'spp_id' => $spp->id,
            'student_id' => Auth::user()->id,
        ];

        $result = SppPayment::create($createPayment);

        $sppPayment = SppPayment::with(['bank', 'spp', 'student'])->findOrFail($result->id);

        return $this->success($sppPayment, $bankId != NULL ? 'Berhasil Bayar dengan nama bank: '.$bankId->name_bank.', sebesar: Rp '.number_format($request->amount) : 'Berhasil Bayar dengan Jumlah sebesar: Rp '.number_format($request->amount));
    }
}
