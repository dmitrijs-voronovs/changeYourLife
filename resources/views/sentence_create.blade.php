@extends('layouts.app')

@section('content')
<form class="border border-light p-4" action="{{route('sentences.store')}}" method="POST">
    @csrf
    <div class="form-group">
        <label for="text">Sentence</label>
        <input class="form-control" name="text" value="{{ old('text') }}" placeholder="Enter text" required autofocus />
        @if ($errors->has('text'))
            <span class="invalid-feedback">
                <strong>{{ $errors->first('text') }}</strong>
            </span>
        @endif
    </div>

    <input hidden class="form-control" name="story_id" value="{{ $story_id }}" required/>
    <input hidden class="form-control" name="author_id" value="{{ $author_id }}" required/>
    <input hidden class="form-control" name="prev_sentence_id" value="{{ $prev_sentence_id }}" required/>
    <button type='submit' class='mt-2 btn btn-primary'>Create</button>
@endsection