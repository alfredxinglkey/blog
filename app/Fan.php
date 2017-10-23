<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fan extends Model
{
    protected $fillable = ['fan_id', 'star_id'];


    //粉丝用户
    public function fuser()
    {
        return $this->hasOne('App\User','id' , 'fan_id');
    }

    //被关注的用户
    public function suser()
    {
        return $this->hasOne('App\User','id' , 'star_id');
    }
}