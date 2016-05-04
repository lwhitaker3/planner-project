<?php

namespace App\Policies;

use App\User;
use App\Category;
use Illuminate\Auth\Access\HandlesAuthorization;

class CategoryPolicy
{
  use HandlesAuthorization;

  /**
   * Determine if the given user can delete the given note.
   *
   * @param  User  $user
   * @param  Note  $note
   * @return bool
   */

 public function destroy(User $user, Category $category)
 {
     return $user->id == $category->user_id;
 }
}
