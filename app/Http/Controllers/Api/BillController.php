<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Bank;
use App\Models\Bill;
use App\Models\BillPayment;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BillController extends Controller
{
    use ApiResponser;

    public function index()
    {
        $bills = Bill::get();

        return $this->success($bills, 'Success');
    }

    public function detail()
    {
        $auth = Auth::user()->id;

        $billpayments = BillPayment::with(['bill', 'bank', 'student'])->where('student_id', $auth)->get();

        return $this->success($billpayments, 'Success');
    }
}
