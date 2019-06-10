@extends('layouts.app')
@section('content')

@component('components.comment',['comment'=>$comment])
@endcomponent
<a href="{{route('stories.show',$comment->story->id)}}">Go to story</a>

@endsection