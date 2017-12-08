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
        $onThisDay = Post::where('date', 'like', "%{$sameDate}")->where('id', '<>', $post->id)->orderBy('date', 'desc')->get();
        if (count($onThisDay) < 1) {
            //find event same year
            $sameYear = substr($post->date, 0, 4);
            $onThisYear = Post::where('date', 'like', "%{$sameYear}%")->where('id', '<>', $post->id)->orderBy('date', 'desc')->get();
        }

    	if (!$post)  return redirect('/');

    	return view('pages.post-details', compact('post', 'onThisDay', 'onThisYear'));
    }
}
