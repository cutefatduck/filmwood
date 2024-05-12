<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\genres;
use Illuminate\Http\Request;

class GenreController extends Controller
{

    public function view(){
        $genre = genres::all()->toArray();
        return $genre;
    }

    public function getMediaShowByGenre(){
        $genre = genres::with('mediaShows.pemi', 'mediaShows.genres')->get();
        return $genre; 
    }
    
    
}