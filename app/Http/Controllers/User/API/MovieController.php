<?php

namespace App\Http\Controllers\User\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MovieModel;

class MovieController extends Controller
{
	public function index()
    {
        $movies = MovieModel::orderBy('id','desc')->get(["id","movie_image_path","title","description","publication_date","IMDB_rating","runtime","created_at"]);
       
        $response = ['success' => true,'data' => $movies, 'message' => 'Movies retrieved successfully.'];
        return response()->json($response, 200);
    }

    public function getMovie($id)
    {
        if(MovieModel::where("id",$id)->exists()){
            $movie = MovieModel::where("id",$id)->get(["id","movie_image_path","title","description","publication_date","IMDB_rating","runtime","created_at"]);
            $response = ['success' => true,'data' => $movie, 'Movie retrieved successfully.'];
            return response()->json($response, 200);
        }else{
            $response = ['success' => false, 'message' => 'Movie not found.'];       
            $response['data'] = ['error'=>'Movie not found'];
       
            return response()->json($response, 404);
        }   
    }

   

    
}
