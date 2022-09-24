<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class EmailVerificationNotificationStore extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $user = new User();
	$user->fill([
	    'name' => 'testuser',
	    'password' => 'password',
	    'email' => 'test@example.com',
	])->save();
        $this->post('/email/verification-notification',[
	    'email' => 'test@example.com',
	])->assertStatus(302);
    }
}
