@extends('layouts.app')

@section('content')
<div class="card mb-3">
    <div class="card-header">
        Info
    </div>
    <div class="card-body ml-3">
        <h5 class="card-title">{{$user->name}}</h5>
        <p class="card-text">{{$user->email}}<br>
        <a href="{{route('followers',$user->id)}}">{{$user->followers->count()}} {{str_plural('follower',$user->followers->count())}}</a></p>
        
        @if(\Auth::user()->id != $user->id)
        <form action={{route('follow',$user->id)}} method="POST">
            @csrf
            @method("PATCH")
            <input type="text" name="followable_id" value="{{$user->id}}" hidden/>
            <input type="text" name="followable_type" value="App\User" hidden/>
            <input type="text" name="user_id" value="{{\Auth::user()->id}}" hidden/>
            <input type="submit" class="btn btn-primary" value="Follow">
        </form>
        @endif

    </div>
</div>

<div class="card mb-3">
    <div class="card-header">
        Created stories
    </div>
    <div class="card-body">
        <ul class="list-group list-group-flush">
            @forelse($user->stories as $story)
            <li class="list-group-item"><a href="{{route('stories.show',$story->id)}}">{{$story->title}}</a></li>
            @empty
            Nothing
            @endforelse
        </ul>
    </div>
</div>

<div class="card mb-3">
    <div class="card-header">
        Written sentences
    </div>
    <div class="card-body">
        <ul class="list-group list-group-flush">
            @forelse($user->stories as $story)
            <li class="list-group-item"><a href="{{route('stories.show',$story->id)}}">{{$story->title}}</a></li>
            @empty
            Nothing
            @endforelse
        </ul>
    </div>
</div>

<div class="card my-3">
    <div class="card-header">
        Comments
    </div>
    <div class="card-body">
        <ul class="list-group list-group-flush">
            @forelse($user->comments as $comment)
            <li class="list-group-item"><a href="{{route('stories.show',$comment->story_id)}}">{{$comment->text}}</a></li>
            @empty
            No followers
            @endforelse
        </ul>
    </div>
</div>

<!-- <div class="card">
  <div class="card-header">
    Followers
  </div>
  <div class="card-body">
  <table class="table">
    <thead>
      <tr>
        <th scope="col">Users</th>
      </tr>
    </thead>
    <tbody>
      @foreach($user->followers as $flw)
      <tr>
        <td><a href="{{route('users.show',$user->id)}}">{{$flw->name}}</a></td>
      </tr>
      @endforeach
    </tbody>
  </table>
  </div>
</div> -->
@endsection
