<?php

namespace App\Http\Services;

use App\Models\Path;
use App\Models\Routine;
use App\Models\Task;
use Illuminate\Support\Collection;

class RoutineService
{
    public function create(int $pathId, string $name, int $type, int $amount, string $unit, string $note = ''): Routine
    {
        $path = Path::findOrFail($pathId);
        $routine = (new Routine)->fill([
            'path_id' => $pathId,
            'name' => $name,
            'type' => $type,
            'amount' => $amount,
            'unit' => $unit,
            'note' => $note,
        ]);
        return $path->routines()->save($routine);
    }

    public function update(int $id, string $name, int $type, int $amount, string $unit, string $note = ''): bool
    {
        $routine = Routine::findOrFail($id);
        return $routine->fill([
            'name' => $name,
            'type' => $type,
            'amount' => $amount,
            'unit' => $unit,
            'note' => $note,
        ])->save();
    }

    public function updateTodayProgress(int $id, int $value): bool
    {
        $routine = Routine::findOrFail($id);
        $todayProgress = $routine->todayProgress()->firstOrNew();
        return $todayProgress->fill(['value' => $value])->save();
    }

    public function delete(int $id): bool
    {
        return Routine::destroy([$id]);
    }
}
