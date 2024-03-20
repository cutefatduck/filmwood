<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\p_pemi;
use Illuminate\Http\Request;

class PemiController extends Controller
{

    public function view(){
        $pemi = p_pemi::all()->toArray();
        return $pemi;
    }
}