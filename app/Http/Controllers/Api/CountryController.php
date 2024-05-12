<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\country;
use Illuminate\Http\Request;

class CountryController extends Controller
{

    public function view(){
        $country = country::all()->toArray();
        return $country;
    }

}