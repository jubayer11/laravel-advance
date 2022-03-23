<?php

namespace Tests\Feature;


use App\Models\Task;
use Google\Client;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Mockery\MockInterface;
use Tests\TestCase;

class serviceTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    use RefreshDatabase;

    protected $user, $service;

    public function setUp(): void
    {
        parent::setUp(); // TODO: Change the autogenerated stub
        $this->user = $this->sanctumAuthenticate();
        $this->service = $this->createService('');

        $this->createTaskList(['created_at' => now()->subDays(2)]);
        $this->createTaskList(['created_at' => now()->subDays(3)]);
        $this->createTaskList(['created_at' => now()->subDays(4)]);
        $this->createTaskList(['created_at' => now()->subDays(6)]);

        $this->createTaskList(['created_at' => now()->subDays(10)]);


    }


    public function test_a_user_can_connect_to_a_service_and_token_is_is_stored()
    {
        $mock = $this->mock(Client::class, function (MockInterface $mock) {

            $mock->shouldReceive('setScopes');
            $mock->shouldReceive('createAuthUrl')->andReturn('https://localhost');
        });

        $response = $this->getJson(route('service.connect', 'google-drive'))->assertOk()->json();
        $this->assertEquals($response['url'], 'https://localhost');
        $this->assertNotNull($response['url']);
    }

    public function test_service_callback_will_store_token()
    {
        $mock = $this->mock(Client::class, function (MockInterface $mock) {

//            $mock->shouldReceive('setClientId');
//            $mock->shouldReceive('setClientSecret');
//            $mock->shouldReceive('setRedirectUri');
            $mock->shouldReceive('fetchAccessTokenWithAuthCode')->andReturn('fake-token');
        });

        $res = $this->postJson(route('service.callback'), ['code' => 'some code', 'token' => '{"access_token":"fake-token"}'])->assertCreated();

        $this->assertDatabaseHas('services', ['user_id' => $this->user->id]);

        //dd($this->user->services);
        //$this->assertNotNull($this->user->services->first()->token);
    }

    public function test_data_of_week_can_be_stored_on_google_drive()
    {

        $mock = $this->mock(Client::class, function (MockInterface $mock) {

//
            $mock->shouldReceive('setAccessToken');
            $mock->shouldReceive('getLogger->info');
            $mock->shouldReceive('shouldDefer');
            $mock->shouldReceive('execute');
        });

        $res = $this->postJson(route('service.store', $this->service))->assertCreated();


    }
}

