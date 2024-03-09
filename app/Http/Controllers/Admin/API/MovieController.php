<?php

namespace App\Http\Controllers\Admin\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MovieModel;
use App\Models\User;
use App\Notifications\TestNotification;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class MovieController extends Controller
{
    public function index()
    {
        $movies = MovieModel::orderBy('id','desc')->get(["id","movie_image_path","title","description","publication_date","IMDB_rating","runtime","created_at"]);
       
        $response = ['success' => true,'data' => $movies, 'message' => 'Movies retrieved successfully.'];
        return response()->json($response, 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'movie_image_path' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'title' => 'required',
            'description' => 'required',
            'publication_date' => 'required',
            'IMDB_rating' => 'required',
            'runtime' => 'required',
        ]);
   
        if($validator->fails()){ 
            $response = ['success' => false, 'message' => 'Validation Error.'];       
            $response['data'] = $validator->errors();
       
            return response()->json($response);     
        }
 
        $image= $request->file('movie_image_path');
        $filename = time() . '.' . $image->getClientOriginalExtension();
        
        $image->move(public_path('/images'), $filename);
        $data=[
            'movie_image_path' => $filename,
            'title' => $request->title,
            'description' => $request->description,
            'publication_date' => $request->publication_date,
            'IMDB_rating' => $request->IMDB_rating,
            'runtime' => $request->runtime,
            'created_by' => auth()->user()->id,
            // 'created_by' => auth('sanctum')->user()->id,
            'created_at' => date('Y-m-d h:i:s')
        ];
          
        $movieId=MovieModel::insertGetId($data);

        $msg=['message'=>"New Movie listed !",'movieId'=>$movieId]; 
        $users = User::all();
        foreach($users as $user) {
            $user->notify(new TestNotification(array_merge($data,$msg)));
        }

        $success['movieId'] =  $movieId;
        $response = ['success' => true,'data' => $success, 'message' => 'Movie has been created successfully.'];
        return response()->json($response, 200);
    }

 

	public function show($id)
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
    
	public function update(Request $request, MovieModel $movie)
    {      
        $validator = Validator::make($request->all(), [
            'movie_image_path' => 'image|mimes:jpeg,png,jpg|max:2048',
            'title' => 'required',
            'description' => 'required',
            'publication_date' => 'required',
            'IMDB_rating' => 'required',
            'runtime' => 'required',
        ]);
   
        if($validator->fails()){ 
            $response = ['success' => false, 'message' => 'Validation Error.'];       
            $response['data'] = $validator->errors();
       
            return response()->json($response);     
        } 

        $data=[
            'title' => $request->title,
            'description' => $request->description,
            'publication_date' => $request->publication_date,
            'IMDB_rating' => $request->IMDB_rating,
            'runtime' => $request->runtime
        ];
        if($request->hasFile('movie_image_path')){
            unlink(public_path('/images').$movie->movie_image_path);
            $image= $request->file('movie_image_path');
            $filename = time() . '.' . $image->getClientOriginalExtension();
        
            $image->move(public_path('/images'), $filename);
            $data['movie_image_path'] = $filename;        
        }
        MovieModel::where('id',$movie->id)->update($data);


        $success['movieId'] =  $movieId;
        $response = ['success' => true,'data' => $success, 'message' => 'Movie has been updated successfully.'];
        return response()->json($response, 200);

    }

 
}
