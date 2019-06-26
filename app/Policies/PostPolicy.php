<?php
namespace App\Policies;
use App\Post;
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

    protected function getOperation(){
       
        return class_basename(Post::class);
    }

    public function create()
    {

        return $this->userPermisions->checkPermission(snake_case($this->getOperation()."_".__FUNCTION__));

    }

    public function update()
    {

        return $this->userPermisions->checkPermission(snake_case($this->getOperation()."_".__FUNCTION__));

    }
    public function delete()
    {
    
        return $this->userPermisions->checkPermission(snake_case($this->getOperation()."_".__FUNCTION__));

    }
}
