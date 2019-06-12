@extends('layouts.app')

@section('content')
<h1>{{$user->name}}</h1>
<div class="card my-3">
    <div class="card-header">
        Has {{$user->followers->count()}} {{str_plural('follower',$user->followers->count())}}
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

<div class="card my-3">
    <div class="card-header">
        Follows {{$user->followed_users->count()}} {{$user->followed_users->count()==1?'person':'people'}}
    </div>
    <div class="card-body">
        <ul class="list-group list-group-flush">
            @forelse($user->followed_users as $follower)
            <li class="list-group-item"><a href="{{route('users.show',$follower->id)}}">{{$follower->name}}</a></li>
            @empty
            No followers
            @endforelse
        </ul>
    </div>
</div>
<a href="{{route('users.show',$user->id)}}" class="btn btn-primary">back</a>
@endsection
