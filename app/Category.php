<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    protected $guarded = [];

    public function posts()
    {
    	return $this->belongsToMany('App\Post', 'category_post', 'cate_id', 'post_id');
    }
}
