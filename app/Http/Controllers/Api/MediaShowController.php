<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\p_media_show;
use App\Models\p_pemi;
use App\Models\p_genres;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MediaShowController extends Controller
{
    public function index()
    {
        $mediashow = p_media_show::all()->toArray();
        return $mediashow;
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required',
            'sinopsis_corta' => 'required',
            'sinopsis' => 'required',
            'fecha_media_show' => 'required',
            'id_country' => 'required',
            'id_media_show_type' => 'required',
            'id_genere' => 'required',
            'id_pemi' => 'required',
            'duracion' => 'required',
            'actores' => 'required',
            'portada_img' => 'required',
            'idioma' => 'required',
            'directores' => 'required',
            'trailer' => 'required',
            'fecha_media_show' => 'required',
            'saga',
            'episodios',
            'temporadas'
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => $validator->errors()], 400);
        }

        // Verificamos si el Pemi existe
        $pemi = p_pemi::find($request->id_pemi);
        if (!$pemi) {
            return response()->json(['success' => false, 'message' => 'El Pemi especificado no existe'], 400);
        }

        // Verificamos si el Pemi existe
        $genre = p_genres::find($request->id_genre);
        if (!$genre) {
            return response()->json(['success' => false, 'message' => 'El Genero especificado no existe'], 400);
        }

        $mediashowData = $request->all();
        // Asignamos el Pemi al medio show
        $mediashowData['id_pemi'] = $pemi->id;

        // Asignamos el Genero al medio show
        $mediashowData['id_genero'] = $genre->id;

        $mediashowRequest = p_media_show::create($mediashowData);

        return response()->json(['success' => true, 'data' => $mediashowRequest]);
    }
}
