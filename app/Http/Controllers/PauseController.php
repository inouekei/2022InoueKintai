<?php

namespace App\Http\Controllers;

use App\Models\Pause;
use Illuminate\Http\Request;
use App\Http\Requests\PauseRequest;
use Illuminate\Support\Facades\Auth;

use DateTime;

class PauseController extends Controller
{
    public function create()
    {
        $user = Auth::user();
        $currentStatus = $user->currentStatus();
        if ($currentStatus['pause_id']) {
            return response()->json([
                'message' => 'Already on Pause'
            ], 400);
        } else {
            $attendance_id = $currentStatus['attendance_id'];
            $start_time = new DateTime();

            Pause::create([
                'attendance_id' => $attendance_id,
                'start_time' => $start_time,
            ]);
            return redirect('/');
        }
    }
    public function update(PauseRequest $request, $id)
    // public function update(Request $request, $id)
    {
        $item = Pause::where('id', $id)->get()[0];
        if ($request['mode'] === 'PauseOff') {
            $end_time = new DateTime();
            $item->end_time = $end_time;
        }
        Pause::where('id', $id)->update([
            'attendance_id' => $item->attendance_id,
            'start_time' => $item->start_time,
            'end_time' => $item->end_time,
        ]);
        return redirect('/');
    }
}
