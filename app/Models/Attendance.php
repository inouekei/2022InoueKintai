<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    protected $guarded = array('id');
    protected $fillable = ['user_id', 'start_time', 'end_time'];
    public function currentPause()
    {
        $pauses = $this->hasMany('App\Models\Pause');
        if ($pauses->count() === 0) return null;
        $last_pause = $pauses[$pauses->count() - 1];
        if ($last_pause['end_time'] === null) {
            return $last_pause;
        }
        return null;
    }
}
