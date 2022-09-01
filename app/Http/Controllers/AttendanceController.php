<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Attendance;
use App\Models\Pause;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use DateTime;

class AttendanceController extends Controller
{
    public function add()
    {
        $user = Auth::user();
        $currentAttendance = $user->currentAttendance();
        if ($currentAttendance) {
            $currentAttendanceID = $currentAttendance['id'];
            $currentPause = $currentAttendance->currentPause();
            if ($currentPause) {
                $currentPauseID = $currentPause['id'];
            } else $currentPauseID = null;
        } else {
            $currentAttendanceID = null;
            $currentPauseID = null;
        }
        return view('index', [
            'username' => $user->name,
            'currentAttendanceID' => $currentAttendanceID,
            'currentPauseID' => $currentPauseID,
        ]);
    }
    public function create()
    {
        $user = Auth::user();
        $currentAttendance = $user->currentAttendance();
        if ($currentAttendance) {
            return response()->json([
                'message' => 'Already on Attendance'
            ], 400);
        } else {
            $user_id = $user->id;
            $start_time = new DateTime();

            Attendance::create([
                'user_id' => $user_id,
                'start_time' => $start_time,
            ]);
            return redirect('/');
        }
    }
    public function update(Request $request, Attendance $attendance){
        
    }
}
