<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MovieModel;
use App\Models\User;
use App\Notifications\TestNotification;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $movies = MovieModel::where('created_by',Auth::user()->id)->orderBy('id','desc')->paginate(5);
        return view('movies.index', compact('movies'));
    }

    public function create()
    {
        return view('movies.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'movie_image_path' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'title' => 'required',
            'description' => 'required',
            'publication_date' => 'required',
            'IMDB_rating' => 'required',
            'runtime' => 'required',
        ]);
 
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
            'created_by' => Auth::user()->id,
            'created_at' => date('Y-m-d h:i:s')
        ];
          
        $movieId=MovieModel::insertGetId($data);
        $msg=['message'=>"New Movie listed !",'movieId'=>$movieId]; 
        $users = User::all();
        foreach($users as $user) {
            $user->notify(new TestNotification(array_merge($data,$msg)));
        }
// $users = User::all();
// Notification::send($users, new TicketAssignedNotification($ticket));


        // auth()->user()->notifications;
        // auth()->user()->unreadNotifications;
        // auth()->user()->readNotifications;
        return redirect()->route('movies.index')->with('success','Movie has been created successfully.');
    }

    public function show(MovieModel $movie)
    {
        return view('movies.show',compact('movies'));
    }

	public function edit(MovieModel $movie)
    {
        return view('movies.edit',compact('movie'));
    }
    
	public function update(Request $request, MovieModel $movie)
    {
        $request->validate([
            'movie_image_path' => 'image|mimes:jpeg,png,jpg|max:2048',
            'title' => 'required',
            'description' => 'required',
            'publication_date' => 'required',
            'IMDB_rating' => 'required',
            'runtime' => 'required',
        ]);
        
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
        MovieModel::where('created_by',Auth::user()->id)->where('id',$movie->id)->update($data);

        return redirect()->route('movies.index')->with('success','Movie Has Been updated successfully');
    }

     public function destroy(MovieModel $movie)
    {
        $movie->delete();
        return redirect()->route('movies.index')->with('success','Movie has been deleted successfully');
    }
}
