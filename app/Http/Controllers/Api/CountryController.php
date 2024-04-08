<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\p_country;
use Illuminate\Http\Request;

class CountryController extends Controller
{

    public function view(){
        $country = p_country::all()->toArray();
        return $country;
    }

}