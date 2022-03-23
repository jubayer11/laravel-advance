<?php

namespace Tests\Unit;


use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class UserModelTest extends TestCase
{


//    use DatabaseTransactions;
    use DatabaseMigrations;

    /** @test */
    public function user_has_full_name_attribute()
    {
        $user = User::create(['firstName' => 'Jubayer', 'lastName' => 'Ahmed','age'=>21, 'email' => 'ahmedjubayer54@gmail.com', 'password' => 'secret']);
        $this->assertEquals('Jubayer Ahmed', $user->fullname);
    }

    /** @test */


   public function user_has_age_attribute()
   {
       $user=User::factory()->make();
       $this->assertNotNull($user->age);
   }
}
