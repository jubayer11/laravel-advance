<?php

namespace Tests\Unit;

use App\Exceptions\MinorCanNOtBuyAlcoholicBeverageException;
use App\Models\Bevarage;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class BevarageTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    use DatabaseMigrations;

    private $bevarage;


    public function setUp(): void
    {
        parent::setUp(); // TODO: Change the autogenerated stub
        $this->bevarage = Bevarage::factory()->make();
    }

    /** @test */
    public function bevarage_has_name()
    {
//        $bevarage = Bevarage::factory()->make();
//        $name = $bevarage->name;
        $this->assertNotEmpty($this->bevarage->name);

    }

    /** @test */
    public function bevarage_has_type()
    {
//        $bevarage=Bevarage::factory()->make();
//        $type=$bevarage->type;
        $this->assertNotEmpty($this->bevarage->type);
    }
    /** @test */
    public function a_minor_user_can_not_buy_alcoholic_beverage()
    {
        $bevarage = Bevarage::factory()->make([
            'type' => 'Alcoholic'
        ]);
        $user = User::factory()->make([
            'age' => 21,
        ]);
        $this->actingAs($user);
        $this->expectException(MinorCanNOtBuyAlcoholicBeverageException::class);
        $bevarage->buy();
    }
}
