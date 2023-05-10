<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\BillClas;
use App\Models\BillPayment;
use App\Models\StudentClass;
use App\Traits\ApiResponser;
use Illuminate\Support\Facades\Auth;

class BillClassController extends Controller
{
    use ApiResponser;

    public function userId()
    {
        return Auth::user()->id;
    }

    public function index()
    {
        $studentClass = StudentClass::where('student_id', $this->userId())->first();

        $billClass = BillClas::with(['class', 'bill', 'period'])->where('class_id', $studentClass->class_id)->get();

        return $this->success($billClass, 'Success');
    }

    public function detail()
    {
        $studentClass = StudentClass::where('student_id', $this->userId())->first();

        $billPayments = BillPayment::with(['bill', 'bank', 'student'])->where('student_id', $this->userId())->get();

        return $this->success($billPayments, 'Success');
    }
}
