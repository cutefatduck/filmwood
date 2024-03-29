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

    public function view($id)
    {
        try {
            $media = p_media_show::with('country', 'mediaShowType', 'genre', 'pemi')->findOrFail($id);
            // Agregar la ruta completa de la imagen de portada
            $media->portada_img = asset('images/' . $media->portada_img);
            return response()->json(['success' => true, 'data' => $media], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Error al obtener los detalles del medio show.'], 500);
        }
    }

    public function show($id)
    {
        $media = p_media_show::findOrFail($id);
        return view('media.show', compact('media'));
    }

    public function destroy($id)
    {
        $media = p_media_show::findOrFail($id);
        $media->delete();
        return response()->json(['message' => 'El registro ha sido eliminado correctamente']);
    }

    public function edit($id)
    {
        $media = p_media_show::findOrFail($id);
        return response()->json(['success' => true, 'data' => $media]);
    }

    public function create(Request $request)
    {

        dd($request->all());
        // Validar los datos del formulario
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
            'portada_img' => 'required|image|mimes:jpeg,png,jpg|max:2048', // Validación para imágenes
            'idioma' => 'required',
            'directores' => 'required',
            'trailer' => 'required|mimes:mp4|max:20480', // Validación para videos
            'saga',
            'episodios',
            'temporadas'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        // Subir y guardar la imagen
        $coverImage = $request->file('portada_img')->store('public/images');
        $coverImageUrl = Storage::url($coverImage);

        // Subir y guardar el video
        $trailer = $request->file('trailer')->store('public/videos');
        $trailerUrl = Storage::url($trailer);

        // Crear el Media Show
        $mediaShowData = $request->all();
        $mediaShowData['portada_img'] = $coverImageUrl;
        $mediaShowData['trailer'] = $trailerUrl;
        $mediaShow = p_media_show::create($mediaShowData);

        return response()->json(['success' => true, 'data' => $mediaShow]);
    }
}