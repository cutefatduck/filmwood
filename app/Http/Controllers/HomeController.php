<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\p_media_show;
use App\Models\p_genres;
use Illuminate\Support\Facades\View;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // Filtrar las películas por el género de terror
        $terrorMovies = p_media_show::whereHas('genre', function ($query) {
            $query->where('name_genre', 'Terror');
        })->get();

        // Pasar las películas de terror a la vista
        return View::make('home')->with('terrorMovies', $terrorMovies);
    }
}
