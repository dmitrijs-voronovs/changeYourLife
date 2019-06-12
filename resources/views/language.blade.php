@extends('layouts.app')

@section('content')
    <div class="card mb-2">
        <div class="card-body">
            <h5 class="card-title">{{__('messages.Current_language')}} : {{\App::getLocale()}}</a></h5>
            <hr>
            <p class="card-text">
                <h5 class="card-title">{{__('messages.change_language')}}</a></h5>

            <a class="btn btn-rounded btn-primary" href="{{route('change.language','en')}}">English</a>
            <a class="btn btn-rounded btn-primary" href="{{route('change.language','lv')}}">Latviešu</a>
            <a class="btn btn-rounded btn-primary" href="{{route('change.language','ru')}}">Русский</a>
            </p>
        </div>
    </div>
@endsection