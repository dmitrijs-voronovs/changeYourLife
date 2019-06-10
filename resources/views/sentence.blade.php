@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{$sentence->author->name}}</h5>
            <p class="card-text">{{$sentence->text}}</p>
            <a href="{{route('stories.show',$sentence->story_id)}}" class="btn btn-primary">Go to the story</a>
        </div>
    </div>
@endsection