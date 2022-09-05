<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Attendance extends Model
{
    use HasFactory;

    protected $guarded = array('id');
    protected $fillable = ['user_id', 'start_time', 'end_time'];

    public function currentPause()
    {
        $pauses = $this->hasMany('App\Models\Pause');
        if ($pauses->count() === 0) return null;
        $last_pause =
            $pauses->latest()->get()[0];
        if ($last_pause['end_time'] === null) {
            return $last_pause;
        }
        return null;
    }

    public function totalPause()
    {
        $pauses = $this->hasMany('App\Models\Pause')->get();
        if ($pauses->count() === 0) {
            $standardTime = Carbon::parse("00:00:00");
            $totalPause = $standardTime->copy()->diff($standardTime);
            return $totalPause;
        } else {
            $standardTime = Carbon::parse("00:00:00");
            $totalPause = $standardTime->copy();
            foreach ($pauses as $pause) {
                $diff = $pause->pauseTime();
                $totalPause->add($diff);
            }
            $totalPause = $standardTime->copy()->diff($totalPause);
            // if ($this->id === 4) {
            //     dd($temp);
            // }
            if ($this->id === 4) {
                // dd($totalPause);
            }
            return $totalPause;
        }
    }

    public function attendanceTime($pause = null)
    {
        if ($pause === null) $pause = $this->totalPause();
        $standardTime = Carbon::parse("00:00:00");
        $totalTime = $standardTime->copy();
        if ($this->end_time) {
            $startTime = Carbon::Parse($this->start_time);
            $endTime = Carbon::Parse($this->end_time);
            $totalTime->add($startTime->copy()->diff($endTime));
            $totalTime->sub($pause);
            $attendanceTime = $standardTime->copy()->diff($totalTime);
        } else {
            $attendanceTime = '入力なし';
        }
        return $attendanceTime;
    }

    public function attendanceDispStr()
    {
        $attendanceOn = Carbon::parse($this->start_time);
        $attendanceOnStr = $attendanceOn->format('h:i:s');
        $totalPause = $this->totalPause();
        $totalPauseStr = $totalPause->format('%H:%I:%S');
        if ($this->end_time) {
            $attendanceOff = Carbon::parse($this->end_time);
            $attendanceOffStr = $attendanceOff->format('h:i:s');
            $attendanceTimeStr = $this->attendanceTime($totalPause)->format('%H:%I:%S');
        } else {
            $attendanceOffStr = '入力なし';
            $attendanceTimeStr = '入力なし';
        }
        return [
            'attendanceOnStr' => $attendanceOnStr,
            'attendanceOffStr' => $attendanceOffStr,
            'attendanceTimeStr' => $attendanceTimeStr,
            'totalPauseStr' => $totalPauseStr
        ];
    }
}
