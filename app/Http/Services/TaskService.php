<?php

namespace App\Http\Services;

use App\Models\Task;
use Illuminate\Support\Collection;

class TaskService
{
    public function get(int $userId): Collection
    {
        return Task
            ::achieved(false)
            ->where('user_id', $userId)
            ->get();
    }
    public function create(int $userId, string $title, string $note = '', ?int $pathId = null, ?string $date = null, bool $is_achieved = false): bool
    {
        return (new Task)->fill([
            'user_id' => $userId,
            'title' => $title,
            'note' => $note,
            'path_id' => $pathId,
            'date' => $date,
            'is_achieved' => $is_achieved,
        ])->save();
    }
    public function update(int $id, string $title, string $note = '', ?int $pathId = null, ?string $date = null, bool $is_achieved = false): bool
    {
        $task = Task::findOrFail($id);
        return $task->fill([
            'title' => $title,
            'note' => $note,
            'path_id' => $pathId,
            'date' => $date,
            'is_achieved' => $is_achieved,
        ])->save();
    }

    public function delete(int $id): bool
    {
        return Task::destroy([$id]);
    }
}
