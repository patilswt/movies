@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
     <div class="col-md-12">
      <div class="row justify-content-center">
        @foreach($movies as $movie)
        <div class="col-md-3 mt-3 mb-3">
                

                <div class="card" style="width: 18rem;">
  <!-- <img src="{{url('/images')}}/{{$movie->movie_image_path}}" class="card-img-top" alt="{{$movie->title}}"> -->

  <div style="background-image: url(
'{{url('/images')}}/{{$movie->movie_image_path}}');height: 200px; background-position: top; background-repeat: no-repeat; background-size: cover;">
          </div>
  <div class="card-body">
    <h5 class="card-title">{{substr($movie->title,0,30)}}</h5>
    <p class="card-text">{{$movie->publication_date}}</p>
    <a href="/movie/{{$movie->id}}" class="btn btn-primary">view more</a>
  </div>
</div>
        </div>
        @endforeach
    </div>
    </div>
    </div>
</div>



<!-- <i class="fas fa-bell fa-lg position-relative mt-3 pr-5" >
     <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
    {{ count(auth()->user()->unreadNotifications) }}
    <span class="visually-hidden">unread messages</span>
  </span>
</i> -->





@endsection
