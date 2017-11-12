<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //
    protected $guarded = [];

    protected $hidden = ['pivot'];

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('categories', function ($builder) {
            $builder->with('categories');
        });
    }

    public function categories()
    {
    	return $this->belongsToMany('App\Category', 'category_post', 'post_id', 'cate_id');
    }
}
