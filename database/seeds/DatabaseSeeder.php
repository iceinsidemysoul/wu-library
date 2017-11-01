<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        // create categories
    	$categories = factory('App\Category', 10)->create();
        // create posts
        $posts = factory('App\Post', 50)->create();
        // fore each post, populate 1-3 cates
        $posts->each(function ($post) use ($categories) {
        	$post->categories()->attach(
        		$categories->random(rand(1, 3))->pluck('id')->toArray()
        	);
        });
    }
}
