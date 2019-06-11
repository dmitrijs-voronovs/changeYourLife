@extends('layouts.app')
@section('content')

<form class="border border-light p-4" action="{{route('comments.update',$comment->id)}}" method="POST">
    @csrf
    @method('PATCH')
    <div class="form-group">
        <label for="text">Comment text</label>
        <textarea id="text" class="form-control" name="text" rows="3"
            placeholder="Enter comment">{{$comment->text}}</textarea>
        @if ($errors->has('text'))
        <span class="invalid-feedback">
            <strong>{{ $errors->first('text') }}</strong>
        </span>
        @endif
        <input name="story_id" value="{{$comment->story_id}}" required hidden />
        <input name="user_id" value="{{\Auth::user()->id}}" required hidden />
    </div>
    <button type="submit" class="mt-2 btn btn-primary">Update</button>
</form>

@endsection
