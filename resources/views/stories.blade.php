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
  </div>
  <div class="col-2">
    <ul class="list-group sticky-top">
      <li class="list-group-item"><a href="#st_open">Open</a></li>
      <li class="list-group-item"><a href="#st_closed">Closed</a></li>
      <li class="list-group-item"><a href="#st_finished">Finished</a></li>
    </ul>
  </div>
</div>


@endsection