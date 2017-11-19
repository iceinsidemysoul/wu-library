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

    	if (!$post)  return redirect('/');

    	return view('pages.post-details', compact('post'));
    }
}
