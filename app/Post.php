<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['title', 'content', 'user_id'];

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public function comments()
    {
        return $this->hasMany('App\Comment')->orderBy('created_at', 'desc');
    }
    //用户点赞
    public function thumbup($user_id)
    {
        return $this->hasOne('App\Thumbup')->where('user_id', $user_id);
    }
    //文章的所有赞
    public function thumbups()
    {
        return $this->hasMany('App\Thumbup');
    }
}
