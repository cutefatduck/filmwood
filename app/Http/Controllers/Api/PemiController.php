<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\pemi;
use Illuminate\Http\Request;

class PemiController extends Controller
{

    public function view(){
        $pemi = pemi::all()->toArray();
        return $pemi;
    }
}