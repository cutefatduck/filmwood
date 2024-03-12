<?php

namespace App\Console\Commands;

use App\Models\Pelicula;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Validator;

class ImportarPeliculasCSV extends Command
{
    protected $signature = 'peliculas:importar {archivo}';

    protected $description = 'Importa películas desde un archivo CSV';

    public function handle()
    {
        $archivo = $this->argument('archivo');

        // // Validar el archivo CSV
        // $validator = Validator::make(['archivo' => $archivo], [
        //     'archivo' => 'required|file|mimes:csv,txt',
        // ]);

        // if ($validator->fails()) {
        //     $this->error('Error: El archivo CSV proporcionado no es válido.');
        //     return;
        // }

        // Procesar el archivo CSV
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
                'sinopsis_corta' => $fila[7],
                'portada_img' => $fila[8],
                'idioma' => $fila[9],
                'directores' => $fila[10],
                'sinopsis' => $fila[11],
                'fecha_media_show' => $fila[12],
                'trailer' => $fila[13],
                'saga' => $fila[14]
            ]);
        }

        $this->info('Las películas se han importado exitosamente desde el archivo CSV.');
    }
}