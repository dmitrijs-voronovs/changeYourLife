<div class="container">
<!-- Card deck -->
<style>
  .posts{
    display:grid;
    grid-template-columns:repeat(3, 1fr);
    grid-gap: 15px;
  }
</style>

<div class="card p-3 mb-3">
  <h1 id="{{$class}}">{{$heading}}</h1>
  <div class="posts mt-2 ">
  @foreach($stories as $story)
      <!-- @if ($loop->index%2 == 0) 
          <div class="row">
      @endif -->
    <!-- Card -->
    @php
      if ($story->finished){
        $class = 'warning';
      } else {
        $class = ($story->open)?'success':'primary';
      }
    @endphp
  <div class="card pl-2 border border-{{$class}}">
    <blockquote class="p-2 pt-3 blockquote">
      <p class="mb-0">{{$story->title}}</p>
      <footer class="blockquote-footer"><cite title="Source Title">{{$story->author->name}} <a href="{{route('stories.show',$story->id)}}">Read</a></cite></footer>
    </blockquote>
  </div>

  @endforeach
  {{$slot}}
  </div>
</div>

{{$slot}}

</div>