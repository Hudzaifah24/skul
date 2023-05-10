<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Fossil;
use App\Models\Student;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    use ApiResponser;

    public function index()
    {
        $student = Student::findOrFail(Auth::user()->id);

        return $this->success($student, 'Success');
    }

    public function indexFossil()
    {
        $fossil = Fossil::where('student_id', Auth::user()->id)->with(['student'])->get();

        return $this->success($fossil, 'Success');
    }
}
