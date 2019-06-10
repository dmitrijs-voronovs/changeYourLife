@php
    $likes = \DB::table('rateables')->where('rateable_type','App\Comment')->where('rateable_id',$comment->id)->where('like',1)->count();
    $dislikes = $comment->ratings->count() - $likes
@endphp
<div class="card mb-3">
    <div class="card-body">
        <h5 class="card-title"><a href="{{route('users.show',$comment->user->id)}}">{{$comment->user->name}}</a></h5>
        <p class="card-text">{{$comment->text}}</p>
        
        <div class="row">
            <!-- like button -->
            <form class="col-1" action="{{route('rating.create')}}" method="POST">
                @csrf
                <div class="form-group">
                    <input name="user_id" value="{{\Auth::user()->id}}" required hidden />
                    <input name="rateable_id" value="{{$comment->id}}" required hidden />
                    <input name="rateable_type" value="App\Comment" required hidden />
                    <input name="like" value="1" required hidden />
                </div>
                <button type="submit" class="btn-sm btn"><img src="https://img.icons8.com/dusk/16/000000/thumb-up.png"> {{$likes}}</button>
            </form>
            <!-- dislike button -->
            <form class="col-1" action="{{route('rating.create')}}" method="POST">
                @csrf
                <div class="form-group">
                    <input name="user_id" value="{{\Auth::user()->id}}" required hidden />
                    <input name="rateable_id" value="{{$comment->id}}" required hidden />
                    <input name="rateable_type" value="App\Comment" required hidden />
                    <input name="like" value="0" required hidden />
                </div>
                <button type="submit" class="btn-sm btn"><img src="https://img.icons8.com/dusk/16/000000/thumbs-down.png"> {{$dislikes}}</button>
            </form>
        </div>
    </div>
</div>