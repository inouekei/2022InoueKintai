<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Attendance;
use Illuminate\Http\Request;
use App\Http\Requests\AttendanceRequest;
use App\Http\Requests\AttendanceListRequest;
use Illuminate\Support\Facades\Auth;

use Carbon\Carbon;
use Illuminate\Pagination\LengthAwarePaginator;

class AttendanceController extends Controller
{
    public function index(AttendanceListRequest $request)
    {
        $currentDate = Carbon::today();
        if (isset($request['targetDate'])) {
            if ($request['targetDate'] == null) {
                return redirect('/attendance');
            } else {
                $targetDateStr = $request['targetDate'];
                $tempTargetDate = Carbon::parse($targetDateStr);
                if ($currentDate->copy()->diffInDays($tempTargetDate) > 0) {
                    $targetDate = $tempTargetDate;
                    $nextDate = $targetDate->copy()->addDays(1);
                    $nextDateStr =
                        $nextDate->format('Y-m-d');
                }
            }
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

        $users = User::All();
        $attendanceArr = [];
        foreach ($users as $user) {
            $attendanceRow = [];
            $attendanceRow['name'] = $user['name'];

            $attendance = $user->attendanceByDate($targetDateStr);
            if ($attendance) {
                $attendanceRow['attendanceOnStr'] = $attendance->attendanceDispStr()['attendanceOnStr'];
                $attendanceRow['attendanceOffStr'] = $attendance->attendanceDispStr()['attendanceOffStr'];
                $attendanceRow['totalPauseStr'] = $attendance->attendanceDispStr()['totalPauseStr'];
                $attendanceRow['attendanceTimeStr'] = $attendance->attendanceDispStr()['attendanceTimeStr'];
            } else {
                $attendanceRow['attendanceOnStr'] = config('const.NO_RECORD');
                $attendanceRow['attendanceOffStr'] = config('const.NO_RECORD');
                $attendanceRow['totalPauseStr'] =  config('const.NO_RECORD');
                $attendanceRow['attendanceTimeStr'] =  config('const.NO_RECORD');
            }
            array_push($attendanceArr, $attendanceRow);
        }
        $attendanceCol = collect($attendanceArr);
        $attendanceList = new LengthAwarePaginator(
            $attendanceCol->forPage($request->page, 5),
            count($attendanceCol),
            5,
            $request->page,
            array('path' => $request->url())
        );
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
    public function update(AttendanceRequest $request, $id)
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

    public function show(Request $request)
    {
        $targetMonths = $this->targetMonths($request);
        $id = $request->id;
        $user = User::find($id);
        $attendanceList = $user->attendanceRowsByMonth($targetMonths['targetMonth']);
        return view(
            'individual',
            [
                'username' => $user->name,
                'id' => $user->id,
                'targetMonthStr' => $targetMonths['targetMonthStr'],
                'previousMonthStr' => $targetMonths['previousMonthStr'],
                'nextMonthStr' => $targetMonths['nextMonthStr'],
                'attendanceList' => $attendanceList,
            ]
        );
    }

    private function targetMonths(Request $request)
    {
        $currentMonth = Carbon::today()->startOfMonth();
        if (isset($request['targetMonth']) && $request['targetMonth'] != null) {
            $targetMonthStr = $request['targetMonth'];
            $tempTargetMonth = Carbon::parse($targetMonthStr . '-01');
            if ($currentMonth->copy()->diffInDays($tempTargetMonth) > 0) {
                $targetMonth = $tempTargetMonth;
                $nextMonthStr = $targetMonth->copy()->addMonthsNoOverflow(1)->format('Y-m');
            }
        }
        if (!isset($targetMonth)) {
            $targetMonth = $currentMonth;
            $targetMonthStr =
                $targetMonth->format('Y-m');
            $nextMonthStr = null;
        }
        $previousMonthStr = $targetMonth->copy()->subMonthsNoOverflow(1)->format('Y-m');
        return [
            'targetMonth' => $targetMonth,
            'targetMonthStr' => $targetMonthStr,
            'nextMonthStr' => $nextMonthStr,
            'previousMonthStr' => $previousMonthStr,
        ];
    }
}
