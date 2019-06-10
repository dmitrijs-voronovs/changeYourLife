@php
    // count likes and dislikes
    $likes = \DB::table('rateables')->where('rateable_type',$entity ?? 'App\Comment')->where('rateable_id',$instance->id)->where('like',1)->count();
    $total = $instance->ratings->count();
    $dislikes = $total - $likes;

    //detect if current user has liked/disliked this comment
    $classL = '-outline'; //no like
    $classD = '-outline'; //no dislike
    $ratings = $instance->ratings()->where('user_id',\Auth::user()->id);
    if ($ratings->count()==1){
        if($ratings->first()->pivot->like==1) $classL='';
        else $classD='';
    }
@endphp
<div class="ml-2">
    <div class="row mb-2">
        <!-- like button -->
        <form class="px-1" action="{{route('rating.store')}}" method="POST">
            @csrf
                <input name="user_id" value="{{\Auth::user()->id}}" required hidden />
                <input name="rateable_id" value="{{$instance->id}}" required hidden />
                <input name="rateable_type" value="{{$entity ?? 'App\Comment'}}" required hidden />
                <input name="like" value="1" required hidden />
            <button type="submit" class="btn btn-sm btn{{$classL}}-primary"><img src="https://img.icons8.com/dusk/16/000000/thumb-up.png"> {{$likes}}</button>
        </form>
        <!-- dislike button -->
        <form class="px-1" action="{{route('rating.store')}}" method="POST">
            @csrf
                <input name="user_id" value="{{\Auth::user()->id}}" required hidden />
                <input name="rateable_id" value="{{$instance->id}}" required hidden />
                <input name="rateable_type" value="{{$entity ?? 'App\Comment'}}" required hidden />
                <input name="like" value="0" required hidden />
            <button type="submit" class="btn btn-sm btn{{$classD}}-primary"><img src="https://img.icons8.com/dusk/16/000000/thumbs-down.png"> {{$dislikes}}</button>
        </form>
    </div>
    <!-- progress bar -->
    <div class="row">
        <div style="height: 5px;width: 90px;" class="bg-{{($total==0)?'warning':'danger'}} progress p-0 ml-2">
            <div class="progress-bar" role="progressbar" style="width: {{($likes!=0)?$likes / $total * 100 : 0}}%" aria-valuenow="{{$likes}}" aria-valuemin="0" aria-valuemax="{{$total}}"></div>
        </div>
    </div>
</div>