<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Story;
use Auth;

class StoryController extends Controller
{
    public function __construct(){
        $this->middleware('auth')->only(['create','edit']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stories_o = Story::where('open',1)->where('finished',0)->orderBy('updated_at','desc')->get();
        $stories_c = Story::where('open',0)->where('finished',0)->orderBy('updated_at','desc')->get();
        $stories_f = Story::where('finished',1)->orderBy('updated_at','desc')->get();
        return view('stories',compact('stories_o','stories_c','stories_f'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $keywords = \App\Keyword::all();
        return view('story_create',compact('keywords'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated_data = $request->validate([
            'title'=>'required|min:5|max:255|string|unique:stories,title',
            'sentence'=>'required|string',
        ]);
        $story = Story::create([
            'title'=>$request->input('title'),
            'user_id'=>Auth::user()->id
        ]);
        $story->sentences()->create([
            'text'=>$request->input('sentence'),
            'author_id'=>Auth::user()->id,
            'prev_sentence_id'=>null
        ]);
        if($request->input('custom_keywords')){
            $new_keywords = explode(',',$request->input('custom_keywords'));
            foreach((array)$new_keywords as $nkw){
                if($nkw=='') continue;
                $checkForKw = \App\Keyword::where('word',trim($nkw));
                if($checkForKw->count()==0){
                    $story->keywords()->create(['word'=>trim($nkw)]);
                } else {
                    $checkForKw->first()->stories()->sync($story->id,false);
                }
            }
        }

        foreach((array)$request->input('kw') as $nkw=>$v){
            $checkForKw = \App\Keyword::find($v);
            $checkForKw->stories()->sync($story->id,false);
        }
        $story->save();
        return redirect()->route('stories.show',$story->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $story = Story::findOrFail($id);
        $sentenceList = $story->sentences;
        $allUsers = [];
        foreach($sentenceList as $sentence){
            $allUsers[$sentence->author->id] = $sentence->author->name;
            // array_push($allUsers,$sentence->author->id);
        }
        return view('story',compact('story','allUsers'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $keywords = \App\Keyword::all();
        $story = Story::findOrFail($id);
        return view('story_edit',compact('story','keywords'));
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
