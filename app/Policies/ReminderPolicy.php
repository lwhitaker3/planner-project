<?php

namespace App\Policies;

use App\User;
use App\Reminder;
use Illuminate\Auth\Access\HandlesAuthorization;

class ReminderPolicy
{
    use HandlesAuthorization;

    /**
     * Determine if the given user can delete the given note.
     *
     * @param  User  $user
     * @param  Reminder $reminder
     * @return bool
     */

     public function destroy(User $user, Reminder $reminder)
     {
         return $user->id === $reminder->user_id;
     }
}
