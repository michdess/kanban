<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class GetTasksTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    public function a_user_can_get_all_tasks()
    {
        $this->signIn();
        $this->withoutExceptionHandling();
        $task = create('App\Task');
        $response = $this->get('tasks');
        $response->assertStatus(200);
        $response->assertJsonFragment(['id' => $task->id]);
    }
    /** @test */
    public function an_unauthorised_user_cannot_get_all_tasks()
    {
        $this->withExceptionHandling();
        $task = create('App\Task');
        $response = $this->get('tasks');
        $response->assertStatus(302);   
    }
}
