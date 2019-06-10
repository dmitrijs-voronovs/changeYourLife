@extends('layouts.app')
@section('content')

@forelse($keywords as $keyword)
    <a type="button" class="m-2 btn btn-primary" href="{{route('keywords.show',$keyword->id)}}">
    {{$keyword->word}} <span class="badge badge-light">{{$keyword->total}} </span>
    </a>
@empty
    <h2>No keywords</h2>
@endforelse

@endsection