<?php

namespace App\Http\Services;

use App\Models\Task;
use Illuminate\Support\Collection;

class TaskService
{
    public function get(int $userId): Collection
    {
        return Task
            ::archived(false)
            ->where('user_id', $userId)
            ->get();
    }
    public function create(int $userId, string $title, string $note = '', ?int $goalId = null, ?string $date = null): bool
    {
        return (new Task)->fill([
            'user_id' => $userId,
            'title' => $title,
            'note' => $note,
            'goal_id' => $goalId,
            'date' => $date
        ])->save();
    }
    public function update(int $id, string $title, string $note = '', ?int $goalId = null, ?string $date = null): bool
    {
        $task = Task::findOrFail($id);
        return $task->fill([
            'title' => $title,
            'note' => $note,
            'goal_id' => $goalId,
            'date' => $date
        ])->save();
    }
}
