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
    @if(\App\Story::findOrFail($story_id)->user_id==$author_id)
    <div class="custom-control custom-checkbox mb-2">
        <input type="checkbox" class="custom-control-input" name="finish" id="finish">
        <label class="custom-control-label" for="finish">Finish your story with this sentence?</label>
    </div>
    @endif

    <input hidden class="form-control" name="story_id" value="{{ $story_id }}" required/>
    <input hidden class="form-control" name="author_id" value="{{ $author_id }}" required/>
    <button type='submit' class='mt-2 btn btn-primary'>Create</button>
</form>
@endsection