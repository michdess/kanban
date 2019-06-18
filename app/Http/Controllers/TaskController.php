<?php

namespace App\Http\Controllers;

use App\Task;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        return Task::all();
    }
    public function store()
    {
    	$task = Task::create(request()->all());
    	return $task;
    }
    public function update($id)
    {
        $task = Task::find($id);
        if(request()->status == 'completed'){
            $task->update(request()->all() + ['completed' => Carbon::now()]);          
        } else {
            $task->update(request()->all() + ['completed' => null]);  
        }
        return $task;       
    }
    public function complete($id)
    {
    	$task = Task::find($id);
    	$task->update(['completed' => Carbon::now(), 'status' => 'completed']);
    	return $task;
    }
    public function incomplete($id)
    {
    	$task = Task::find($id);
    	$task->update(['completed' => null, 'status' => 'started']);
    	return $task;
    }
    public function destroy($id)
    {
    	return Task::destroy($id);
    }
}
