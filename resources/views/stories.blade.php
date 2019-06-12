@extends('layouts.app')

@section('content')

<div class="row">
  <div class="col-10">
    @component('components.story_section',['class'=>'st_open','heading'=>'Opened for new authors','stories'=>$stories_o])
    @endcomponent

    @component('components.story_section',['class'=>'st_closed','heading'=>'Closed for new authors','stories'=>$stories_c])
    @endcomponent

    @component('components.story_section',['class'=>'st_finished','heading'=>'Finished stories','stories'=>$stories_f])
    @endcomponent
    
    @if(\Auth::user())
      @component('components.story_section',['class'=>'st_personal','heading'=>'Personal stories','stories'=>$stories_p])
      @endcomponent
    @endif

    @if(\Auth::user())
      @component('components.story_section',['class'=>'st_followers','heading'=>'Stories by followed authors','stories'=>$stories_fol])
      @endcomponent
    @endif


  </div>
  <div class="col-2">
    <ul class="sticky-top list-group">
      <li class="list-group-item"><a href="#st_open">{{__('messages.Opened')}}</a></li>
      <li class="list-group-item"><a href="#st_closed">{{__('messages.Closed')}}</a></li>
      <li class="list-group-item"><a href="#st_finished">{{__('messages.Finished')}}</a></li>
      @if(\Auth::user())
        <li class="list-group-item"><a href="#st_personal">{{__('messages.Personal')}}</a></li>
        <li class="list-group-item"><a href="#st_followers">{{__('messages.Followed_people')}}</a></li>
      @endif
    </ul>
  </div>
</div>

@endsection