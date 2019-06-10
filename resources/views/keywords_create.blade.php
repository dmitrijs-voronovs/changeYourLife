@extends('layouts.app')
@section('content')

<form action="{{route('keywords.store')}}" method="POST">
    @csrf
    <input type="text" id="word" name="word" placeholder="keyword"/>
    <input type="submit" class="btn btn-primary" value="Create">
    <div class="alert alert-primary" role="alert">
    @forelse($errors->all() as $error)
        {{$error}}
        <br>
    @empty
        <h2>No Errors</h2>
    @endforelse
    </div>
</form>
@endsection