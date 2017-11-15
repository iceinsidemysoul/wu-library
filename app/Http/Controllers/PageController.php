<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    //
    public function spa_public()
    {
    	return view('pages.index');
    }

    public function post_show()
    {
    	return view('pages.post-details');
    }
}
