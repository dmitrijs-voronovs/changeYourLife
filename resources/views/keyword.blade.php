@extends('layouts.app')
@section('content')

<div class="jumbotron jumbotron-fluid">
  <div class="container">
    <h1 class="display-4">{{$keyword->word}}</h1>
    <p class="lead">There {{($keyword->stories->count()==1)?'is':'are'}} total {{$keyword->stories->count()}} {{str_plural('story',$keyword->stories->count())}} with this keyword!</p>
  </div>
</div>

@forelse($keyword->stories as $story)
    {{$story->word}}
    <div class="card my-2">
        <div class="card-body">
            <blockquote class="blockquote mb-0">
            <p>{{$story->title}}</p>
            <footer class="blockquote-footer"><cite title="Source Title">{{$story->author->name}}</cite>
            <a href="{{route('stories.show',$story->id)}}">Read</a></footer>
            </blockquote>
        </div>
    </div>
@empty
    <h2>No Stories</h2>
@endforelse

@endsection