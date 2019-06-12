@extends('layouts.app')
@section('content')

<div class="jumbotron jumbotron-fluid mb-0">
  <div class="container px-5">
    <h1 class="display-4">#{{$keyword->word}}</h1>
    <p class="lead">There {{($keyword->stories->count()==1)?'is':'are'}} total {{$keyword->stories->count()}} {{str_plural('story',$keyword->stories->count())}} with this keyword!</p>
  </div>
</div>

@forelse($keyword->stories()->orderBy('created_at')->get() as $story)
    @php
      if ($story->finished){
        $class = 'warning';
      } else {
        $class = ($story->open)?'success':'primary';
      }
    @endphp
    {{$story->word}}
    <div class="card border border-{{$class}} my-3">
        <div class="card-body">
            <blockquote class="blockquote mb-0">
            <p>{{$story->title}}</p>
            <footer class="blockquote-footer mt-0"><cite title="Source Title">{{$story->author->name}}</cite>
            <a href="{{route('stories.show',$story->id)}}">Read</a></footer>
            </blockquote>
        </div>
    </div>
@empty
    <h2>No Stories</h2>
@endforelse

@endsection