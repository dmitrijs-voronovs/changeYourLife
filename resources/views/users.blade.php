@extends('layouts.app')

@section('content')
<div class="card m-4 col-10">
<!-- Card content -->
  <div class="card-body">
  <table class="table">
    <thead>
      <tr>
        <th scope="col">User</th>
        <th scope="col">Sentences written</th>
        <th scope="col">Stories created</th>
        <th scope="col">Followers</th>
      </tr>
    </thead>
    <tbody>
      @foreach($users as $user)
      <tr>
        <td><a href="{{route('users.show',$user->id)}}">{{$user->name}}</a></td>
        <td>{{\App\Sentence::where('author_id',$user->id)->count()}}</td>
        <td>{{\App\Story::where('user_id',$user->id)->count()}}</td>
        <td>{{$user->followers->count()}}</td>
      </tr>
      @endforeach
    </tbody>
  </table>
  </div>
</div>
@endsection