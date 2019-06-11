@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{$sentence->author->name}} <a class="text-muted" href="{{route('sentences.show',$sentence->id)}}">#{{$sentence->id}}</a></h5>
            <p class="card-text">
                @if($sentence->trashed())<s>@endif
                    {{$sentence->text}}
                @if($sentence->trashed())</s>@endif
            </p>
            <a href="{{route('stories.show',$sentence->story_id)}}" class="btn btn-primary">Go to the story</a>
        </div>
    </div>
@endsection