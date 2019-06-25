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
        $userPermisions = app('userPermissions');
        $operations = array("Create Post","Write");
        $hasOwner = "";

        return $userPermisions->create($user, $operations, $hasOwner);
        
    }

    public function update(User $user, Comment $comment)
    {
        $userPermisions = app('userPermissions');
        $operations = array("Edit Post");
        $modelParam = $comment;
        $hasOwner = "1";
        
        return $userPermisions->update($user, $operations, $hasOwner, $modelParam);

    }
    
    public function delete(User $user, Comment $comment)
    {

        $userPermisions = app('userPermissions');
        $operations = array("Delete Post");
        $modelParam = $comment;
        $hasOwner = "1";
        return $userPermisions->delete($user, $operations, $hasOwner, $modelParam);

    }
}
