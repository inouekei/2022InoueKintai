<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Carbon\Carbon;

class Pause extends Model
{
    use HasFactory;

    protected $guarded = array('id');
    protected $fillable = ['attendance_id', 'start_time', 'end_time'];

    public function pauseTime()
    {
        if ($this->end_time) {
            $startTime = Carbon::parse($this->start_time);
            $endTime = Carbon::parse($this->end_time);
            $diff = $startTime->copy()->diff($endTime);
        } else {
            $standardTime = Carbon::parse('00:00:00');
            $diff = $standardTime->copy()->diff($standardTime);
        }
        return $diff;
    }
}
