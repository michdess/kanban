<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UpdateTaskStatusTest extends TestCase
{
    use RefreshDatabase;
        /** @test */
    public function a_user_can_update_a_tasks_status()
    {
        $this->signIn();
        $this->withoutExceptionHandling();
        $task = create('App\Task', ['status' => 'started']);
        $response = $this->patch('task/'.$task->id, [
            'status' => 'backlog',
        ]);
        $response->assertStatus(200);
        $this->assertEquals('backlog', $task->fresh()->status);
    }
    /** @test */
    public function an_unauthorised_user_cannot_update_a_task()
    {
        $this->withExceptionHandling();
        $task = create('App\Task', ['status' => 'started']);
        $response = $this->patch('task/'.$task->id, [
            'status' => 'backlog',
        ]);
        $response->assertStatus(302);
        $this->assertEquals('started', $task->fresh()->status);
    }
}
