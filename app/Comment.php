<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class comment extends Model
{
    /*
    protected $fillable = [
        'body', 'user_id'
    ];*/
    protected $guarded=[];
    protected $fillable = [
        'body','user_id'
    ];
    public function User()
    {
        return $this->belongsTo(User::class);
    }
}
