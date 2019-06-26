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

    public function checkPermission($operation)
    {
        
        //direct permissions      
        if ($this->user->hasPermissionTo($operation)) {  
            
            return true;

        }  

        //role permissions     
        $roles_r = Permission::findByName($operation)->roles->pluck('name'); //roles
    
        if ($this->user->hasRole($roles_r)) { 
            
            return true;
            
        }
                 
        //location permissions
        if ($this->user->location) {
            $user_location = Location::where('user_id', $this->user);

            foreach ($this->user->location as $user_location) {
               
                if ($user_location->hasPermissionTo($operation)) {                       
    
                    return true;
                    
                }
                
            }
        }

        return false;
        
    }

}
