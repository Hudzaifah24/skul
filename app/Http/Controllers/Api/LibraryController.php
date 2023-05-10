<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Loan;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LibraryController extends Controller
{
    use ApiResponser;

    public function index()
    {
        $loans = Loan::where('student_id', Auth::user()->id)->where('status', 'not yet')->with('student')->get();

        return $this->success($loans, 'Success');
    }
}
