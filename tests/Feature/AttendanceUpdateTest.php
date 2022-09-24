<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Carbon\Carbon;
use App\Models\User;

class AttendanceUpdateTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testAccessWithAttendanceOffMode()
    {
        $this->user = User::factory()->create();
        $this->ActingAs($this->user)->post('/attendance');
        $this->ActingAs($this->user)->post(
	    '/attendance/'.$this->user->attendanceByDate(Carbon::today())->id,
	    ['mode'=>'AttendanceOff']
	)->assertStatus(302);
    }

    public function testAccessWithoutAttendanceOffMode()
    {
        $this->user = User::factory()->create();
        $this->ActingAs($this->user)->post('/attendance');
        $this->ActingAs($this->user)->post(
	    '/attendance/'.$this->user->attendanceByDate(Carbon::today())->id,[
	        'user_id'=>$this->user->id,
                'start_time'=>'2022-09-23 09:00:00',
		'end_time'=>'2022-09-23 17:00:00',	
        ])->assertStatus(302);
    }
}
