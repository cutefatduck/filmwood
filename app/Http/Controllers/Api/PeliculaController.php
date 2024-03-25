<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\p_media_show;
use App\Models\p_pemi;
use App\Models\p_genres;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PeliculaController extends Controller
{
    public function index()
    {
        $mediashow = p_media_show::all()->toArray();
        return $mediashow;
    }

}