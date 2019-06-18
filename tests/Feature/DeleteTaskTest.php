<?php

namespace Tests\Feature;

use App\Task;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    public function a_user_can_delete_a_task()
    {
        $this->signIn();
        $this->withoutExceptionHandling();
        $due = Carbon::now();
        $task = create('App\Task',[
            'title' => 'Some Title',
            'description' => 'Some Description',
            'due' => $due,            
        ]);
        $this->assertCount(1, Task::all());
        $response = $this->delete('task/'.$task->id);
        $response->assertStatus(200);
        $this->assertCount(0, Task::all());
        $this->assertDatabaseMissing('tasks', [
            'title' => 'Some Title',
            'description' => 'Some Description',
            'due' => $due,            
        ]);
    }
    /** @test */
    public function an_unauthorised_user_cannot_delete_a_task()
    {
        $this->withExceptionHandling();
        $due = Carbon::now();
        $task = create('App\Task',[
            'title' => 'Some Title',
            'description' => 'Some Description',
            'due' => $due,            
        ]);
        $this->assertCount(1, Task::all());
        $response = $this->delete('task/'.$task->id);
        $response->assertStatus(302);
        $this->assertCount(1, Task::all());
        $this->assertDatabaseHas('tasks', [
            'title' => 'Some Title',
            'description' => 'Some Description',
            'due' => $due,            
        ]);
    }
}
