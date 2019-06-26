<?php
namespace App\Services;


use App\Location;
use App\Permission;
use Auth;

class UserPermissionService
{

    public function __construct()
    {
        $this->user = Auth::user();
    }

    public function checkPermission($operations)
    {
        //direct permissions
        $user = $this->user;
        foreach($operations as $operation){
        
            if ($user->hasPermissionTo($operation)) {  
                
                return true;
   
            }  
        }

        //role permissions
         foreach($operations as $operation){ 
            $roles_r=Permission::findByName($operation)->roles->pluck('name'); //roles
        
            if ($user->hasRole($roles_r)) { 
              
                return true;
                
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

}
