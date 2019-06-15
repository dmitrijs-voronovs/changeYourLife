@extends('layouts.app')
@section('content')

<style>
    .colored{
        background : #e9ecef;
    }
    .frst{
        border-top:0;
    }
    .list-group-item span{
      top: -2px;
      left: 7px;
    }
</style>

<div class="jumbotron colored">
  <h1 class="display-4">{{__('messages.greeting')}}</h1>
  <p class="lead">{{__('messages.description')}}</p>
  <hr class="my-4">
  {{__('messages.explore')}}:
  <ul class="list-group list-group-flush">
    <li class="list-group-item colored frst position-relative"><a class="h5" href="{{route('stories.index')}}">{{__('messages.Stories')}}</a> <span class="position-relative badge badge-primary badge-pill">{{\App\Story::count()}}</span></li>
    <li class="list-group-item colored"><a class="h5" href="{{route('keywords.index')}}">{{__('messages.Keywords')}}</a> <span class="position-relative badge badge-primary badge-pill">{{\App\Keyword::count()}}</span></li>
    <li class="list-group-item colored"><a class="h5" href="{{route('users.index')}}">{{__('messages.Sentences')}}</a> <span class="position-relative badge badge-primary badge-pill">{{\App\Sentence::count()}}</span></li>
    <li class="list-group-item colored"><a class="h5" href="{{route('sentences.index')}}">{{__('messages.Authors')}}</a> <span class="position-relative badge badge-primary badge-pill">{{\App\User::count()}}</span></li>
    <li class="list-group-item colored"><a class="h5" href="{{route('stories.search')}}">{{__('messages.Search')}}</a> </li>
  </ul>
</div>
@endsection