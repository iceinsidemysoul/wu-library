<?php

namespace App\Http\Controllers;

use App\Post;
use App\Category;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $posts = $this->filter($request);
        // $posts = Post::orderBy('date', 'desc')->get();

        return $posts;
    }

    protected function filter(Request $request)
    {
        if ($request->has('cate')){
            $posts = Category::find($request->cate)->posts();

        } else {
            $posts = Post::where('id', '>', 0);
        }


        if ($request->has('search')){
            $posts = $posts->where('title', 'like',  "%{$request->search}%");
        }

        if ($request->has('sort')){
            if($request->sort == 'asc')
                $posts = $posts->orderBy('date');
            else
                $posts = $posts->orderBy('date', 'desc');
        } else {
            $posts = $posts->orderBy('date', 'desc');
        }

        return $posts->get();

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //
    }


    // about timeline, tags, etc.
    public function timeline(Request $request)
    {
        $year_lists = $this->filterYear($request);
        // $year_lists = Post::selectRaw('DISTINCT(year(date)) as year')->orderBy('year', 'desc')->get();


        return $year_lists;
    }

    protected function filterYear(Request $request)
    {
        $year_arr = [];

        if ($request->has('cate')){
            $posts = Category::find($request->cate)->posts();

        } else {
            $posts = Post::where('id', '>', 0);
        }

        if ($request->has('search')){
            $posts = $posts->where('title', 'like',  "%{$request->search}%");
        }

        if ($request->has('sort') && ($request->sort == 'asc')){
            $posts = $posts->orderBy('date');
        } else {
            $posts = $posts->orderBy('date', 'desc');
        }

        $year_lists = $posts->selectRaw('DISTINCT(year(date)) as year')->get();

        foreach ($year_lists as $year){
            array_push($year_arr, $year->year);
        }

        $year_arr = array_unique($year_arr);


        return $year_arr;
        // return $year_lists;
    }
}
