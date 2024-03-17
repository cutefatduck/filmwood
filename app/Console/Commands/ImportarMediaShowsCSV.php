<?php

namespace App\Console\Commands;

use App\Models\p_media_show;
use App\Models\Pelicula;
use App\Models\Serie;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Validator;

class ImportarMediaShowsCSV extends Command
{
    protected $signature = 'media_shows:importar {archivo}';

    protected $description = 'Importa media shows desde un archivo CSV';

    public function handle()
    {
        $archivo = $this->argument('archivo');

        // Procesar el archivo CSV
        $datos = array_map('str_getcsv', file($archivo));

        // Iterar sobre los datos del archivo CSV y crear los media_shows
        foreach ($datos as $dato) {

            // Determinaremos si es una película o una serie a través del segundo campo del archivo CSV:
            $esPelicula = $dato[1] == 1;

            // Estableceremos los valores para los campos especiales de series o peliculas: Saga, temporadas y episodios
            $saga = $esPelicula ? $dato[14] : null;
            $temporadas = $esPelicula ? null : $dato[15];
            $episodios = $esPelicula ? null : $dato[16];

            // Crearemos el p_media_show
            p_media_show::create([
                'id_country' => $dato[0],
                'id_media_show_type' => $dato[1],
                'id_genere' => $dato[2],
                'id_pemi' => $dato[3],
                'nombre' => $dato[4],
                'duracion' => $dato[5],
                'actores' => $dato[6],
                'sinopsis_corta' => $dato[7],
                'portada_img' => $dato[8],
                'idioma' => $dato[9],
                'directores' => $dato[10],
                'sinopsis' => $dato[11],
                'fecha_media_show' => $dato[12],
                'trailer' => $dato[13],
                'saga' => $saga,
                'temporadas' => $temporadas,
                'episodios' => $episodios
            ]);
        }

        $this->info('Los media shows se han importado exitosamente desde el archivo CSV.');
    }
}