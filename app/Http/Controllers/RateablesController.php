<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rules\RateablesType;

class RateablesController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
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
            'user_id'=>'required|exists:users,id',
            'rateable_id'=>'required|integer',
            'rateable_type'=>['required','string',new RateablesType],
            'like'=>'required|integer|min:0|max:1'
        ]);
        // check for possible previous likes/dislikes of the same post
        $rating = \DB::table('rateables')
            ->where('user_id',$validated_data['user_id'])
            ->where('rateable_type',$validated_data['rateable_type'])
            ->where('rateable_id',$validated_data['rateable_id']);
        
        if ($rating->count()==1){
            if($rating->first()->like==$validated_data['like'])
                $rating->delete();
            else $rating->update($validated_data);
        } 
        else \DB::table('rateables')->updateOrInsert($validated_data);
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
