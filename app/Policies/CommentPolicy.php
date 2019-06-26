<?php

namespace App\Policies;

use App\User;
use App\Comment;
use Illuminate\Auth\Access\HandlesAuthorization;

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
    
    public function __construct()
    {
        $this->userPermisions = app('userPermissions');
        
    }

    public function show(User $user, Comment $comment)
    {

        return $user->id === $comment->user_id;

    }

    public function create()
    { 
        $userPermisions = $this->userPermisions;
        $operations = ["Create Post","Write"]; //1. neduodam pagal name, o duodam metodo pavadinima pvz modelioPavadinimas_metodoPavadinimas pvz comment_create
    
        return $userPermisions->checkPermission($operations);

        
    }

    public function update(User $user, Comment $comment)
    {
        if ( $user->id === $comment->user_id){
            $userPermisions = $this->userPermisions;
            $operations = ["Edit Post"];
            
            return $userPermisions->checkPermission($operations);

        } else{

            return false;
        }
    }
    
    public function delete(User $user, Comment $comment)
    {
        if ( $user->id === $comment->user_id){
            $userPermisions = $this->userPermisions;
            $operations = ["Delete Post"];
        
            return $userPermisions->checkPermission($operations);

        } else{

            return false;
        }

    }
}
