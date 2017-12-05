<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class PageController extends Controller
{
    //
    public function spa_public()
    {
    	return view('pages.index');
    }

    public function post_show($id)
    {
    	$post = Post::find($id);
        $sameDate = substr($post->date, 5, 5);
        $onThisDay = Post::where('date', 'like', "%{$sameDate}%")->where('id', '<>', $post->id)->orderBy('date', 'desc')->get();
        if (count($onThisDay) < 0) {
            //find event same year
        }

    	if (!$post)  return redirect('/');

    	return view('pages.post-details', compact('post', 'onThisDay'));
    }
}
