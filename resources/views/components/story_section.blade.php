<div class="container">
<!-- Card deck -->

<h1 id="{{$class}}">{{$heading}}</h1>

@foreach($stories as $story)
    @if ($loop->index%3 == 0) 
        <div class="row">
    @endif
  <!-- Card -->
  @php
    if ($story->finished){
      $class = ' bg-warning';
    } else {
      $class = ($story->open)?' bg-success':'';
    }
  @endphp
<div class="card m-4 col-3{{$class}}">

<!-- Card content -->
<div class="card-body">

  <!-- Title -->
  <h4 class="card-title">{{$story->title}}</h4>
  <!-- Text -->
  <p class="card-text">{{$story->author->name}}</p>
  <!-- Button -->
  <a href="{{route('stories.show',$story->id)}}" class="btn btn-primary">Read</a>

</div>

</div>
<!-- Card -->
@if ($loop->index%3 == 2 or $loop->index+1 == $stories->count()) 
    </div>
@endif
@endforeach

<!-- </div> -->
<!-- Card deck -->
{{$slot}}

</div>