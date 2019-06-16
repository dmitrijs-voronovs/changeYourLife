<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    public function __construct(){
        $this->middleware('auth')->except('index');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $users =User::orderBy('name')->get();
        return view('users',compact('users'));
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('user',compact('user'));
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('user_edit',compact('user'));
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
        $user = User::findOrFail($id);
        $user->sentences()->delete();
        $stories = $user->stories();
        foreach($stories as $story){
            \DB::table('story_keyword')->where('story_id',$story->id)->delete();
            \DB::table('rateables')->where('rateable_id',$story->id)
                ->where('rateable_type','App\Sentence')->delete();
        }
        $stories->delete();
        \DB::table('followables')->where('user_id',$user->id)->delete();
        \DB::table('followables')
            ->where('followable_id',$user->id)
            ->where('followable_type','App\User')->delete();
        $comments = $user->comments();
        foreach($comments as $comment){
            \DB::table('rateables')
            ->where('rateable_id',$comment->id)
            ->where('rateable_type','App\Comment')->delete();
        }
        $comments->delete();
        \DB::table('rateables')->where('user_id',$user->id)->delete();
        $user->delete();
        return redirect()->route('users.index');
    }

    public function followers($id)
    {
        $user = User::findOrFail($id);
        return view('followers',compact('user'));
    }
    
    public function follow(Request $request, $id)
    {
        $validated_data = $request->validate([
            'followable_id'=>'integer|exists:users,id',
            'followable_type'=>'string',
            'user_id'=>'integer|exists:users,id'
        ]);
        $querry = \DB::table('followables')
            ->where('user_id',$request->input('user_id'))
            ->where('followable_id',$request->input('followable_id'))
            ->where('followable_type',$request->input('followable_type'));
        if ($querry->count()) $querry->delete();
        else \DB::table('followables')->updateOrInsert($validated_data);
        $user =\App\User::find($id);
        return redirect()->route('users.show',$id);
    }
}
