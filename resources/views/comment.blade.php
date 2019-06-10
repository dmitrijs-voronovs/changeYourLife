@extends('layouts.app')
@section('content')

@component('components.comment',compact('comment'))
@endcomponent
<!-- //additional information -->
<div class="card mb-3">
    <div class="card-header">
        Written sentences
    </div>
    <div class="card-body">
        <ul class="list-group list-group-flush">
            @forelse($comment->ratings as $rating)
                <li class="list-group-item"> 
                    @php 
                        if($rating->pivot->like) echo '<img class="mb-1" src="https://img.icons8.com/dusk/16/000000/thumb-up.png">';
                        else echo'<img src="https://img.icons8.com/dusk/16/000000/thumbs-down.png">'; 
                    @endphp
                    - <a href="{{route('users.show',$rating->pivot->user_id)}}">{{\App\User::findOrFail($rating->pivot->user_id)->name}}</a>
                </li>
            @empty
                No sentences
            @endforelse
        </ul>
    </div>
</div>
<a href="{{route('stories.show',$comment->story->id)}}">Go to story</a>

@endsection