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

    public function create(User $user)
    {
        $userPermisions = app('userPermissions');
        $operations = array("Create Post","Write");
        $hasOwner = "0";
        return $userPermisions->create($user,  $operations, $hasOwner);
    }

    public function update(User $user, Post $post)
    {

        $userPermisions = app('userPermissions');
        $operations = array("Edit Post");
        $modelParam = $post;
        $hasOwner = "0";
        return $userPermisions->update($user, $operations, $hasOwner, $modelParam);

    }
    public function delete(User $user, Post $post)
    {
    
        $userPermisions = app('userPermissions');
        $operations = array("Delete Post");
        $modelParam = $post;
        $hasOwner = "0";
        return $userPermisions->delete($user, $operations, $hasOwner, $modelParam);

    }
}
