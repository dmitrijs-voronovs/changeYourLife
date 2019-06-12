@extends('layouts.app')
@section('content')
@foreach($errors->all() as $er)
    {{$er}}<br>
@endforeach
<form class="border border-light p-4" action="{{route('stories.update',$story->id)}}" method="POST">
    @csrf
    @method('PATCH')
    <div class="form-group">
        <label for="title">Story Title</label>
        <input class="form-control" name="title" value="{{ $story->title }}" placeholder="Enter title" required/>
        @if ($errors->has('title'))
            <span class="invalid-feedback">
                <strong>{{ $errors->first('title') }}</strong>
            </span>
        @endif
    </div>


    <div class="form-group">
        <label for="keywords">Enter comma separated keywords</label>
        <textarea class="form-control" name="keywords" rows="3" placeholder="e.g. Science fiction, Halloween, Animals">{{ $keywords }}</textarea>
        @if ($errors->has('keywords'))
            <span class="invalid-feedback">
                <strong>{{ $errors->first('keywords') }}</strong>
            </span>
        @endif
    </div>
    
    <div class="form-group">
        <label for="sentence">First sentence</label>
        <textarea class="form-control" name="sentence" rows="3" placeholder="Enter sentence" " required>{{$story->sentences()->orderBy('created_at','asc')->first()->text}}</textarea>
        @if ($errors->has('sentence'))
            <span class="invalid-feedback">
                <strong>{{ $errors->first('sentence') }}</strong>
            </span>
        @endif
    </div>

    <button type='submit' class='mt-2 btn btn-primary'>Update</button>
</form>
@endsection