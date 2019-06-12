@extends('layouts.app')
@section('content')

<script type="text/javascript">
$(document).ready(function () {
    $("#search").keyup(function () {
        const CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $.post("{{route('stories.postSearch')}}", { search: $('#search').val(), _token: CSRF_TOKEN }, (data)=> {
            console.log(data);
            $('#ins_st').html('');
            $('#ins_c').html('');
            $('#ins_u').html('');
            $('#ins_k').html('');
            $.each(data[0], function(i, obj) {
                let c ='<li class="list-group-item"><a href="/stories/'+obj.id+'">'+obj.title+'</a></li>';
                $('#ins_st').append(c);
            });
            $.each(data[1], function(i, obj) {
                let c ='<li class="list-group-item"><a href="/comments/'+obj.id+'">'+obj.text+'</a></li>';
                $('#ins_c').append(c);
            });
            $.each(data[2], function(i, obj) {
                let c ='<li class="list-group-item"><a href="/users/'+obj.id+'">'+obj.name+'</a></li>';
                $('#ins_u').append(c);
            });
            $.each(data[3], function(i, obj) {
                let c ='<li class="list-group-item"><a href="/keywords/'+obj.id+'">'+obj.word+'</a></li>';
                $('#ins_k').append(c);
            });
        });
    })
});
</script>
<div class="card m-4 col-10">
<!-- Card content -->
    <div class="mx-3 mt-3 h1 card-title d-inline">Search 
        <small class="h4">for
        <a href="#sec_Stories">stories</a>,
        <a href="#sec_Comments">comments</a>,
        <a href="#sec_Users">users</a>,
        <a href="#sec_Keywords">keywords</a></small>
    </div>
    <div class="form-group mx-3"><input class="form-control" type="text" id="search"></div>
</div>

<div class="card m-4 col-10" id="sec_Stories">
  <div class="mx-3 mt-3 h3 card-title">Stories</div>
  <!-- <div class="card-body"> -->
    <ul class="list-group list-group-flush" id="ins_st">
    </ul>
  <!-- </div> -->
</div>

<div class="card m-4 col-10" id="sec_Comments">
  <div class="mx-3 mt-3 h3 card-title">Comments</div>
  <!-- <div class="card-body"> -->
    <ul class="list-group list-group-flush" id="ins_c">
    </ul>
  <!-- </div> -->
</div>

<div class="card m-4 col-10" id="sec_Users">
  <div class="mx-3 mt-3 h3 card-title">Users</div>
  <!-- <div class="card-body"> -->
    <ul class="list-group list-group-flush" id="ins_u">
    </ul>
  <!-- </div> -->
</div>

<div class="card m-4 col-10" id="sec_Keywords">
  <div class="mx-3 mt-3 h3 card-title">Keywords</div>
  <!-- <div class="card-body"> -->
    <ul class="list-group list-group-flush" id="ins_k">
    </ul>
  <!-- </div> -->
</div>


@endsection
