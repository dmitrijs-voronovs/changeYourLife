@extends('layouts.app')
@php
  if ($story->finished){
    $class = ' bg-warning';
  } else {
    $class = ($story->open)?' bg-success':'';
  }
@endphp

@section('content')
<div class="card">
    <!-- Card content -->
    <div class="card-body">

        <!-- Title -->
        <h4 class="card-title{{$class}}">{{$story->title}}</h4>
        <!-- Text -->
        <p class="card-text"><a href="{{route('users.show',$story->author->id)}}">{{$story->author->name}}</a></p>
        <!-- Button -->
        <p>
            @forelse($story->keywords as $keyword)
            <a href="{{route('keywords.show',$keyword->id)}}">{{$keyword->word}}</a> @if(!$loop->last),@endif
            @empty
            No keywords
            @endforelse
        </p>

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">User</th>
                    <th scope="col">sentence</th>
                    <th scope="col">contributions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($story->sentences as $sentence)
                <tr>
                    <td><a href="{{route('users.show',$sentence->author->id)}}">{{$sentence->author->name}}</a></td>
                    <td>{{$sentence->text}}</td>
                    <td>{{App\Sentence::where('author_id',$sentence->author->id)->where('story_id',$story->id)->count()}}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <a href="{{route('stories.index')}}" class="btn btn-primary">back</a>
        @if(Auth::user()->id == $story->user_id || Auth::user()->isAdmin())
        <a href="{{route('stories.edit',$story->id)}}" class="btn btn-primary">Edit</a>
        @endif

        @if(!$story->finished && $story->sentences->last()->author_id != Auth::user()->id)
        @if(array_key_exists(Auth::user()->id,$allUsers))
        <a href="{{route('sentences.create.special',$story->id)}}" class="btn btn-warning">Append</a>
        @else
        <a href="{{route('sentences.create.special',$story->id)}}" class="btn btn-warning">Join and append</a>
        @endif
        @endif
    </div>
</div>

<h4 class="mt-3 card-title">Comments</h4>

@if(\Auth::user())
<div class="card mb-3">
    <div class="card-body">
        <form action="{{route('comments.store')}}" method="POST">
            @csrf
            <div class="form-group">
                <label for="text">Comment text</label>
                <textarea id="text" class="form-control" name="text" rows="3"
                    placeholder="Enter comment">{{old('text')}}</textarea>
                @if ($errors->has('text'))
                <span class="invalid-feedback">
                    <strong>{{ $errors->first('text') }}</strong>
                </span>
                @endif
                <input name="story_id" value="{{$story->id}}" required hidden />
                <input name="user_id" value="{{\Auth::user()->id}}" required hidden />
            </div>
            <button type="submit" class="btn btn-primary">Comment</button>
        </form>
    </div>
</div>
@endif

@foreach($story->comments()->orderBy('created_at','desc')->get() as $comment)
    @component('components.comment',compact('comment'))
    @endcomponent
@endforeach

@endsection
