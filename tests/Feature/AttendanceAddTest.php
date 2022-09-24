<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class AttendanceAddTest extends TestCase
{

    use RefreshDatabase;
    
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testAccess()
    {
        $this->user = User::factory()->create();  
        $this->ActingAs($this->user)->get('/')->assertOk();
    }
}
