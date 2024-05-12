<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\media_show_type;
use Illuminate\Http\Request;

class TypeMediaShowController extends Controller
{

    public function view(){
        $media_show_type = media_show_type::all()->toArray();
        return $media_show_type;
    }
}