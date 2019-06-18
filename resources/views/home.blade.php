@extends('layouts.app')

@section('content')
    <div class="flex flex-col bg-white w-full xs:w-1/3 md:w-1/4 rounded mx-2 mb-4 shadow-sm">
        <div class="p-4 flex flex-col flex-grow">
            <p class="mb-2 text-lg font-semibold">Backlog</p>
            <tasks status="backlog"></tasks>
        </div>
        <create-task-button status="backlog" class="w-full text-center rounded-b bg-blue-500 text-white px-4 py-2 cursor-pointer"></create-task-button>
    </div>

    <div class="flex flex-col bg-white w-full xs:w-1/3 md:w-1/4 rounded mx-2 mb-4 shadow-sm">
        <div class="p-4 flex flex-col flex-grow">
            <p class="mb-2 text-lg font-semibold">In Progress</p>
            <tasks status="started"></tasks>
        </div>
        <create-task-button status="started" class="w-full text-center rounded-b bg-purple-500 text-white px-4 py-2 cursor-pointer"></create-task-button>
    </div>

    <div class="flex flex-col bg-white w-full xs:w-1/3 md:w-1/4 rounded mx-2 mb-4 shadow-sm">
        <div class="p-4 flex flex-col flex-grow">
            <p class="mb-2 text-lg font-semibold">Completed</p>
            <tasks status="completed"></tasks>
        </div>
    </div>
@endsection
