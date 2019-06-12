@extends('layouts.app')
@section('content')

<script type="text/javascript">
$(document).ready(function () {
    $("#search").keyup(function () {
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $.post("/stories/search", { search: $('#search').val(), _token: CSRF_TOKEN }, function(data) {
            $('.stories').html('');
            $.each(data, function(i, story) {
                var c = '<div class="list-item-with-icon row">\n\
                             <div class="col-md-8">\n\
                               <h4><a href="/stories/'+story.id+'">'+story.title+'</a></h4>\n\
                           </div>';
                 $('.stories').append(c);
            });
        });
    })
});
</script>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><h4 class="card-title">Search</h4></div>
                <div class="card-body">
                    <input type="text" id="search">
                    <div class="card-text stories"></div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
