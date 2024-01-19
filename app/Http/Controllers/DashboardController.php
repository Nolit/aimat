<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Task\StoreTaskRequest;
use App\Http\Services\TaskService;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function __construct(private TaskService $taskService)
    {

    }

    public function index()
    {
        return Inertia::render('Dashboard')->with([
            'tasks' => $this->taskService->get(Auth::id())
        ]);
    }
}