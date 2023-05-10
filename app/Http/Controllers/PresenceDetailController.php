<?php

namespace App\Http\Controllers;

use App\Http\Requests\PresenceDetailRequest;
use App\Models\Presence;
use App\Models\PresenceDetail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PresenceDetailController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        if ($request->learning == NULL) {
            return back()->with('failed-learning', '');
        } else {
            foreach ($data['status'] as $index => $status) {
                $presence = Presence::where('student_id', $index)->first();
                if ($presence) {
                    if ($status != 'hadir') {
                        $pre = [
                            'permission_count' => $presence->permission_count,
                            'sick_count' => $presence->sick_count,
                            'alpha_count' => $presence->alpha_count,
                        ];

                        if ($status=="permission") {
                            $pre['permission_count'] = $presence->permission_count + 1;
                        } elseif ($status=="sick") {
                            $pre['sick_count'] = $presence->sick_count + 1;
                        } else {
                            $pre['alpha_count'] = $presence->alpha_count + 1;
                        }

                        $presence->update([
                            'permission_count' => $pre['permission_count'],
                            'sick_count' => $pre['sick_count'],
                            'alpha_count' => $pre['alpha_count'],
                        ]);

                        PresenceDetail::create([
                            'presence_id' => $presence->id,
                            'user_id' => Auth::user()->id,
                            'learning_id' => $request->learning,
                            'status' => $status,
                            'reason' => $data['reason'][$index],
                            'date' => Carbon::now()
                        ]);
                    }
                }
            }
        }

        return redirect()->route('attendance.index', 'class='.$request->class)->with('notification-success-add', '');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PresenceDetail  $presenceDetail
     * @return \Illuminate\Http\Response
     */
    public function update(PresenceDetailRequest $request, $id)
    {
        $data = $request->all();

        $presenceDetail = PresenceDetail::findOrFail($id);

        $presenceDetail->update($data);
        $presence = $presenceDetail->presence();

        if ($request->status=='permission') {
            $request->validate([
                'reason' => 'required|max:255',
            ], [
                'reason.required' => 'Alasan harus diisi',
                'reason.max' => 'Alasan tidak boleh lebih dari 255 huruf',
            ]);
        }

        // Updating Table presences (Reduce count)
        if ($request->status!=$presenceDetail->status) {
            if ($presenceDetail->status=="permission") {
                $data = ['permission_count' => $presence->permission_count - 1];
            } if ($presenceDetail->status=="sick") {
                $data = ['sick_count' => $presence->sick_count - 1];
            } else {
                $data = ['alpha_count' => $presence->alpha_count - 1];
            }
        }

        if ($request->status == 'permission') {
            return redirect()->route('presence.show', $request->presence_id)->with('notification-success-edit', '');
        } elseif($request->status == 'sick'){
            return redirect()->route('presence.show', $request->presence_id.'sick')->with('notification-success-edit', '');
        } else {
            return redirect()->route('presence.show', $request->presence_id.'alpha')->with('notification-success-edit', '');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PresenceDetail  $presenceDetail
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $presenceDetail = PresenceDetail::findOrFail($id);

        $presence = Presence::findOrFail($presenceDetail->presence->id);

        $data = [
            'permission_count',
            'sick_count',
            'alpha_count',
        ];

        if ($presenceDetail->status=="permission") {
            $data['permission_count'] = $presence->permission_count - 1;
        } elseif ($presenceDetail->status=="sick") {
            $data['sick_count'] = $presence->sick_count - 1;
        } else {
            $data['alpha_count'] = $presence->alpha_count - 1;
        }

        $presence->update($data);

        $presenceDetail->delete();

        if ($presenceDetail->status == 'permission') {
            return redirect()->route('presence.show', $presence->id)->with('notification-success-delete', '');
        } elseif($presenceDetail->status == 'sick'){
            return redirect()->route('presence.show', $presence->id.'sick')->with('notification-success-delete', '');
        } else {
            return redirect()->route('presence.show', $presence->id.'alpha')->with('notification-success-delete', '');
        }

    }
}
