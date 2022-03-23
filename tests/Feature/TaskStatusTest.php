<?php

namespace Tests\Feature;

use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TaskStatusTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    use refreshDatabase;

    public function test_a_task_status_can_be_change()
    {
        $this->sanctumAuthenticate();
        $tasks = $this->createTaskList('');
        $this->patchJson(route('task.update', $tasks[0]['id']), ['status' => Task::STARTED]);
        $this->assertDatabaseHas('tasks', ['status' => Task::STARTED]);
    }
}
