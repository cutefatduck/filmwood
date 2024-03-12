<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pelicula;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MediaShowController extends Controller
{

    public function index(){
        $mediashow = Pelicula::all()->toArray();
        return $mediashow;
    }

    public function create(Request $request){
        
        $request -> validate([
            'nombre' => 'required',
            'sinopsis_corta' => 'required',
            'sinopsis' => 'required',
            'fecha_media_show' => 'required'
        ]);

        $mediashow = $request->all();
        $mediashowRequest= Pelicula::create($mediashow);

        return response()->json(['success' => true, 'data' => $mediashowRequest]);
    }

    public function importarPeliculas(Request $request){
        // Validar la solicitud y asegurarse de que se haya proporcionado un archivo CSV
        $validator = Validator::make($request->all(), [
            'archivo' => 'required|file|mimes:csv,txt',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        // Procesar el archivo CSV
        $archivo = $request->file('archivo');
        $filas = array_map('str_getcsv', file($archivo));

        // Iterar sobre las filas del archivo CSV y crear las películas
        foreach ($filas as $fila) {
            Pelicula::create([
                'id_country' => $fila[0],
                'id_media_show_type' => $fila[1],
                'id_genere' => $fila[2],
                'id_pemi' => $fila[3],
                'nombre' => $fila[4],
                'duracion' => $fila[5],
                'actores' => $fila[6],
                'sinopsis' => $fila[7],
                'sinopsis_corta' => $fila[8],
                'portada_img' => $fila[9],
                'idioma' => $fila[10],
                'directores' => $fila[11],
                'trailer' => $fila[12],
                'fecha_media_show' => $fila[13],
                'saga' => $fila[14]

            ]);
        }

        // Responder con un mensaje de éxito
        return response()->json(['mensaje' => 'Películas importadas exitosamente'], 200);
    }
}