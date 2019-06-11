<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;

class CommentController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('ownerOrAdmin:comment,comments')->only('edit','update','destroy');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $validated_data = $request->validate([
            'text'=>'string|required',
            'user_id'=>'integer|required|exists:users,id',
            'story_id'=>'integer|required|exists:stories,id'
        ]);
        $comment = Comment::create($validated_data);
        return redirect()->route('comments.show',$comment->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $comment = Comment::findOrFail($id);
        return view('comment',compact('comment'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $comment = Comment::findOrFail($id);
        return view('comment_edit',compact('comment'));
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
            'text'=>'string|required',
            'user_id'=>'integer|required|exists:users,id',
            'story_id'=>'integer|required|exists:stories,id'
        ]);
        $comment = Comment::findOrFail($id);
        $comment->update($validated_data);
        return redirect()->route('stories.show',$comment->story_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $comment =Comment::findOrFail($id);
        $story_id = $comment->story_id;        
        $comment->delete();
        \DB::table('rateables')
            ->where('rateable_type','App\Comment')
            ->where('rateable_id',$id)->delete();
        return redirect()->route('stories.show',$story_id);
    }
}
