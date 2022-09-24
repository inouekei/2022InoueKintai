<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

Class RegisteredUserStoreTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testAccess()
    {
        $this->post('/register',[
	    'name' => 'example',
	    'email' => 'test@example.com',
	    'password' => 'password',
	    'password_confirmation' => 'password'
	    ]
	)->assertStatus(302);
	$count = User::get()->count();
	$this->assertEquals(1,$count);
    }
}
