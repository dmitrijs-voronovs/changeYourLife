@extends('layouts.app')

@section('content')
    <div class="card mb-2">
        <div class="card-body">
            <h5 class="card-title">{{$sentence->author->name}} <a class="text-muted" href="{{route('sentences.show',$sentence->id)}}">#{{$sentence->id}}</a></h5>
            <p class="card-text">
                @if($sentence->trashed())<s>@endif
                    {{$sentence->text}}
                @if($sentence->trashed())</s>@endif
            </p>
            @component('components.rating',['instance'=>$sentence,'entity'=>'App\Sentence'])
            @endcomponent
        </div>
    </div>
    <a href="{{route('stories.show',$sentence->story_id)}}" class="m-3 pt-3">Go to the story</a>
@endsection