<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\p_country; // Importa el modelo Pelicula
use Illuminate\Http\Request;

class CountryController extends Controller
{

    public function view(){
        $country = p_country::all()->toArray();
        return $country;
    }
}