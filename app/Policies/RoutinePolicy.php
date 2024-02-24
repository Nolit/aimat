<?php

namespace App\Policies;

use App\Models\Routine;
use App\Models\Task;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class RoutinePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Task $task): bool
    {
        //
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user, Routine $routine): bool
    {
        //TODO: Add a Policy
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Routine $routine): bool
    {
        return $user->id === $routine->path->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Routine $routine): bool
    {
        return $user->id === $routine->path->user_id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Task $task): bool
    {
        return $user->id === $task->user_id;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Task $task): bool
    {
        return $user->id === $task->user_id;
    }
}
