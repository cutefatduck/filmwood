<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\p_genres; 

class GenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $genres = [
            ["name_genre" => "Accion"],
            ["name_genre" => "Aventura"],
            ["name_genre" => "Animacion"],
            ["name_genre" => "Terror"],
            ["name_genre" => "Ciencia_Ficcion"],
            ["name_genre" => "Comedia"],
            ["name_genre" => "Drama"],
            ["name_genre" => "Belico"],
            ["name_genre" => "Thriller"],
            ["name_genre" => "Western"],
            ["name_genre" => "Suspense"],
            ["name_genre" => "Familiar"]
        ];

        foreach ($genres as $genre){
            
            p_genres::create($genre);
        }     
    }
}