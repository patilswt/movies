<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MovieModel;

class DashboardController extends Controller
{
    public function index()
    {
        $movies = MovieModel::getMovies();
        return view('user.dashboard',compact('movies'));
    }

    public function getMovie($id)
    {
        $movie = MovieModel::where("id",$id)->get();
        
        return view('user.singlemovie',compact('movie'));
    }
    
    public function getNotification()
    {        
        
        $notifications = json_encode(auth()->user()->notifications);
        $notifications = json_decode($notifications,true);
        return view('notifications.newmovie',compact('notifications'));
    }

    public function markAsRead($id)
    {
        $notification = auth()->user()->unreadNotifications->find($id);
        if($notification){
           return $notification->markAsRead();
        }
        return false;
    }
}
