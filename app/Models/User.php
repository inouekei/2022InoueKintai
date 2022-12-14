<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

use Carbon\Carbon;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function currentStatus()
    {
        $attendance_id = null;
        $pause_id = null;
        $disableAttendanceOn = "disabled";
        $disableAttendanceOff = "disabled";
        $disablePauseOn = "disabled";
        $disablePauseOff = "disabled";

        $today_date = Carbon::today();
        $today_date_str = $today_date->format('Y-m-d');
        $todaysAttendance = $this->attendanceByDate($today_date_str);

        if (!$todaysAttendance) {
            $disableAttendanceOn = "";
        } else {
            if ($todaysAttendance['end_time'] === null) {
                $attendance_id = $todaysAttendance->id;
                $disableAttendanceOff = "";

                $currentPause = $todaysAttendance->currentPause();
                if ($currentPause) {
                    $pause_id = $currentPause->id;
                    $disablePauseOff = "";
                } else {
                    $disablePauseOn = "";
                }
            }
        }
        return  [
            'username' => $this->name,
            'attendance_id' => $attendance_id,
            'pause_id' => $pause_id,
            'disableAttendanceOn' => $disableAttendanceOn,
            'disableAttendanceOff' =>
            $disableAttendanceOff,
            'disablePauseOn' => $disablePauseOn,
            'disablePauseOff' => $disablePauseOff
        ];
    }

    public function attendanceByDate(string $dateStr)
    {
        $attendances = $this->hasMany('App\Models\Attendance')->whereDate('start_time', $dateStr)->get();
        if ($attendances->count() === 0) {
            return null;
        } else return $attendances[0];
    }
    public function attendanceRowsByMonth(string $dateStr)
    {
        $attendanceList = [];
        $start = Carbon::Parse($dateStr);
        $end = $start->copy()->endOfMonth();
        for ($i = $start->copy(); $i->between($start, $end); $i->addDays(1)) {
            $attendanceRow = $this->attendanceRow($i->format('Y-m-d'));
            array_push($attendanceList, $attendanceRow);
        }
        return $attendanceList;
    }
    public function attendanceRow(string $targetDateStr)
    {
        $attendanceRow = [];
        $attendanceRow['name'] = $this->name;
        $attendanceRow['targetDateStr'] = $targetDateStr;
        $attendance = $this->attendanceByDate($targetDateStr);
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
        return $attendanceRow;
    }
}
