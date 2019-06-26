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

    protected function getOperation(){
       
        return class_basename(Comment::class);

    }

    public function show(User $user, Comment $comment)
    {

        return $user->id === $comment->user_id;
        
    }
    

    public function create()
    { 
        //$operation = snake_case($this->getOperation()."_".__FUNCTION__);  
        //return $this->userPermisions->checkPermission($operation);

        return $this->userPermisions->checkPermission(snake_case($this->getOperation()."_".__FUNCTION__));

    }

    public function update(User $user, Comment $comment)
    {
        if ($user->id === $comment->user_id){

            return $this->userPermisions->checkPermission(snake_case($this->getOperation()."_".__FUNCTION__));

        } else{


            return false;
        }
    }
    
    public function delete(User $user, Comment $comment)
    {
        if ($user->id === $comment->user_id){
           
            return $this->userPermisions->checkPermission(snake_case($this->getOperation()."_".__FUNCTION__));

        } else{

            return false;

        }

    }
}
