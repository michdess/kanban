<?php

namespace Tests\Feature;

use App\Task;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CreateTaskTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    public function a_user_can_add_a_new_task()
    {
        $this->signIn();
        $this->withoutExceptionHandling();
        $response = $this->post('task', [
            'title' => 'Some Title',
            'description' => 'Some Description',
            'due' => Carbon::now(),
            'status' => 'started'
        ]);
        $response->assertStatus(201);
        $this->assertCount(1, Task::all());
        $this->assertDatabaseHas('tasks', [
            'title' => 'Some Title',
            'description' => 'Some Description',
            'due' => Carbon::now(),
            'status' => 'started'            
        ]);
    }
    /** @test */
    public function an_unauthorised_user_cannot_add_a_new_task()
    {
        $this->withExceptionHandling();
        $response = $this->post('task', [
            'title' => 'Some Title',
            'description' => 'Some Description',
            'due' => Carbon::now(),
            'status' => 'started'
        ]);
        $response->assertStatus(302);
        $this->assertCount(0, Task::all());
        $this->assertDatabaseMissing('tasks', [
            'title' => 'Some Title',
            'description' => 'Some Description',
            'due' => Carbon::now(),
            'status' => 'started'            
        ]);        
    }
}
