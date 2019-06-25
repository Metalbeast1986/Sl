<?php

namespace App\Policies;

use App\User;
use App\Comment;
use App\Location;
use Auth;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\DB;

class CommentPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can update the comment.
     *
     * @param  \App\User  $user
     * @param  \App\Comment  $comment
     * @return mixed
     */
    public function show(User $user, Comment $comment)
    {

        return $user->id === $comment->user_id;

    }

    public function create(User $user)
    { 
    //    DB::enableQueryLog();
       
        $userPermisions = app('userPermissions');
    //    $userPermisions->create($user);
    //    dd(DB::getQueryLog());
        return $userPermisions->create($user);
        
    }

    public function update(User $user, Comment $comment)
    {
        $userPermisions = app('userPermissions');
        $modelParam = $comment;
        $hasOwner = "1";
        return $userPermisions->update($user, $modelParam,  $hasOwner);

    }
    
    public function delete(User $user, Comment $comment)
    {
  /*      $userPermisions = app('userPermissions');

        return $userPermisions->delete($user, $comment);
*/

        $userPermisions = app('userPermissions');
        $modelParam = $comment;
        $hasOwner = "1";
        return $userPermisions->delete($user, $modelParam,  $hasOwner);

    }
}
