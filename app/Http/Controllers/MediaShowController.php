<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Pelicula; // Importa el modelo Pelicula
use Illuminate\Http\Request;

class MediaShowController extends Controller
{
    public function agregarPelicula()
    {
        // // Crear una nueva instancia de Pelicula y asignar los valores manualmente
        // $pelicula = new Pelicula();
        // $pelicula->nombre = 'Nombre de la película';
        // $pelicula->duracion = '01:30:00'; // Formato HH:MM:SS
        // $pelicula->actores = 'Nombre del actor 1, Nombre del actor 2';
        // // Asigna los valores de los otros campos
        // // Asegúrate de que los nombres de los campos coincidan con los del modelo Pelicula

        // // Guardar la película en la base de datos
        // $pelicula->save();

        // // Si deseas redireccionar a otra página después de agregar la película, puedes hacerlo así
        // return redirect()->route('nombre.ruta'); // Cambia 'nombre.ruta' por el nombre de la ruta a la que quieres redirigir
    }
}
