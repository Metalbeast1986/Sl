<?php
namespace App\Services;

use App\User;
use App\Location;
use App\Comment;

class UserPermissionService
{

    protected function checkPermission($user, $operation, $hasOwner, $modelParam)
    {
        $directPermissions = array();
        $rolePermissions = array();
        $locationPermissions = array();

        switch ($operation) {
            case "create":
                array_push($directPermissions, "Create Post", "Write");
                array_push($rolePermissions, "Writer","Author");
                array_push($locationPermissions, "Create Post","Write");
                break;

            case "edit":
                array_push($directPermissions, "Edit Post", "Modify");
                array_push($rolePermissions, "Editor","Modifier","Author");
                array_push($locationPermissions, "Edit Post","Modify");
                break;

            case "delete":
                array_push($directPermissions, "Delete Post", "Administer roles & permissions");
                array_push($rolePermissions, "Editor","Modifier","Author", "Admin");
                array_push($locationPermissions, "Delete Post","Administer roles & permissions");
                break;

            default:
                return false;
                break;
        }

        //direct permissions
        foreach($directPermissions as $directPermission){
            if ($user->hasPermissionTo($directPermission)) {  
                if ($hasOwner === "1"){
                    return $user->id === $modelParam->user_id;
                } else{
                return true;
                }
            }
        }

        //role permissions
         foreach($rolePermissions as $rolePermission){
            if ($user->hasRole($rolePermission)) {  
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
                foreach($locationPermissions as $locationPermission){
                    if ($user_location->hasPermissionTo($locationPermission)) {         
                        return true;
                    }
                }
            }
        }

        return false;

    }

    public function create(User $user)
    {
        $operation = "create";
        $hasOwner = "0";
        $modelParam = "";
        return $this->checkPermission($user, $operation, $hasOwner, $modelParam);
    }

    public function update(User $user, $modelParam, $hasOwner)
    {      
       $operation = "edit";
       return $this->checkPermission($user, $operation, $hasOwner, $modelParam);
    }

    public function delete(User $user,  $modelParam, $hasOwner)
    {
        $operation = "delete";
        return $this->checkPermission($user, $operation, $hasOwner, $modelParam);
    }

}
