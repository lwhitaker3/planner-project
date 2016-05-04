<?php

namespace App\Policies;

use App\User;
use App\Task;
use Illuminate\Auth\Access\HandlesAuthorization;

class TaskPolicy
{
    use HandlesAuthorization;

    /**
     * Determine if the given user can delete the given note.
     *
     * @param  User  $user
     * @param  Task  $task
     * @return bool
     */

   public function destroy(User $user, Task $task)
   {
       return $user->id === $task->user_id;
   }
   public function destroy2(User $user, Task $task)
   {
       return $user->id === $task->user_id;
   }
}
