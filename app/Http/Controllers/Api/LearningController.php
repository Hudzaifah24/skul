<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Learning;
use App\Models\StudentClass;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LearningController extends Controller
{
    use ApiResponser;

    public function index()
    {
        $studentClass = StudentClass::where('student_id', Auth::user()->id)->first();

        $learnings = Learning::where('class_id', $studentClass->class_id)->get();

        return $this->success($learnings, 'Success');
    }
}
