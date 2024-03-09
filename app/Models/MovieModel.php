<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MovieModel extends Model
{
    use HasFactory;

    protected $table = "movies";

        
	protected $fillable = [
        'movie_image_path',
        'title',
        'description',
        'publication_date',
        'IMDB_rating', 
        'runtime', 
        'created_by', 
        'created_at'
    ];
    protected $guarded = [];

    public static function getMovies()
    {
    	  	
	    return self::all();
    }

}
