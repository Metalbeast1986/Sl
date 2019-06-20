<?php
namespace App\Policies;

use App\User;
use App\Post;
use App\Location;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    /*   public function __construct()
       {
           $this->authorizeResource(Comment::class, 'comment');
       }
*/
    /*
        public function extractPermissions($user, 'create')
        {
            $user
        }
    */


    public function create(User $user)
    {
        /*
           $permission = PermissionHelper::getUsersPermissions($user);

            1. 'create'
            2. 'creator'
            3. location > 'create'
        */

        if ($user->location->first()) { // if user is assigned to country
            if (($user->hasPermissionTo('Create Post') || $user->hasPermissionTo('Write')) ||
                ($user->hasRole('Writer') ||  $user->hasRole('Author')) ||
                ($user->location->first()->hasPermissionTo('Create Post') || $user->location->first()->hasPermissionTo('Write'))) {

                return true;

            }
        } else if (($user->hasPermissionTo('Create Post') || $user->hasPermissionTo('Write')) ||
        ($user->hasRole('Writer') ||  $user->hasRole('Author'))) {  // if user is not assigned to country

            return true;

        } 

        return false;

    }

    public function update(User $user, Post $post)
    {
        if ($user->location->first()) { // if user is assigned to country
            if (($user->hasPermissionTo('Edit Post') || $user->hasPermissionTo('Modify')) ||
                ($user->hasRole('Editor') ||  $user->hasRole('Modifier') || $user->hasRole('Author')) ||
                ($user->location->first()->hasPermissionTo('Edit Post') || $user->location->first()->hasPermissionTo('Modify'))) {

                return true;

            }
        } elseif (($user->hasPermissionTo('Edit Post') || $user->hasPermissionTo('Modify')) ||
                  ($user->hasRole('Editor') ||  $user->hasRole('Modifier') || $user->hasRole('Author'))) { // if user is not assigned to country

            return true;

        } 

        return false;

    }
    public function delete(User $user, Post $post)
    {
        if ($user->location->first()) { // if user is assigned to country
            if (($user->hasPermissionTo('Delete Post') || $user->hasPermissionTo('Administer roles & permissions')) ||
                ($user->hasRole('Admin') ||  $user->hasRole('Editor') || $user->hasRole('Author')) ||
                ($user->location->first()->hasPermissionTo('Delete Post') || $user->location->first()->hasPermissionTo('Administer roles & permissions'))) {

                return true;

            }
        } elseif (($user->hasPermissionTo('Delete Post') || $user->hasPermissionTo('Administer roles & permissions')) ||
                ($user->hasRole('Admin') ||  $user->hasRole('Editor') || $user->hasRole('Author'))) {

            return true;
            
        } 

        return false;

    }
}
