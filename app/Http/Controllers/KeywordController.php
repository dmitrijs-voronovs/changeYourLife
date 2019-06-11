<?php

namespace App\Http\Controllers;
use DB;

use Illuminate\Http\Request;
use App\Keyword;

class KeywordController extends Controller
{
    public function __construct(){
        $this->middleware('auth')->except(['index','top']);
    }
    
    public function top()
    {
        // has no keywords with count = 0 
        // $keywords = DB::table('story_keyword')
        //     ->join('keywords','keyword_id','=','keywords.id')
        //     ->select(DB::raw('keyword_id, word, count(story_id) as total'))
        //     ->groupBy('keyword_id','word')
        //     ->orderBy('total','desc')
        //     ->orderBy('word')
        //     ->get();

        // has all keywords
        $keywords = DB::table('keywords')
            ->join('story_keyword','keywords.id','=','story_keyword.keyword_id')
            ->select(DB::raw('keywords.id, word, count(story_id) as total'))
            ->groupBy('keywords.id','word')
            ->orderBy('total','desc')
            ->orderBy('word')
            // ->take(10)
            ->get();

        // var_dump($keywords);
        
        return view('keywords2',compact('keywords'));
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $keywords = Keyword::orderBy('word','asc')->get();
        return view('keywords',compact('keywords'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('keywords_create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $rules = ['word'=>'required|unique:keywords|min:3'];
        var_dump($request->word);
        $this->validate($request,$rules);

        $keyword = new Keyword();
        $keyword->word = $data['word'];
        $keyword->save();
        return redirect()->route('keywords.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $keyword = Keyword::findOrFail($id);
        return view('keyword',compact('keyword'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
