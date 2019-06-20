<?php

namespace App\Policies;

use App\User;
use App\Comment;
use App\Location;
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
    public function show(User $user, Comment $comment)
    {

        return $user->id === $comment->user_id;

    }

    public function create(User $user)
    {

        //$locations = Location::where('user_id', auth()->id());
        if ($user->location) {
            foreach ($user->location as $user_location) {
                if (($user->hasPermissionTo('Create Post') || $user->hasPermissionTo('Write')) ||
                ($user->hasRole('Writer') ||  $user->hasRole('Author')) ||
                ($user_location->hasPermissionTo('Create Post') || $user_location->hasPermissionTo('Write'))) {

                    return true;
                }
            }
        } elseif (($user->hasPermissionTo('Create Post') || $user->hasPermissionTo('Write')) ||
                ($user->hasRole('Writer') ||  $user->hasRole('Author'))) {  // if user is not assigned to country

            return true;
        }
        
        
        return false;
    }

    public function update(User $user, Comment $comment)
    {
        // if user is assigned to country
        if ($user->location) {
            foreach ($user->location as $user_location) {
                if (($user->hasPermissionTo('Edit Post') || $user->hasPermissionTo('Modify')) ||
                ($user->hasRole('Editor') ||  $user->hasRole('Modifier') || $user->hasRole('Author')) ||
                ($user_location->hasPermissionTo('Edit Post') || $user_location->hasPermissionTo('Modify'))) {

                    return $user->id==$comment->user_id;
                }
            }
        } elseif (($user->hasPermissionTo('Edit Post') || $user->hasPermissionTo('Modify')) ||
                    ($user->hasRole('Editor') ||  $user->hasRole('Modifier') || $user->hasRole('Author'))) {

            return $user->id==$comment->user_id;
        }
        
        return false;
    }
    
    public function delete(User $user, Comment $comment)
    {
        if ($user->location) { // if user is assigned to country
            foreach ($user->location as $user_location) {
                if (($user->hasPermissionTo('Delete Post') || $user->hasPermissionTo('Administer roles & permissions')) ||
                ($user->hasRole('Admin') ||  $user->hasRole('Editor') || $user->hasRole('Author')) ||
                ($user_location->hasPermissionTo('Delete Post') || $user_location->hasPermissionTo('Administer roles & permissions'))) {
                    if ($user->id==$comment->user_id) {

                        return true;
                    }
                }
            }
        } elseif (($user->hasPermissionTo('Delete Post') || $user->hasPermissionTo('Administer roles & permissions')) ||
                ($user->hasRole('Admin') ||  $user->hasRole('Editor') || $user->hasRole('Author'))) { // if user is not assigned to country
            if ($user->id==$comment->user_id) {

                return true;
            }
        }
     
        return false;
    }
}
