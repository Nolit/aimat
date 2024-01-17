<?php

namespace App\Http\Controllers\Task;

use App\Http\Controllers\Controller;
use App\Http\Requests\Task\StoreTaskRequest;
use App\Http\Services\TaskService;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class TaskController extends Controller
{
    public function __construct(private TaskService $taskService)
    {

    }

    public function store(StoreTaskRequest $request)
    {
        $this->taskService->create(
            userId: Auth::id(),
            title: $request->title,
            note: $request->note,
            goalId: $request->goal_id,
            date: $request->get('date')
        );
    }
}
