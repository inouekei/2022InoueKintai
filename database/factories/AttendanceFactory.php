<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Attendance;

class AttendanceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $firstUserId = User::first()->id;
        $lastUserId = User::all()->last()->id;
        return [
	    'user_id' => rand($firstUserId, $lastUserId),
	    'start_time' => $this->faker->dateTimeBetween()->format('Y-m-d h:i:s'),    
        ];
    }
}
