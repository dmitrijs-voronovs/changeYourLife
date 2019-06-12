<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sentence;

class SentenceController extends Controller
{
    public function __construct(){
        $this->middleware('auth')->except('index');
        $this->middleware('lastSentenceCheck')->only('create');
        $this->middleware(['storyOrSentenceAuthor','firstSentenceByOwner','lastSentenceOnFinishedStoryByOwner'])->only('edit','update');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sentences = Sentence::orderBy('created_at','desc')->get();
        return view('sentences',compact('sentences'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($story_id)
    {
        $author_id = \Auth::user()->id;
        return view('sentence_create',compact('story_id','author_id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request,(bool)$request->input('finish'));
        $validated_data= $request->validate([
            'text'=>'required|string',
            'author_id'=>'integer|exists:users,id',
            'story_id'=>'integer|exists:stories,id'
        ]);
        $sentence = Sentence::create($validated_data);
        $story = \App\Story::findOrFail($sentence->story_id);
        if($request->input('finish')) $story->update(['finished'=>1]);
        return redirect()->route('stories.show',$request->input('story_id'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $sentence = Sentence::findOrFail($id);
        return view('sentence',compact('sentence'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $sentence = Sentence::findOrFail($id);
        // if ($sentence->user_id == \Auth::user()->id || $sentence->user_id == $sentence->story->author_id || \Auth::user()->isAdmin())
        return view('sentence_edit',compact('sentence'));
        // return redirect()->route('stories.show',$sentence->story->id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validated_date = $request->validate([
            'text'=>'string|required'
        ]);
        Sentence::findOrFail($id)->update($validated_date);
        return redirect()->route('sentences.show',$id);
    }

    /**
     * Remove the specified resource from storage or restore it back.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $obj = Sentence::withTrashed()->findOrFail($id);
        if (!$obj->trashed())$obj->delete();
        else Sentence::withTrashed()->findOrFail($id)->restore();
        return redirect()->back();
    }
}
