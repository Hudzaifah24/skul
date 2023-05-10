<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Presence;
use App\Models\PresenceDetail;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PresenceController extends Controller
{
    use ApiResponser;

    public function index()
    {
        $presences = Presence::where('student_id', Auth::user()->id)->with(['student'])->first();

        return $this->success($presences, 'Success');
    }

    public function index2()
    {
        $presences = Presence::where('student_id', Auth::user()->id)->with(['student'])->first();

        $presenceDetail = PresenceDetail::where('presence_id', $presences->id)->with(['presence', 'learning'])->get();

        return $this->success($presenceDetail, 'Success');
    }
}
