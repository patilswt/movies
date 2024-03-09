@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">   
        <div class="col-md-12 mt-3 mb-3">
                

          <div class="card" >
            <div class="card-body">
  
            <form action="{{ route('movies.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 mb-2">
                    <div class="form-group">
                        <strong>Movie Title:</strong>
                        <input type="text" name="title" id="title" class="form-control" placeholder="Movie Title">
                        @error('title')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>              

                <div class="col-xs-12 col-sm-12 col-md-12 mb-2">
                    <div class="form-group">
                        <strong>Movie Description:</strong>
                        <textarea rows="5" name="description" id="description"  class="form-control" placeholder="Movie Description"></textarea>
                        @error('description')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-xs-3 col-sm-3 col-md-3 mb-2">
                    <div class="form-group">
                        <strong>Movie Publication Date:</strong>
                        <input type="date" name="publication_date" id="publication_date" class="form-control" placeholder="Movie Publication Date">
                        @error('publication_date')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                 <div class="col-xs-3 col-sm-3 col-md-3 mb-2">
                    <div class="form-group">
                        <strong>Movie Runtime:</strong>
                        <input type="time" step="1" name="runtime" id="runtime" class="form-control">
                        @error('runtime')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                 <div class="col-xs-6 col-sm-6 col-md-6 mb-2">
                    <div class="form-group">
                        <strong>Movie IMDB rating:</strong>
                        <input type="text" name="IMDB_rating" id="IMDB_rating" class="form-control" placeholder="Movie IMDB rating">
                        @error('IMDB_rating')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                 <div class="col-xs-12 col-sm-12 col-md-12 mb-2">
                    <div class="form-group">
                        <strong>Movie Image:</strong>
                        <input type="file" name="movie_image_path" id="movie_image_path" class="form-control">
                        @error('movie_image_path')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                <button type="submit" class="btn btn-primary ml-3">Submit</button>
                </div>
            </div>
        </form>

            </div>
          </div>










        </div>       
    </div>
</div>
@endsection
