@extends('layouts.app')
@section('content')
@foreach($errors->all() as $er)
    {{$er}}<br>
@endforeach
<form class="border border-light p-4" action="{{route('stories.store')}}" method="POST">
    @csrf
    <div class="form-group">
        <label for="title">Story Title</label>
        <input class="form-control" name="title" value="{{ old('title') }}" placeholder="Enter title" required/>
        @if ($errors->has('title'))
            <span class="invalid-feedback">
                <strong>{{ $errors->first('title') }}</strong>
            </span>
        @endif
    </div>


    <div class="form-group">
        <div class="accordion" id="accordionExample">
            

            <div class="card">
                <div class="card-header" id="headingTwo">
                <h2 class="mb-0">
                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                    Write your own keywords
                    </button>
                </h2>
                </div>
                <div id="collapseTwo" class="collapse show" aria-labelledby="headingTwo" data-parent="#accordionExample">
                <div class="card-body">
                        <label for="custom_keywords">Enter comma separated keywords</label>
                        <textarea class="form-control" name="custom_keywords" rows="3" placeholder="e.g. Science fiction, Halloween, Animals">{{ old('custom_keywords') }}</textarea>
                        @if ($errors->has('custom_keywords'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('custom_keywords') }}</strong>
                            </span>
                        @endif
                </div>
                </div>
            </div>
        
            <div class="card">
                <div class="card-header" id="headingOne">
                <h2 class="mb-0">
                    <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                    Choose from existing ones
                    </button>
                </h2>
                </div>

                <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                <div class="card-body">
                        <div class="d-table">
                            @forelse($keywords as $keyword)
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" name="kw[]" value="{{$keyword->id}}" id="kw[{{$keyword->id}}]" {{( (is_array(old('kw')) && in_array($keyword->id, old('kw'))) )?' checked':''}}>
                                <label class="custom-control-label" for="kw[{{$keyword->id}}]">#{{$keyword->word}}</label>
                            </div>    
                            @empty
                                Oops, there are no keywords. Please, create your own keywords above
                            @endforelse
                        </div>
                </div>
                </div>
            </div>

        </div> 
    </div>
    
    <div class="form-group">
        <label for="sentence">First sentence</label>
        <textarea class="form-control" name="sentence" rows="3" placeholder="Enter sentence" " required>{{old('sentence')}}</textarea>
        @if ($errors->has('sentence'))
            <span class="invalid-feedback">
                <strong>{{ $errors->first('sentence') }}</strong>
            </span>
        @endif
    </div>

    <button type='submit' class='mt-2 btn btn-primary'>Create</button>
</form>
@endsection