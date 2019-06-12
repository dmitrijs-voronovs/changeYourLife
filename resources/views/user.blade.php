@extends('layouts.app')

@section('content')
<div class="card mb-3">
    <div class="card-header">
        Info
    </div>
    <div class="card-body ml-3">
        <h3 class="card-title">{{$user->name}} - <div class="text-muted d-inline">{{$user->email}}</div></h3>
        <p class="card-text"><br>
        <a href="{{route('followers',$user->id)}}">{{$user->followers->count()}} {{str_plural('follower',$user->followers->count())}}</a></p>
        
        @if(\Auth::user()->id != $user->id)
            <form class="d-inline" action={{route('follow',$user->id)}} method="POST">
                @csrf
                @method("PATCH")
                <input type="text" name="followable_id" value="{{$user->id}}" hidden/>
                <input type="text" name="followable_type" value="App\User" hidden/>
                <input type="text" name="user_id" value="{{\Auth::id()}}" hidden/>
                <input type="submit" class="btn btn-primary" value="{{(\DB::table('followables')->where('user_id',\Auth::id())->where('followable_type','App\User')->where('followable_id',$user->id)->count())?'Unfollow':'Follow'}}"/>
            </form>
            @if(\Auth::user()->isAdmin() && \Auth::id()!=$user->id)
                <form class="d-inline" action={{route('users.destroy',$user->id)}} method="POST">
                    @csrf
                    @method("DELETE")
                    <input type="submit" class="btn btn-danger" value="Delete"/>
                </form>
            @endif
        @endif

    </div>
</div>

<div class="card mb-3">
    <div class="card-header">
        Created stories
    </div>
    <div class="card-body">
        <ul class="list-group list-group-flush">
            @forelse($user->stories as $story)
                <li class="list-group-item">
                <div class="row">
                    <div class="col-10">
                        <a href="{{route('stories.show',$story->id)}}">{{$story->title}}</a>
                    </div>
                    <div class="col-2">
                        @component('components.rating',['instance'=>$story,'entity'=>'App\Story'])
                        @endcomponent            
                    </div>
                </div>
                </li>
            @empty
                No stories
            @endforelse
        </ul>
    </div>
</div>

<div class="card mb-3">
    <div class="card-header">
        Written sentences
    </div>
    <div class="card-body">
        <ul class="list-group list-group-flush">
            @forelse($user->sentences as $sentence)
                <li class="list-group-item">
                    <div class="row">
                        <div class="col-10">    
                            <a href="{{route('sentences.show',$sentence->id)}}">{{$sentence->text}}</a>
                        </div>
                        <div class="col-2">
                            @component('components.rating',['instance'=>$sentence,'entity'=>'App\Sentence'])
                            @endcomponent            
                        </div>
                    </div>
                </li>
            @empty
                No sentences
            @endforelse
        </ul>
    </div>
</div>

<div class="card my-3">
    <div class="card-header">
        Comments
    </div>
    <div class="card-body">
        <ul class="list-group list-group-flush">
            @forelse($user->comments()->orderBy('created_at','desc')->get() as $comment)
                <!-- <li class="list-group-item"><a href="{{route('stories.show',$comment->story_id)}}">{{$comment->text}}</a></li> -->
                @component('components.comment',compact('comment'))
                @endcomponent
            @empty
                No comments
            @endforelse
        </ul>
    </div>
</div>
@endsection
