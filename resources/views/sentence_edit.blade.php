@extends('layouts.app')

@section('content')
<form class="border border-light p-4" action="{{route('sentences.update',$sentence->id)}}" method="POST">
    @csrf
    @method('PATCH')
    <div class="form-group">
        <label for="text">Sentence</label>
        <input class="form-control" name="text" value="{{ $sentence->text }}" placeholder="Enter text" required/>
        @if ($errors->has('text'))
            <span class="invalid-feedback">
                <strong>{{ $errors->first('text') }}</strong>
            </span>
        @endif
    </div>
    <button type='submit' class='mt-2 btn btn-primary'>Update</button>
@endsection