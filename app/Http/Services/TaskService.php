<?php

namespace App\Http\Services;

use App\Models\Task;

class TaskService
{
    public function create(string $title, string $note = '', ?int $goalId = null): bool
    {
        return (new Task)->fill(['title' => $title, 'note' => $note, 'goal_id' => $goalId])->save();
    }
}
