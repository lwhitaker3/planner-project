<?php

namespace App\Policies;

use App\User;
use App\Note;
use Illuminate\Auth\Access\HandlesAuthorization;

class NotePolicy
{
    use HandlesAuthorization;

    /**
     * Determine if the given user can delete the given note.
     *
     * @param  User  $user
     * @param  Note  $note
     * @return bool
     */

   public function destroy(User $user, Note $note)
   {
       return $user->id == $note->user_id;
   }
}
