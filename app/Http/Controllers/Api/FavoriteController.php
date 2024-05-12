<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\favorite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{

    public function getCheckFavorites($mediaId)
    {   
        $userId = auth()->id();
        // Busca las favoritas para el usuario en especifico
        $favorites = favorite::where('id_user', $userId)
        ->where('id_media_show', $mediaId)
        ->get();
        return response()->json($favorites);
    }
    
    
}