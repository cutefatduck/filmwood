<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\p_genres;
use Illuminate\Http\Request;

class GenreController extends Controller
{

    public function view(){
        $genre = p_genres::all()->toArray();
        return $genre;
    }

    public function getMediaShowByGenre(){
        $genre = p_genres::with('mediaShows.pemi')->get();
        return $genre; 
    }
    
    
}