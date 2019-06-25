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
        $operation = "Create Post";
        $hasOwner = "0";
        return $userPermisions->create($user,  $operation, $hasOwner);
    }

    public function update(User $user, Post $post)
    {

        $userPermisions = app('userPermissions');
        $operation = "Edit Post";
        $modelParam = $post;
        $hasOwner = "0";
        return $userPermisions->update($user, $operation, $hasOwner, $modelParam);

    }
    public function delete(User $user, Post $post)
    {
    
        $userPermisions = app('userPermissions');
        $operation = "Delete Post";
        $modelParam = $post;
        $hasOwner = "0";
        return $userPermisions->delete($user, $operation, $hasOwner, $modelParam);

    }
}
