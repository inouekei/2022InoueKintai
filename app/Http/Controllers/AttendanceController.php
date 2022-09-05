<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Attendance;
use App\Models\Pause;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Carbon\Carbon;
// use Illuminate\Pagination\LengthAwarePaginator;

class AttendanceController extends Controller
{
    public function index(Request $request)
    {
        $currentDate = Carbon::today();
        if (isset($request['targetDate'])) {
            if ($request['targetDate'] != null) {
                $targetDateStr = $request['targetDate'];
                $tempTargetDate = Carbon::parse($targetDateStr);
                if ($currentDate->copy()->diffInDays($tempTargetDate) > 0) {
                    $targetDate = $tempTargetDate;
                    $nextDate = $targetDate->copy()->addDays(1);
                    $nextDateStr =
                        $nextDate->format('Y-m-d');
                }
            } else return redirect('/attendance');
        }
        if (!isset($targetDate)) {
            $targetDate = $currentDate;
            $targetDateStr =
                $targetDate->format('Y-m-d');
            $nextDateStr = null;
        }
        $previousDate = $targetDate->copy()->subDays(1);
        $previousDateStr = $previousDate->format('Y-m-d');

        $attendanceList = User::Paginate(5);
        foreach ($attendanceList as $attendanceRow) {
            $attendance = $attendanceRow->attendanceByDate($targetDateStr);
            unset($attendanceRow['id']);
            unset($attendanceRow['email']);
            unset($attendanceRow['password']);
            unset($attendanceRow['created_at']);
            unset($attendanceRow['updated_at']);
            unset($attendanceRow['email_verified_at']);
            unset($attendanceRow['remember_token']);
            if ($attendance) {
                $attendanceOnStr = $attendance->attendanceDispStr()['attendanceOnStr'];
                $attendanceOffStr = $attendance->attendanceDispStr()['attendanceOffStr'];
                $totalPauseStr = $attendance->attendanceDispStr()['totalPauseStr'];
                $attendanceTimeStr = $attendance->attendanceDispStr()['attendanceTimeStr'];
            } else {
                $attendanceOnStr = "入力なし";
                $attendanceOffStr = "入力なし";
                $totalPauseStr = "入力なし";
                $attendanceTimeStr = "入力なし";
            }
            $attendanceRow['attendanceOnStr'] = $attendanceOnStr;
            $attendanceRow['attendanceOffStr'] = $attendanceOffStr;
            $attendanceRow['totalPauseStr'] = $totalPauseStr;
            $attendanceRow['attendanceTimeStr'] = $attendanceTimeStr;
            // $attendanceRow = [
            //     'name' => $attendanceRow['name'],
            //     'attendanceOnStr' => $attendanceOnStr,
            //     'attendanceOffStr' => $attendanceOffStr,
            //     'totalPauseStr' => $totalPauseStr,
            //     'attendanceTimeStr' => $attendanceTimeStr
            // ];
        }
        return view('attendance', [
            'targetDateStr' => $targetDateStr,
            'previousDateStr' => $previousDateStr,
            'nextDateStr' => $nextDateStr,
            'attendanceList' => $attendanceList,
        ]);
    }
    public function add()
    {
        $user = Auth::user();
        $currentStatus = $user->currentStatus();
        return view(
            'index',
            $currentStatus
        );
    }
    public function create()
    {
        $user = Auth::user();
        $currentAttendance = $user->currentStatus();
        if ($currentAttendance['attendance_id']) {
            return response()->json([
                'message' => 'Already on Attendance'
            ], 400);
        } else {
            $user_id = $user->id;
            $start_time = Carbon::now();

            Attendance::create([
                'user_id' => $user_id,
                'start_time' => $start_time,
            ]);
            return redirect('/');
        }
    }
    public function update(Request $request, $id)
    {
        $item = Attendance::where('id', $id)->get()[0];
        if ($request['mode'] === 'AttendanceOff') {
            $end_time = Carbon::now();
            $item->end_time = $end_time;
        }
        Attendance::where('id', $id)->update([
            'user_id' => $item->user_id,
            'start_time' => $item->start_time,
            'end_time' => $item->end_time,
        ]);
        return redirect('/');
    }
}
