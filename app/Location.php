<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class Location extends Model
{
    use HasRoles;
    protected $guarded=[];

    protected $guard_name = 'web'; // or whatever guard you want to use

    public function User()
    {
       // return $this->belongsTo(User::class);
       return $this->belongsTo('user', 'user_id');
    } 
}






