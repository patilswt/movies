@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
             <div class="col-md-12 mt-3 mb-3">
                
                <div class="pull-right mb-2">
                    <a class="btn btn-success" href="{{ route('movies.create') }}"> Create Movie</a>
                </div>
            </div>
        </div>
    <div class="row justify-content-center">
      
       
        <div class="col-md-12 mt-3 mb-3">
                

              
        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>S.No</th>
                    <th>Movie Img</th>
                    <th>Movie Title</th>
                    <th>Movie Description</th>
                    <th>Movie Publication Date</th>
                    <th width="280px">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($movies as $movie)
                    <tr>
                        <td>{{ $movie->id }}</td>
                        <td width="10%">
  <img src="{{url('/images')}}/{{$movie->movie_image_path}}" class="card-img-top img-thumbnail img-fluid" alt="{{$movie->title}}" ></td>
                        <td>{{ $movie->title }}</td>
                        <td>{{ substr($movie->description,0,100) }} ...</td>
                        <td>{{date('d-m-Y',strtotime($movie->publication_date))}}</td>
                        <td><a class="btn btn-primary" href="{{ route('movies.edit',$movie->id) }}">Edit</a>
                            
                            
                        </td>
                    </tr>
                    @endforeach
            </tbody>
        </table>
        {!! $movies->links() !!}
        </div>
       
    </div>
</div>
@endsection
