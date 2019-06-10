<div class="card mb-3">
    <div class="card-body">
        <h5 class="card-title"><a href="{{route('users.show',$comment->user->id)}}">{{$comment->user->name}}</a> <a class="text-muted" href="{{route('comments.show',$comment->id)}}">#{{$comment->id}}</a></h5>
        <p class="card-text">{{$comment->text}}</p>
        
        @component('components.rating',['instance'=>$comment])
        @endcomponent
    </div>
</div>