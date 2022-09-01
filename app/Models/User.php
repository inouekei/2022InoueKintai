<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

use DateTime;

class User extends Authenticatable
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

    public function currentAttendance()
    {
        $attendances = $this->hasMany('App\Models\Attendance');
        if ($attendances->count() === 0) return null;
        $last_attendance = $attendances->latest()->get()[0];
        $last_attendance_date = new DateTime($last_attendance['start_time']);
        $last_attendance_date_str = $last_attendance_date->format('Y-m-d');
        $today_date = new DateTime();
        $today_date_str = $today_date->format('Y-m-d');
        if ($last_attendance['end_time'] === null && $last_attendance_date_str === $today_date_str) {
            return $last_attendance;
        }
        return null;
        // foreach($attendances as $attendance){
        //     if($attendance['end_time']==null){
        //         $last_date = $attendance['start_time']->format('Y-m-d');
        //         $today_date = new DateTime()->format('Y-m-d');
        //         if($last_date === $today_date){
        //             $breaks = $attendance->hasMany('App\Models\Break');
        // if(count($attendances)===0)return null;
        // foreach($attendances as $attendance){
        //     if($attendance['end_time']==null){
        //         $last_date = $attendance['start_time']->format('Y-m-d');
        //         $today_date = new DateTime()->format('Y-m-d');
        //         if($last_date === $today_date){

        //             return $attendance['id'];
        //         }
        //     }
        // }
        // return null;
    }
}
