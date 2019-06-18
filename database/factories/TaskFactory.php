<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Task;
use Carbon\Carbon;
use Faker\Generator as Faker;

$factory->define(Task::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence,
        'description' => $faker->paragraph,
        'due' => Carbon::now()->addWeek(),
        'status' => 'started'
    ];
});
