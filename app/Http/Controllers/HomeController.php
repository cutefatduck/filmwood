<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\p_media_show;
use App\Models\p_genres;

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
        $peliculasDeTerror = p_media_show::whereHas('genre', function ($query) {
            $query->where('name_genre', 'Terror');
        })->get();

        return view('home.index', compact('peliculasDeTerror'));
    }
}
