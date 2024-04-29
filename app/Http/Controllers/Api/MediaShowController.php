<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\p_media_show;
use App\Models\p_media_show_genres;
use App\Models\p_favorite;
use App\Models\p_visualized;
use App\Models\p_pemi;
use App\Models\p_media_show_type;
use App\Models\p_genres;
use App\Models\p_valorations;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MediaShowController extends Controller
{

    // Obtenemos todas las valoraciones de una media show en conreto:
    public function getMediaShowValorations($mediaShowId)
    {
        // Busca las valoraciones para el medio show específico
        $valoraciones = p_valorations::with('user')->where('id_media_show', $mediaShowId)->get();
        return response()->json($valoraciones);
    }

    // Obtenemos todas las media shows guardadas en favoritos de un user en concreto:
    public function getMediaShowFavorites($userID)
    {
        // Busca las favoritas para el user en especifico
        $favorites = p_favorite::where('id_user', $userID)->get();
        return response()->json($favorites);
    }

    // Obtenemos todas las media shows guardadas en visualizadas de un user en concreto:
    public function getMediaShowVisualizated($userID)
    {
        // Busca las visualizadas para el user en especifico
        $visualizated = p_visualized::where('id_user', $userID)->get();
        return response()->json($visualizated);
    }

    // Verificar si el usuario ha creado una valoración para un medio específico
    public function checkIfValuated($mediaShowId)
    {
        $userId = auth()->id();
        
        $valuated = p_valorations::where('id_user', $userId)
                                 ->where('id_media_show', $mediaShowId)
                                 ->exists();

        // Definimos la imagen predeterminada
        $imageSrc = '/images/no_valoration.svg';
        
        // Si la media show está valorada por el usuario, cambiamos la imagen
        if ($valuated) {
            $imageSrc = '/images/valoration.svg';
        }
                            
        return response()->json(['isValoration' => $valuated, 'imageSrc' => $imageSrc]);
    }

    public function addValorations(Request $request)
    {
        // Recogemos el ID del usuario actual para añadirlo a la base de datos:
        $userId = auth()->id();
        
        // Validación de los datos recibidos
        $validator = Validator::make($request->all(), [
            'id_user' => 'required|numeric',
            'id_media_show' => 'required|numeric',
            'puntuacion' => 'required|numeric',
            'valoracion' => 'required|string',
            'recomendacion' => 'required|boolean'
        ]);

        // Si la validación falla, retorna un error con los mensajes correspondientes
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }
    
        // Creamos un nuevo registro de valoración con los datos proporcionados
        $valoration = $request->all();
        $valorations = p_valorations::create($valoration);

        return response()->json([
            'success' => true, 
            'data' => $valorations->fresh(), 
        ], 201);

    }

    public function checkIfFavorite($mediaShowId)
    {
        $userId = auth()->id();
        
        $favorite = p_favorite::where('id_user', $userId)
                               ->where('id_media_show', $mediaShowId)
                               ->exists();

        // Definimos la imagen predeterminada
        $imageSrc = '/images/no_like.svg';
        
        // Si la media show está en favoritos por el usuario, cambiamos la imagen
        if ($favorite) {
            $imageSrc = '/images/like.svg';
        }
        
        return response()->json(['isFavorite' => $favorite, 'imageSrc' => $imageSrc]);
    }

    public function manageToFavorites(Request $request, $mediaShowId)
    {
        // Recogemos el ID del usuario actual para añadirlo a la base de datos:
        $userId = auth()->id();

        // Verificar si ya existe la entrada previamente:
        $existingFavorite = p_favorite::where('id_user', $userId)
                                       ->where('id_media_show', $mediaShowId)
                                       ->first();

        // Si ya existe la misma entrada, la eliminamos:
        if ($existingFavorite) {
            $existingFavorite->delete();
            return response()->json(['message' => 'El media show se eliminó de tus favoritos correctamente.'], 200);
        }

        // Si no, creamos una nueva entrada en favoritos:
        p_favorite::create([
            'id_user' => $userId,
            'id_media_show' => $mediaShowId,
        ]);

        return response()->json(['message' => 'El media show se agregó a tus favoritos correctamente.'], 200);
    }
    
    public function checkIfVisualizated($mediaShowId)
    {
        $userId = auth()->id();
        
        $visualizated = p_visualized::where('id_user', $userId)
                                     ->where('id_media_show', $mediaShowId)
                                     ->exists();

        // Definimos la imagen predeterminada
        $imageSrc = '/images/no_visualization.svg';
        
        // Si la media show está en visualizadas por el usuario, cambiamos la imagen:
        if ($visualizated) {
            $imageSrc = '/images/visualization.svg';
        }                            
                            
        return response()->json(['isWatched' => $visualizated, 'imageSrc' => $imageSrc]);
    }

    public function manageToVisualizated(Request $request, $mediaShowId)
    {
        // Recogemos el ID del usuario actual para añadirlo a la base de datos:
        $userId = auth()->id();

        // Verificar si ya existe la entrada previamente:
        $existingVisualized = p_visualized::where('id_user', $userId)
                                           ->where('id_media_show', $mediaShowId)
                                           ->first();

        // Si ya existe la misma entrada, la eliminamos:
        if ($existingVisualized) {
            $existingVisualized->delete();
            return response()->json(['message' => 'El media show se eliminó de tus visualizadas correctamente.'], 200);
        }

        // Si no, creamos una nueva entrada en favoritos:
        p_visualized::create([
            'id_user' => $userId,
            'id_media_show' => $mediaShowId,
        ]);

        return response()->json(['message' => 'El media show se agregó a tus visualizadas correctamente.'], 200);
    }

    public function getMediaShowByMediaShowType(){
        $media_show_type = p_media_show_type::with('mediaShowType')->get();
        return $media_show_type; 
    }

    public function index()
    {
        // Obtener las últimas 6 media shows ordenadas por el ID de forma descendente:
        $mediaShows = p_media_show::with('country', 'mediaShowType', 'pemi', 'genres')
        ->orderBy('id', 'desc')
        ->take(9)
        ->get();

        // Iterar sobre cada medio de muestra y añadir los campos adicionales
        $mediaShowsWithAdditionalFields = $mediaShows->map(function ($mediaShow) {
            return [
                'id' => $mediaShow->id,
                'nombre' => $mediaShow->nombre,
                'duracion' => $mediaShow->duracion,
                'actores' => $mediaShow->actores,
                'sinopsis_corta' => $mediaShow->sinopsis_corta,
                'sinopsis' => $mediaShow->sinopsis,
                'portada_img' => $mediaShow->portada_img,
                'idioma' => $mediaShow->idioma,
                'directores' => $mediaShow->directores,
                'trailer' => $mediaShow->trailer,
                'fecha_media_show' => $mediaShow->fecha_media_show,
                'saga' => $mediaShow->saga,
                'episodios' => $mediaShow->episodios,
                'temporadas' => $mediaShow->temporadas,
                'country_name' => $mediaShow->country->name ?? null,
                'mediashowtype_name' => $mediaShow->mediaShowType->type ?? null,
                'pemi_name' => $mediaShow->pemi->number_pemi ?? null,
                'genres_name' => $mediaShow->genres->pluck('name_genre')->toArray() ?? [],
            ];
        });
        
        return response()->json($mediaShowsWithAdditionalFields);
    }

    public function show($id)
    {
        $media = p_media_show::findOrFail($id);
            return response()->json([
                'id' => $media->id,
                'nombre' => $media->nombre,
                'duracion' => $media->duracion,
                'actores' => $media->actores,
                'sinopsis_corta' => $media->sinopsis_corta,
                'sinopsis' => $media->sinopsis,
                'portada_img' => $media->portada_img,
                'idioma' => $media->idioma,
                'directores' => $media->directores,
                'trailer' => $media->trailer,
                'fecha_media_show' => $media->fecha_media_show,
                'saga' => $media->saga,
                'episodios' => $media->episodios,
                'temporadas' => $media->temporadas,
                'country_name' => $media->country->name ?? null,
                'mediashowtype_name' => $media->mediaShowType->type ?? null,
                'pemi_name' => $media->pemi->number_pemi ?? null,
                'genres_name' => $media->genres->pluck('name_genre')->toArray() ?? [],
            ]);
    }

    public function destroy($id)
    {
        $media = p_media_show::findOrFail($id);
        $media->delete();
        return response()->json(['message' => 'El registro ha sido eliminado correctamente']);
    }

    public function store(Request $request)
    {
        // Validación de los datos recibidos
        $validator = Validator::make($request->all(), [
            'id_country' => 'required|numeric',
            'id_media_show_type' => 'required|numeric',
            'id_pemi' => 'required|numeric',
            'nombre' => 'required|string|max:255',
            'duracion' => 'required|date_format:H:i:s',
            'actores' => 'required|string|max:255',
            'sinopsis_corta' => 'required|string|max:255',
            'portada_img' => 'required|string|max:255',
            'idioma' => 'required|string|max:255',
            'directores' => 'required|string|max:255',
            'sinopsis' => 'required|string',
            'fecha_media_show' => 'required|date',
            'trailer' => 'required|string|max:255',
            'saga' => 'nullable|string|max:255',
            'episodios' => 'nullable|integer',
            'temporadas' => 'nullable|integer',
            'genres'
        ]);
    
        // Si la validación falla, retorna un error con los mensajes correspondientes
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }
    
        // Crear un nuevo registro de p_media_show con los datos proporcionados
        $media = $request->all();
        $mediaShow = p_media_show::create($media);
    
        // Adjuntar géneros al medio
        if ($request->has('genres')) {
            // Convertir la cadena JSON a un array de géneros
            $genres = json_decode($request->input('genres'), true);
            // Sincronizar los géneros asociados al medio
            $mediaShow->genres()->sync($genres);
        }
    
        // Obtener los géneros asociados al medio recién creado
        $mediaShowGenres = $mediaShow->genres()->pluck('name_genre')->toArray();

        // Devolver una respuesta JSON con éxito y los datos del medio y sus géneros asociados
        return response()->json([
            'success' => true, 
            'data' => $mediaShow->fresh(), 
            'genres_name' => $mediaShowGenres
        ], 201);
    }

    public function viewByGenreID($id){
        // Buscar los registros de la tabla p_mediashow_genre donde genre_id coincida con $id
        $media = p_media_show_genres::where('id_genre', $id)->get();
    
        if($media->isEmpty()) {
            // Manejar el caso en el que no se encuentren registros para el genre_id dado
            return response()->json([
                'success' => false,
                'message' => 'No se encontraron registros para el genre_id proporcionado.',
            ], 404);
        }

        $mediaIds = $media->pluck('id_media_show')->toArray();

        return response()->json([
            'success' => true, 
            'data' => $mediaIds
        ], 201);
        
    }

}