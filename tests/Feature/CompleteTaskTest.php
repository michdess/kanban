<?php

namespace Tests\Feature;

use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CompleteTaskTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    public function a_user_can_mark_a_task_as_complete()
    {
        $this->signIn();
        $this->withoutExceptionHandling();
        $task = create('App\Task');
        $response = $this->patch('task/'.$task->id, [
            'status' => 'completed'
        ]);
        $response->assertStatus(200);
        $this->assertNotNull($task->fresh()->completed);
        $this->assertEquals('completed', $task->fresh()->status);
    }
    /** @test */
    public function an_unauthorsed_user_cannot_mark_a_task_as_complete()
    {
        $this->withExceptionHandling();
        $task = create('App\Task');
        $this->assertEquals('started', $task->fresh()->status);
        $response = $this->patch('task/'.$task->id, [
            'status' => 'completed'
        ]);
        $response->assertStatus(302);
        $this->assertNull($task->fresh()->completed);
        $this->assertEquals('started', $task->fresh()->status);
    }
    /** @test */
    public function a_user_can_mark_a_completed_task_as_incomplete()
    {
        $this->signIn();
        $this->withoutExceptionHandling();
        $task = create('App\Task', ['status' => 'completed', 'completed' => Carbon::now()]);
        $response = $this->patch('task/'.$task->id, [
            'status' => 'started'
        ]);
        $response->assertStatus(200);
        $this->assertNull($task->fresh()->completed);
        $this->assertEquals('started', $task->fresh()->status);
    }
    /** @test */
    public function an_unauthorised_user_cannot_mark_a_completed_task_as_incomplete()
    {
        $this->withExceptionHandling();
        $task = create('App\Task', ['status' => 'completed', 'completed' => Carbon::now()]);
        $response = $this->patch('task/'.$task->id, [
            'status' => 'started'
        ]);
        $response->assertStatus(302);
        $this->assertNotNull($task->fresh()->completed);
        $this->assertEquals('completed', $task->fresh()->status);
    }
}
