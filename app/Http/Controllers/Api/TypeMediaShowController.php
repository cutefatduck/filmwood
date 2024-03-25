<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\p_media_show_type;
use Illuminate\Http\Request;

class TypeMediaShowController extends Controller
{

    public function view(){
        $p_media_show_type = p_media_show_type::all()->toArray();
        return $p_media_show_type;
    }
}