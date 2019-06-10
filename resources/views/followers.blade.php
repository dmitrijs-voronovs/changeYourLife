@extends('layouts.app')

@section('content')
<h1>{{$user->name}}</h1>
<h2>{{$user->followers->count()}} {{str_plural('follower',$user->followers->count())}}</h2>
<div class="card my-3">
    <div class="card-header">
        Followers
    </div>
    <div class="card-body">
        <ul class="list-group list-group-flush">
            @forelse($user->followers as $follower)
            <li class="list-group-item"><a href="{{route('users.show',$follower->id)}}">{{$follower->name}}</a></li>
            @empty
            No followers
            @endforelse
        </ul>
    </div>
</div>
@endsection
