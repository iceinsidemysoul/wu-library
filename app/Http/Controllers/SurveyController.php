<?php

namespace App\Http\Controllers;

use App\Survey;
use Illuminate\Http\Request;

class SurveyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return
        // number of all, goods, none, bad
        $good = Survey::where('satisfaction', 'good')->count();
        $none = Survey::where('satisfaction', 'none')->count();
        $bad = Survey::where('satisfaction', 'bad')->count();
        // array of latest survey that has comments
        $comments = Survey::where('comment', '<>', '')->latest()->get();
        $all = compact('comments', 'good', 'none', 'bad');
        // can be filter by feeling
        return $all;
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
        $satisfaction = ["good","none","bad"];
        $this->validate($request, [
            'satisfaction' => 'required|in_array:satisfaction'
        ]);
        $input = $request->only('satisfaction');
        if ($request->has('comment')) {
            $input['comment'] = $request->comment;
        }
        if ($request->has('email')) {
            $input['email'] = $request->email;
        }

        $new = Survey::create($input);

        return $new;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Survey  $survey
     * @return \Illuminate\Http\Response
     */
    public function show(Survey $survey)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Survey  $survey
     * @return \Illuminate\Http\Response
     */
    public function edit(Survey $survey)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Survey  $survey
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Survey $survey)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Survey  $survey
     * @return \Illuminate\Http\Response
     */
    public function destroy(Survey $survey)
    {
        //
    }
}
