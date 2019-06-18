<?php

namespace Tests\Unit;

use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TaskTest extends TestCase
{
	use RefreshDatabase;
	/** @test */
	public function a_task_has_a_title()
	{
		$task = create('App\Task', ['title' => 'Some Task Title']);
		$this->assertEquals('Some Task Title', $task->fresh()->title);
	}
	/** @test */
	public function a_task_has_a_description()
	{
		$task = create('App\Task', ['description' => 'Some task description']);
		$this->assertEquals('Some task description', $task->fresh()->description);
	}
	/** @test */
	public function a_task_has_a_due_date()
	{
		$task = create('App\Task', ['due' => Carbon::now()->addWeek()]);
		$this->assertEquals(Carbon::now()->addWeek(), $task->fresh()->due);
	}
	/** @test */
	public function a_task_can_be_marked_as_completed()
	{
		$task = create('App\Task', ['completed' => Carbon::now()]);
		$this->assertEquals(Carbon::now(), $task->fresh()->completed);
	}
	/** @test */
	public function a_task_can_have_a_status()
	{
		$task = create('App\Task', ['status' => 'backlog']);
		$this->assertEquals('backlog', $task->fresh()->status);
	}
}
