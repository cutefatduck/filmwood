<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class ImportarMediaShowsCSV extends Command
{
    protected $signature = 'media_shows:importar {archivo}';

    protected $description = 'Importa media shows desde un archivo CSV';

    public function handle()
    {
        $archivo = $this->argument('archivo');

        // Procesar el archivo CSV
        $datos = array_map('str_getcsv', file($archivo));

        // // Iterar sobre los datos del archivo CSV y llamar a la API para crear los media_shows
        foreach ($datos as $dato) {

            $esPelicula = $dato[1] == 1;
            // Estableceremos los valores para los campos especiales de series o peliculas: Saga, temporadas y episodios
            $saga = $esPelicula ? $dato[14] : null;
            $temporadas = $esPelicula ? null : $dato[15];
            $episodios = $esPelicula ? null : $dato[16];

            // Aquí puedes ajustar la lógica para transformar los datos según lo que espera la API
            $dataToSend = [
                'id_country' => $dato[0],
                'id_media_show_type' => $dato[1],
                'genres' => $dato[2],
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
            ];
            
            // Llama a la API para crear el p_media_show
            $response = Http::post('media/', $dataToSend);

            // Verifica la respuesta de la API y maneja errores si es necesario
            if ($response->successful()) {
                $this->info('Registro creado exitosamente en la API.');
                echo $response->body();
            } else {
                $this->error('Error al crear el registro en la API: ' . $response->body());
                $hola = $response->body();
            }
         }

        $this->info('Proceso de importación desde CSV completado.');
     }
}