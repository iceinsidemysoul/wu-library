<?php

namespace App\Http\Controllers;

use App\Post;
use App\Category;
use Illuminate\Http\Request;

class PostController extends Controller
{

    // for admin query 
    public function adminIndex()
    {
        $posts = Post::orderBy('date', 'desc')->paginate(20);

        return $posts;
    }


    // for public query


    public function index(Request $request)
    {
        $posts = $this->filter($request);

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
        $categories = Category::all();

        return $categories;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'image' => 'required',
            'body' => 'required',
            'date' => 'required|date'
        ]);

        $input = $request->only(['title', 'body', 'date']);
        // save image 
        $input['image'] = ImageController::simpleUploadImage64($request->image);
        // create model
        $new_post = Post::create($input);
        // attach categories
        $new_post->categories()->attach($request->categories);
        // return model
        return $new_post;

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        // dd($post);
        return $post;
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
        $this->validate($request, [
            'title' => 'required',
            'image' => 'required',
            'body' => 'required',
            'date' => 'required|date'
        ]);

        // check if image has changed or not
        if ($post->image !== $request->image) {
            // delete old image
            ImageController::deleteImage($post->image);
            // upload old image
            $post->image = ImageController::simpleUploadImage64($request->image);
            // update image prop
            // $post->image = $new_image;
        }

        $post->title = $request->title;
        $post->body = $request->body;
        $post->date = $request->date;

        $post->save();

        // attach categories
        $post->categories()->detach();
        $post->categories()->attach($request->categories);
        // return model
        return $post;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        // delete image first
        $delResult = ImageController::deleteImage($post->image);
        // then delete model
        if (!$delResult) {
            throw new \Exception("Cannot delete image of this post! Please, Try again or tell you administrator");
        }

        return ($post->delete())? "Deleted" : "Cannot deleted";

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
            $posts = $posts->orderBy('year');
        } else {
            $posts = $posts->orderBy('year', 'desc');
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
