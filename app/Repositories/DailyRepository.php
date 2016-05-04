<?php

namespace App\Repositories;

use App\User;
use App\Daily_Note;

class DailyRepository
{
    /**
     * Get all of the tasks for a given user.
     *
     * @param  User  $user
     * @return Collection
     */
    public function forUser(User $user)
    {
        return Daily_Note::where('user_id', $user->id)
                    ->get();
    }
}
