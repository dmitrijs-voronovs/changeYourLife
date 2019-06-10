@extends('layouts.app')

@section('content')
<div class="card m-4 col-10">
<!-- Card content -->
  <div class="card-body">
  <table class="table">
    <thead>
      <tr>
        <th scope="col">User</th>
        <th scope="col">Total Written S.</th>
        <th scope="col">Sentence</th>
      </tr>
    </thead>
    <tbody>
      @foreach($sentences as $sentence)
      <tr>
        <td><a href="{{route('users.show',$sentence->author->id)}}">{{$sentence->author->name}}</a></td>
        <td>{{\App\Sentence::where('author_id',$sentence->author->id)->count()}}</td>
        <td><a href="{{route('stories.show',$sentence->story_id)}}">{{$sentence->text}}</a></td>
      </tr>
      @endforeach
    </tbody>
  </table>
  </div>
</div>
@endsection