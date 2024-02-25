<?php

namespace App\Http\Services;

use App\Models\Path;
use App\Models\Task;
use Illuminate\Support\Collection;

class PathService
{
    public function get(int $userId): Collection
    {
        return Path
            ::where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->get();
    }
    public function getWithRoutines(int $userId): Collection
    {
        return Path
            ::where('user_id', $userId)
            ->has('routines')
            ->with('routines.todayProgress')
            ->orderBy('created_at', 'desc')
            ->get();
    }

    public function createDefault(int $userId)
    {
        $path = new Path();
        $path->fill(['user_id' => $userId, 'name' => 'Edit Me'])->save();
        return $path;
    }
//    public function update(int $id, string $title, string $note = '', ?int $pathId = null, ?string $date = null, bool $is_achieved = false): bool
//    {
//        $task = Task::findOrFail($id);
//        return $task->fill([
//            'title' => $title,
//            'note' => $note,
//            'path_id' => $pathId,
//            'date' => $date,
//            'is_achieved' => $is_achieved,
//        ])->save();
//    }

    public function update(int $id, string $name, string $note)
    {
        $path = Path::findOrFail($id);
        return $path->fill([
            'name' => $name,
            'note' => $note,
        ])->save();
    }

    public function delete(int $id): bool
    {
        return Path::destroy([$id]);
    }
}
