<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //
    protected $guarded = [];

    public function categories()
    {
    	return $this->belongsToMany('App\Category', 'category_post', 'post_id', 'cate_id');
    }
}
