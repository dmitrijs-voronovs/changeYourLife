@extends('layouts.app')
@section('content')

<div class="card mb-3">
  <div class="card-body">
    <div class="h3">
        Top keywords
    </div>
    <hr>
    @forelse($keywords_top as $keyword)
        <a class="rounded-pill m-2 btn btn-primary" href="{{route('keywords.show',$keyword->id)}}">
        #{{$keyword->word}} <span class="badge badge-light">{{$keyword->total}}</span>
        </a>
    @empty
        <h2>No keywords</h2>
    @endforelse
  </div>
</div>

<div class="card">
  <div class="card-body">
    <div class="h3">
        All keywords
    </div>
    <hr>
    @forelse($keywords as $keyword)
        <a class="rounded-pill m-2 btn btn-primary" href="{{route('keywords.show',$keyword->id)}}">
        #{{$keyword->word}} <span class="badge badge-light">{{$keyword->stories->count()}}</span>
        </a>
    @empty
        <h2>No keywords</h2>
    @endforelse
  </div>
</div>
@endsection