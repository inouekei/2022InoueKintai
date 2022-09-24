<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Attendance;
use App\Models\Pause;

class PauseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $firstAttendanceId = Attendance::first()->id;
        $lastAttendanceId = Attendance::all()->last()->id;
        return [
            'Attendance_id' => rand($firstAttendanceId, $lastAttendanceId),
	    'start_time' => $this->faker->dateTimeBetween()->format('Y-m-d h:i:s'),
        ];
    }
}
