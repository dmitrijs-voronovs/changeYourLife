@extends('layouts.app')

@section('content')

<div class="row">
  <div class="col-10">
    @component('components.story_section',['class'=>'st_open','heading'=>'Open for new authors','stories'=>$stories_o])
    @endcomponent

    @component('components.story_section',['class'=>'st_closed','heading'=>'Closed for new authors','stories'=>$stories_c])
    @endcomponent

    @component('components.story_section',['class'=>'st_finished','heading'=>'Finished stories','stories'=>$stories_f])
    @endcomponent
    
    @component('components.story_section',['class'=>'st_personal','heading'=>'Personal stories','stories'=>$stories_p])
    @endcomponent

    @component('components.story_section',['class'=>'st_followers','heading'=>'Stories Of followers','stories'=>$stories_fol])
    @endcomponent
  </div>
  <div class="sticky-top col-2">
    <ul class="list-group">
      <li class="list-group-item"><a href="#st_open">Open</a></li>
      <li class="list-group-item"><a href="#st_closed">Closed</a></li>
      <li class="list-group-item"><a href="#st_finished">Finished</a></li>
      <li class="list-group-item"><a href="#st_personal">Personal</a></li>
      <li class="list-group-item"><a href="#st_followers">Followed people</a></li>
    </ul>
  </div>
</div>

@endsection