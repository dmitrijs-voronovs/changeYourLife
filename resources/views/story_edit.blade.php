@extends('layouts.app')

@section('content')
  @php
    if ($story->finished){
      $class = ' bg-warning';
    } else {
      $class = ($story->open)?' bg-success':'';
    }
  @endphp
<div class="card m-4 col-10">
<!-- Card content -->
  <div class="card-body">

    <!-- Title -->
    <h4 class="card-title{{$class}}">{{$story->title}}</h4>
    <!-- Text -->
    <p class="card-text">{{$story->author->name}}</p>
    <!-- Button -->
    <p>
      @forelse($story->keywords as $keyword)
        {{$keyword->word}}, 
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
        <th scope="col">actions</th>
      </tr>
    </thead>
    <tbody>
      @foreach($story->sentences as $sentence)
      <tr>
        <td>{{$sentence->author->name}}</td>
        <td>{{$sentence->text}}</td>
        <td>{{App\Sentence::where('author_id',$sentence->author->id)->where('story_id',$story->id)->count()}}</td>
        <td>
            <a type="button" class="btn btn-danger">Delete</a>
            <a type="button" href="{{route('sentences.edit',$sentence->id)}}" class="btn btn-warning">Edit</a>
            <a type="button" class="btn btn-info">wuit?</a>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>    
    <a href="{{route('stories.index')}}" class="btn btn-primary">back</a>
  </div>

</div>
@endsection