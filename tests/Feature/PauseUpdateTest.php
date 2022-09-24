<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class PauseUpdateTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testAccessWithPauseOffMode()
    {
        $this->user = User::factory()->create();
	$this->ActingAs($this->user)->post('/attendance');
	$this->ActingAs($this->user)->post('/pause');
	$this->ActingAs($this->user)->post(
	    '/pause/'.$this->user->currentStatus()['pause_id'],
	    ['mode' => 'PauseOff']
	)->assertStatus(302);
    }
    public function testAccessWithoutPauseOffMode()
    {
        $this->user = User::factory()->create();
	$this->ActingAs($this->user)->post('/attendance');
	$this->ActingAs($this->user)->post('/pause');
	$this->ActingAs($this->user)->post(
	    '/pause/'.$this->user->currentStatus()['pause_id'],[
	        'attendance_id' => $this->user->currentStatus()['attendance_id'],
		'start_time' => '2022-09-23 12:00:00',
		'end_time' => '2022-09-23 13:00:00',
	    ]
	)->assertStatus(302);
    }
}
