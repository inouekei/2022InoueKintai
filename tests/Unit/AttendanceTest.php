<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Attendance;

class AttendanceTest extends TestCase
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
	$count = Attendance::get()->count();
	$this->assertEquals($count, 5);
	
	$firstRecordId = Attendance::first()->id;
	$lastRecordId = Attendance::all()->last()->id;
	$attendance = Attendance::find(rand(
	    $firstRecordId, $lastRecordId
	));
	$attendanceStartTime = $attendance->start_time;
        $this->assertDatabaseHas('attendances',[
	    'start_time' => $attendanceStartTime,
	]);
	
	$attendance->delete();
        $this->assertDatabaseMissing('attendances',[
	    'start_time' => $attendanceStartTime,
	]);	
    }
    
    public function testRejectInvalidActions()
    {
        User::factory()->count(5)->create();
        $validData = [
	    'user_id' => rand(1, 5),
	    'start_time' => Carbon::now()->format('Y-m-d H:i:s'),
	    'end_time' => Carbon::now()->format('Y-m-d H:i:s'),
	];
	$datas = [];
	array_push($datas, array_replace($validData, [
	    'user_id' => null,
        ]));
	$lastUserId = User::all()->last()->id;
	array_push($datas, array_replace($validData, [
	    'user_id' => $lastUserId + 1,
        ]));
	array_push($datas, array_replace($validData, [
	    'user_id' => 'abc',
        ]));
	
	$attendance = new Attendance();
	foreach ($datas as $data){
	    try{
	        $attendance->fill($data)->save();
	    }catch (\Exception $e){
	    }
	    $this->assertDatabaseMissing('attendances',$data);	
	}
    }
}
