<?php

namespace App\Policies;

use App\User;
use App\Comment;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Str;

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
        //$operation = $this->userPermisions->getOperation(str_replace('Policy', '', class_basename(get_class())), __FUNCTION__);

       return $this->userPermisions->checkPermission($this->userPermisions->getOperation(str_replace('Policy', '', class_basename(__CLASS__)), __FUNCTION__));

    }

    public function update(User $user, Comment $comment)
    {
        if ($user->id === $comment->user_id){

            return $this->userPermisions->checkPermission($this->userPermisions->getOperation(str_replace('Policy', '', class_basename(__CLASS__)), __FUNCTION__));
        
        } else{

            return false;
        }

    }
    
    public function delete(User $user, Comment $comment)
    {
        if ($user->id === $comment->user_id){

            return $this->userPermisions->checkPermission($this->userPermisions->getOperation(str_replace('Policy', '', class_basename(__CLASS__)), __FUNCTION__));
         
        } else{
            return false;
        }


    }
}
