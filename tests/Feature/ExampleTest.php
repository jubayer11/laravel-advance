<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        $response = $this->get('/');

//        $response->assertStatus(200);
//        $response->assertSee('laravel');
          $response->assertSeeInOrder(['laravel','documentation']);
    }
    /** @test */

    public function about_route_return_something()
    {
        $response=$this->get('/about');
        $response->assertSee('About');
    }
}
