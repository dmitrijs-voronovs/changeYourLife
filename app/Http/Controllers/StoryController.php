<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Story;
use App;
use Auth;

class StoryController extends Controller
{
    public function __construct(){
        $this->middleware('auth')->except(['index']);
        $this->middleware('ownerOrAdmin:story,stories')->only('updateOpenParam','edit','editMain','update','destroy');
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
        $stories_p = [];
        if (\Auth::user()) $stories_p = Story::where('user_id',\Auth::id())->orderBy('finished','asc')->orderBy('updated_at','desc')->get();
        $stories_fol = [];
        if (\Auth::user()) $stories_fol = Story::whereIn('user_id',\Auth::user()->followed_users->pluck('id'))->orderBy('finished','asc')->orderBy('open','asc')->orderBy('updated_at','desc')->get();
        return view('stories',compact('stories_o','stories_c','stories_f','stories_p','stories_fol'));
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
            'author_id'=>Auth::user()->id
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
            if ($sentence->trashed()) continue;
            $allUsers[$sentence->author->id] = $sentence->author->name;
        }
        return view('story',compact('story','allUsers'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editMain($id)
    {
        $keywords = \App\Story::findOrFail($id)->keywords;
        $words = [];
        foreach($keywords as $kw) array_push($words,$kw->word);
        $keywords = implode(', ',$words);
        $story = Story::findOrFail($id);
        return view('story_edit_main',compact('story','keywords'));
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
        $validated_data = $request->validate([
            'title'=>'required|min:5|max:255|string',
            'sentence'=>'required|string',
            'last_sentence'=>'string|min:1',
        ]);
        $story = Story::findOrFail($id);
        $story->update([
            'title'=>$request->input('title')
        ]);
        $story->sentences()->orderBy('created_at','asc')->first()->update([
            'text'=>$request->input('sentence')
        ]);
        if ($request->input('last_sentence'))$story->sentences()->orderBy('created_at','desc')->first()->update([
            'text'=>$request->input('last_sentence')
        ]);
        \DB::table('story_keyword')->where('story_id',$story->id)->delete();
        if($request->input('keywords')){
            $new_keywords = explode(',',$request->input('keywords'));
            foreach((array)$new_keywords as $nkw){
                if($nkw=='') continue;
                $checkForKw = \App\Keyword::where('word',trim($nkw));
                if($checkForKw->count()==0){
                    $story->keywords()->create(['word'=>trim($nkw)]);
                } else {
                    $checkForKw->first()->stories()->sync($story->id);
                }
            }
        }
        $story->save();
        return redirect()->route('stories.show',$story->id);
    }

    public function updateOpenParam($id){
        $story = Story::findOrFail($id);
        $story->update(['open'=>1-$story->open]);
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $story = Story::findOrFail($id);
        \DB::table('comments')->where('story_id',$id)->delete();
        \DB::table('story_keyword')->where('story_id',$id)->delete();
        \DB::table('sentences')->where('story_id',$id)->delete();
        \DB::table('rateables')->where('rateable_id',$id)->where('rateable_type','App\Story')->delete();
        $story->delete();
        return redirect()->route('stories.index');
    }

    public function getSearch()
    {
        return view('story_search');
    }
    
    public function postSearch(Request $request)
    {
        $stories = Story::where('title','like','%'.$request->get('search').'%')->get();
        $comments = \App\Comment::where('text','like','%'.$request->get('search').'%')->get();
        $users = \App\User::where('name','like','%'.$request->get('search').'%')->get();
        $keywords = \App\Keyword::where('word','like','%'.$request->get('search').'%')->get();
        return [$stories,$comments,$users,$keywords];
    }
}
