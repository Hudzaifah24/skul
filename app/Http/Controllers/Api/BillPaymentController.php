<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Bank;
use App\Models\Bill;
use App\Models\BillPayment;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BillPaymentController extends Controller
{
    use ApiResponser;

    public function billpayment(Request $request)
    {
        $data = $request->all();

        $id = $request->bill_id;

        $data['bill_id'] = $id;

        $bill = Bill::findOrFail($id);

        $payments = BillPayment::where('bill_id', $id)->where('student_id', Auth::user()->id)->get();

        if ($payments->count() != 0) {
            foreach ($payments as $payment) {
                $array[] = $payment->amount;
            }

            $value = array_sum($array);
        } else {
            $value = null;
        }

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

        if ($request->amount >= $bill->sum || $value + $request->amount == $bill->sum) {
            $status = 'lunas';
            for ($i=0; $i < count($payments); $i++) {
                $pay = BillPayment::where('bill_id', $id)->update(['status'=>$status]);
            }
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
            'student_id' => Auth::user()->id,
            'bank_id' => $bankId != NULL ? $bankId->id : NULL,
            'bill_id' => $id,
        ];

        $result = BillPayment::create($createPayment);

        $billPayment = BillPayment::with(['bank', 'bill', 'student'])->findOrFail($result->id);

        return $this->success($billPayment, $bankId != NULL ? 'Berhasil Bayar dengan nama bank: '.$bankId->name_bank.', sebesar: Rp '.number_format($request->amount) : 'Berhasil Bayar dengan Jumlah sebesar: Rp '.number_format($request->amount));
    }
}
