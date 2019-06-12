@extends('layouts.app')
@php
  if ($story->finished){
    $class = 'warning';
  } else {
    $class = ($story->open)?'success':'primary';
  }
@endphp

@section('content')

<div class="card border border-{{$class}}">
    <!-- Card content -->
    <div class="card-body">

        <!-- Title -->
        <h2 class="card-title mt-1">{{$story->title}}</h4>
        <!-- Text -->
        <h4 class="card-text mb-3"><a href="{{route('users.show',$story->author->id)}}">{{$story->author->name}}</a></h4>
        <hr>
        <!-- Button -->
        <p class="pb-1">
            @forelse($story->keywords as $keyword)
                <a class="rounded-pill mr-2 btn-sm btn-primary" href="{{route('keywords.show',$keyword->id)}}">#{{$keyword->word}}</a>
            @empty
            No keywords
            @endforelse
        </p>
        @component('components.rating',['instance'=>$story,'entity'=>'App\Story'])
        @endcomponent

        <table class="table mt-2">
            <thead>
                <tr>
                    <th scope="col">User</th>
                    <th scope="col">sentence</th>
                    <th scope="col">actions</th>
                    <th scope="col">contributions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($story->sentences()->withTrashed()->get() as $sentence)
                @php $del=0; @endphp
                <tr>
                    <td>    
                        @if(!$sentence->trashed() || \DB::table('users')->where('id',$sentence->author_id)->count())
                            <a href="{{route('users.show',$sentence->author->id)}}">{{$sentence->author->name}}</a>
                        @else
                            deleted
                            @php $del=1; @endphp
                        @endif
                    </td>
                    <td>
                        @if($sentence->trashed())<s>@endif
                            <a href="{{route('sentences.show',$sentence->id)}}">#{{$sentence->id}}</a> {{$sentence->text}}
                        @if($sentence->trashed())</s>@endif
                    </td>
                    <td style="width:150px" class="p-1 {{(!$loop->first)?'d-flex':''}}">
                    @if((!$loop->first && !($loop->last && $story->finished))&& (\Auth::user()->isAdmin() || \Auth::user()->id == $story->user_id) && !($del))
                        <form class="pr-1" action="{{route('sentences.destroy',$sentence->id)}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <input type="submit" class="btn btn-{{($sentence->trashed())?'success':'danger'}}" value="{{($sentence->trashed())?'Restore':'Delete'}}"/>
                        </form>
                    @endif
                    @if(( !$loop->first  && !($loop->last && $story->finished)) && (\Auth::user()->id == $story->user_id) && !($del))
                        <a class="btn btn-warning" href="{{route('sentences.edit',$sentence->id)}}">Edit</a>
                    @endif
                    </td>
                    <td class="text-center">
                        @if(!$sentence->trashed())
                            {{App\Sentence::where('author_id',$sentence->author->id)->where('story_id',$story->id)->count()}}
                        @endif 
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <a href="{{route('stories.show',$story->id)}}" class="btn btn-primary">Back</a>
        <a href="{{route('stories.edit.main',$story->id)}}" class="btn btn-primary">Edit main parametres</a>
        <form class="d-inline" action="{{route('stories.edit.open',$story->id)}}" method="POST">
            @csrf
            <input type="submit" href="{{route('stories.edit.main',$story->id)}}" class="btn btn-warning" value="Make story {{$story->open?'closed':'opened'}}" />
        </form>
    </div>
</div>

<h4 class="mt-3 card-title">Comments</h4>

@foreach($story->comments()->orderBy('created_at','desc')->get() as $comment)
    @component('components.comment',compact('comment'))
    @endcomponent
@endforeach

@endsection
