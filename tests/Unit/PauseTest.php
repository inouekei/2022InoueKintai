<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Attendance;
use App\Models\Pause;

class PauseTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testAcceptValidActions()
    {
        User::factory()->count(5)->create();
	Attendance::factory()->count(5)->create();
	Pause::factory()->count(5)->create();
	$count = Pause::get()->count();
	$this->assertEquals($count, 5);
	
	$firstPauseId = Pause::first()->id;
	$lastPauseId = Pause::all()->last()->id;
	$pause = Pause::find(rand(
	    $firstPauseId, $lastPauseId
	));
	$pauseStartTime = $pause->start_time;
        $this->assertDatabaseHas('pauses',[
	    'start_time' => $pauseStartTime,
	]);
	
	$pause->delete();
        $this->assertDatabaseMissing('pauses',[
	    'start_time' => $pauseStartTime,
	]);	
    }
    
    public function testRejectInvalidActions()
    {
        User::factory()->count(5)->create();
        Attendance::factory()->count(5)->create();
        $validData = [
	    'attendance_id' => rand(1, 5),
	    'start_time' => Carbon::now()->format('Y-m-d H:i:s'),
	    'end_time' => Carbon::now()->format('Y-m-d H:i:s'),
	];
	$datas = [];
	array_push($datas, array_replace($validData, [
	    'attendance_id' => null,
        ]));
	$lastAttendanceId = Attendance::all()->last()->id;
	array_push($datas, array_replace($validData, [
	    'attendance_id' => $lastAttendanceId + 1,
        ]));
	array_push($datas, array_replace($validData, [
	    'attendance_id' => 'abc',
        ]));
	
	$pause = new Pause();
	foreach ($datas as $data){
	    try{
	        $pause->fill($data)->save();
	    }catch (\Exception $e){
	    }
	    $this->assertDatabaseMissing('pauses',$data);	
	}
    }
}
