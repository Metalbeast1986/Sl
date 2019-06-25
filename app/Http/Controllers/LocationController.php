<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Location;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class LocationController extends Controller
{
    public function index()
    {
        $locations = Location::where('user_id', auth()->id()) //show only authenticated user's comments
        ->orderby('id', 'desc')
        ->paginate(5); //show only 5 items at a time in descending order

        $roles = Role::get();
        $permissions = Permission::get();
        

        return view('locations.index', compact('locations'), ['roles'=>$roles], ['permissions'=>$permissions]);
    }

    public function show($id)
    {
        $location = Location::findOrFail($id); //Find post of id = $id

        return view('locations.show', compact('location'));
    }


    public function create()
    {
        $roles = Role::get();
        $permissions = Permission::get();

        return view('locations.create', ['roles'=>$roles], ['permissions'=>$permissions]);
    }

    public function store(Request $request)
    {
        $validated=request()->validate([
            'location'=> ['required', 'min:3'],

        ]);
        $location =  Location::create($validated + ['user_id' => auth()->id()]);
        $roles = $request['roles']; //Retrieving the roles field
        $permissions = $request['permissions']; //Retrieving the roles field
        if (isset($roles)) {
            foreach ($roles as $role) {
                $role_r = Role::where('id', '=', $role)->firstOrFail();

                $location->assignRole($role_r); //Assigning role to user
            }
        }
        if (isset($permissions)) {
            foreach ($permissions as $permission) {
                $permission_r = Permission::where('id', '=', $permission)->firstOrFail();
                $location->givePermissionTo($permission_r); //Assigning role to user
            }
        }

        //Display a successful message upon save
        return redirect()->route('locations.index')
                ->with('flash_message', 'Article,
                '. $location->location.' created');
    }

    public function edit($id)
    {
        $location = Location::findOrFail($id); //Get user with specified id
        $roles = Role::get(); //Get all roles
        $permissions = Permission::get(); //Get all roles

        return view('locations.edit', compact('location', 'roles', 'permissions')); //pass user and roles data to view
    }
    
    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function update(Request $request, $id)
    {
        $location = Location::findOrFail($id); //Get role specified by id
    
        //Validate name, email and password fields
        $this->validate($request, [
                'location'=>'required|max:120',
            ]);

        $input = $request->only(['location']); //Retreive the name, email and password fields
            $roles = $request['roles']; //Retreive all roles
            $permissions = $request['permissions']; //Retreive all roles
            $location->fill($input)->save();
    
        if (isset($roles)) {
            $location->roles()->sync($roles);  //If one or more role is selected associate user to roles
        } else {
            $location->roles()->detach(); //If no role is selected remove exisiting role associated to a user
        }
            
        if (isset($permissions)) {
            $location->permissions()->sync($permissions);  //If one or more role is selected associate user to roles
        } else {
            $location->permissions()->detach(); //If no role is selected remove exisiting role associated to a user
        }
        return redirect()->route('locations.index')
                ->with(
                    'flash_message',
                    'Location successfully edited.'
                );
    }

    public function destroy($id)
    {
        //Find a user with a given id and delete
        $location = Location::findOrFail($id);
        $location->delete();
    
        return redirect()->route('locations.index')
                ->with(
                    'flash_message',
                    'Location successfully deleted.'
                );
    }
}
