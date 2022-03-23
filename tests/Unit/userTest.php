<?php

namespace Tests\Unit;

use App\Models\TodoList;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class userTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    use refreshDatabase;

    public function test_user_has_many_todo_lists()
    {
        $user = $this->createUser();
        $list = $this->createTodoList(['user_id' => $user->id]);
        $this->assertInstanceOf(TodoList::class, $user->todoLists->first());

    }
}
