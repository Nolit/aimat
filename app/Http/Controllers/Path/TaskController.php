<?php

namespace App\Http\Controllers\Path;

use App\Http\Controllers\Controller;
use App\Http\Requests\Task\DeleteTaskRequest;
use App\Http\Requests\Task\StoreTaskRequest;
use App\Http\Requests\Task\UpdateTaskRequest;
use App\Http\Services\TaskService;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;

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
            note: $request->note ?? '',
            pathId: $request->path_id,
            date: $request->get('date'),
            is_achieved: $request->is_achieved ?? false
        );
    }

    public function update(UpdateTaskRequest $request, Task $task, )
    {
        if ($request->user()->cannot('update', $task)) {
            return redirect()->back()->withErrors(['forbidden operation']);
        }
        $this->taskService->update(
            id: $task->id,
            title: $request->title,
            note: $request->note ?? '',
            pathId: $request->path_id,
            date: $request->get('date'),
            is_achieved: $request->is_achieved ?? false
        );
    }

    public function destroy(DeleteTaskRequest $request, Task $task)
    {
        if ($request->user()->cannot('delete', $task)) {
            return redirect()->back()->withErrors(['forbidden operation']);
        }
        $this->taskService->delete(
            id: $task->id,
        );
    }
}
