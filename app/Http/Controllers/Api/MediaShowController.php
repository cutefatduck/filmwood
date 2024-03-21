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

    public function destroy($id)
    {
        $media = p_media_show::findOrFail($id);
        $media->delete();
        return response()->json(['message' => 'El registro ha sido eliminado correctamente']);
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

        $validator = Validator::make($request->all(), [
            // Asegúrate de incluir todas las reglas de validación necesarias
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => $validator->errors()], 400);
        }

        // Obtener el Pemi
        $pemi = p_pemi::find($request->id_pemi);
        if (!$pemi) {
            return response()->json(['success' => false, 'message' => 'El Pemi especificado no existe'], 400);
        }

        // Obtener el Género
        $genre = p_genres::find($request->id_genre);
        if (!$genre) {
            return response()->json(['success' => false, 'message' => 'El Género especificado no existe'], 400);
        }

        // Crear el medio show
        $mediashowData = $request->all();
        $mediashowData['id_pemi'] = $pemi->id;
        $mediashowData['id_genre'] = $genre->id;
        // Asigna otros campos y lógica según sea necesario

        $mediashowRequest = p_media_show::create($mediashowData);

        return response()->json(['success' => true, 'data' => $mediashowRequest]);
    }
}