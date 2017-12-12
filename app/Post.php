<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{  
    use softDeletes;

    protected $dates = ['deleted_at'];

    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    public function user()
    {
    	return $this->belongsTo('App\User');
    }

    public function tags()
    {
    	return $this->belongsToMany('App\Tag');
    }

    public function comments()
    {
    	return $this->hasMany('App\comment');
    }
}
