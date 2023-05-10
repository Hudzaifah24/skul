<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Memorization;
use App\Traits\ApiResponser;
use Illuminate\Support\Facades\Auth;

class MemorizationController extends Controller
{
    use ApiResponser;

    public function index()
    {
        $memorizations = Memorization::where('student_id', Auth::user()->id)->with(['teacher', 'student'])->orderBy('date', 'desc')->paginate(15);

        return $this->success($memorizations, 'Success');
    }
}
