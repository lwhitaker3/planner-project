<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;

class DailyPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */

     /**
      * Determine if the given user can delete the given task.
      *
      * @param  User  $user
      * @param  Task  $task
      * @return bool
      */
     public function destroy(User $user, Daily_Note $daily_note)
     {
         return $user->id == $daily_note->user_id;
     }
}
