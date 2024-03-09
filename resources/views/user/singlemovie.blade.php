@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
       <div class="col-md-12">
      <div class="row justify-content-center">
        @foreach($movie as $value)
        <div class="col-md-12 mt-3 mb-3">
                

                <div class="card" >
  
    <div style="background-image: url(
'{{url('/images')}}/{{$value->movie_image_path}}');height: 650px; background-position: top; background-repeat: no-repeat; background-size: cover;">
          </div>

  <div class="card-body">
    <h5 class="card-title">{{$value->title}}</h5>
    <p class="card-text">Publication Date {{date('d-m-Y',strtotime($value->publication_date))}}</p>
    <p class="card-text">{{$value->description}}</p>
    <p class="card-text">Runtime {{$value->runtime}}</p>
    <p class="card-text">IMDB rating {{$value->IMDB_rating}}</p>
  </div>
</div>
        </div>
        @endforeach
    </div>
    </div>
    </div>
</div>
@endsection
