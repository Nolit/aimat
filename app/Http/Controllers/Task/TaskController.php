<?php

namespace App\Http\Controllers\Task;

use App\Http\Controllers\Controller;
use App\Http\Requests\Task\StoreTaskRequest;
use App\Http\Services\TaskService;
use Inertia\Inertia;

class TaskController extends Controller
{
    public function __construct(private TaskService $taskService)
    {

    }

    public function store(StoreTaskRequest $request)
    {
        $this->taskService->create(title: $request->title, note: $request->note, goalId: $request->goal_id);
    }
}
