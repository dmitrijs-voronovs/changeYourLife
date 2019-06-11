<div class="card mb-3">
    <div class="card-body position-relative">
        @if(\Auth::user()->isAdmin() || \Auth::user()->id == $comment->user_id)
        <form action="{{route('comments.destroy',$comment->id)}}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="close" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </form>
        <a href="{{route('comments.edit',$comment->id)}}" class="close mr-1" aria-label="Close">
            <img src="https://img.icons8.com/material-two-tone/18/000000/pencil-tip.png">
        </a>
        @endif
        <h5 class="card-title"><a href="{{route('users.show',$comment->user->id)}}">{{$comment->user->name}}</a> <a class="text-muted" href="{{route('comments.show',$comment->id)}}">#{{$comment->id}}</a></h5>
        <p class="card-text">{{$comment->text}}</p>
        
        @component('components.rating',['instance'=>$comment])
        @endcomponent
    </div>
</div>