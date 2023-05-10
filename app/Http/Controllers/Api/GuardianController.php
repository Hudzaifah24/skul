<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Guardian;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GuardianController extends Controller
{
    use ApiResponser;

    public function index()
    {
        $auth = Auth::user()->id;

        $guardian = Guardian::where('student_id', $auth)->with(['student'])->first();

        return $this->success($guardian, 'Success');
    }
}
