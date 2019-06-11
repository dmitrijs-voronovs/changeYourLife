@extends('layouts.app')
@section('content')

@forelse($keywords as $keyword)
    <a class="rounded-pill m-2 btn btn-primary" href="{{route('keywords.show',$keyword->id)}}">
    #{{$keyword->word}} <span class="badge badge-light">{{$keyword->stories->count()}}</span>
    </a>
@empty
    <h2>No keywords</h2>
@endforelse
    <!-- <br><a class="btn btn-primary m-2" href="{{route('keywords.top')}}">top keywords</a> -->

@endsection