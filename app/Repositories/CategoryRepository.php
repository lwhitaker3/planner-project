<?php

namespace App\Repositories;

use App\User;
use App\Category;

class CategoryRepository
{
    /**
     * Get all of the tasks for a given user.
     *
     * @param  User  $user
     * @return Collection
     */
    public function forUser(User $user)
    {
        return Category::where('user_id', $user->id)
                    ->get();
    }
}
