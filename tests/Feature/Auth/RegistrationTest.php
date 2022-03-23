<?php

namespace Tests\Feature\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    use refreshDatabase;

    public function test_user_Can_register()
    {
        $this->postJson(route('user.register'),['firstName' => 'jubayer','lastName'=>'ahmed', 'email' => 'ahmedjubayer54@gmail.com', 'password' => 'password','age'=>22])->assertCreated();
        $this->assertDatabaseHas('users',['firstName'=>'jubayer']);
    }
}
