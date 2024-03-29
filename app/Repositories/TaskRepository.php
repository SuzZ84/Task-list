<?php

namespace App\Repositories;

use App\User;

class TaskRepository
{
    /**
     * Get all the tasks for a given user.
     *
     * @param  User  $user
     * @return Collection
     */
    public function forUser(User $user)
    {
        return $user->tasks()->orderBy('created_at', 'asc')->get();
    }
}