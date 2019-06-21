<?php
namespace App\Services;

use App\User;
use App\Location;
use App\Comment;

class UserPermission
{
    public function create(User $user)
    {
       //dd($user->location->pluck('location'));
        $user_location = Location::where('user_id', $user);
        
        if ($user->location) {
            foreach ($user->location as $user_location) {
                if (($user->hasPermissionTo('Create Post') || $user->hasPermissionTo('Write')) ||
                ($user->hasRole('Writer') ||  $user->hasRole('Author')) ||
                ($user_location->hasPermissionTo('Create Post') || $user_location->hasPermissionTo('Write'))) 
                
                {

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
       // if user is assigned to country
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
