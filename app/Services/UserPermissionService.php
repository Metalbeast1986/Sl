<?php
namespace App\Services;

use App\User;
use App\Location;
use App\Comment;
use App\Role;
use App\Permission;

class UserPermissionService
{

    protected function checkPermission($user, $operations, ?string $hasOwner, ?string $modelParam)
    {
        //direct permissions
        foreach($operations as $operation){
          
            if ($user->hasPermissionTo($operation)) {  
                if ($hasOwner === "1"){
                    return $user->id === $modelParam->user_id;
                } else{
                return true;
                }
            }
          
        }

        //role permissions
         foreach($operations as $operation){
        
            $roles_r = Permission::findByName($operation)->roles->pluck('name'); //roles
        
            if ($user->hasRole($roles_r)) { 
                if ($hasOwner === "1"){
                    return $user->id === $modelParam->user_id;
                } else{
                return true;
                }
            }
         
        }
          
        //location permissions
        if ($user->location) {
            $user_location = Location::where('user_id', $user);

            foreach ($user->location as $user_location) {
                foreach($operations as $operation){
                    if ($user_location->hasPermissionTo($operation)) {         
                        return true;
                    }
                }
            }
        }

        return false;

    }

    public function create(User $user, $operations, $hasOwner)
    {
        $modelParam = null;

        return $this->checkPermission($user, $operations, $hasOwner, $modelParam);
    }

    public function update(User $user ,$operations, $hasOwner, $modelParam)
    {            
       return $this->checkPermission($user, $operations, $modelParam, $hasOwner);
    }

    public function delete(User $user,  $operations, $hasOwner, $modelParam)
    {
        return $this->checkPermission($user, $operations,  $modelParam, $hasOwner);
    }

}
