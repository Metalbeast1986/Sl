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
    public function __construct()
    {
        $this->userPermisions = app('userPermissions');
        
    }
    public function create()
    {

        $userPermisions = $this->userPermisions;
        $operations = ["Create Post","Write"]; 

        return $userPermisions->checkPermission($operations);

    }

    public function update()
    {

        $userPermisions = $this->userPermisions;
        $operations = ["Edit Post"];
       
       return $userPermisions->checkPermission($operations);

    }
    public function delete()
    {
    
        $userPermisions = $this->userPermisions;
        $operations = ["Delete Post"];
       
        return $userPermisions->checkPermission($operations);

    }
}
