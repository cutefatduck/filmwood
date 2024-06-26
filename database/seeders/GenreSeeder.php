<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\genres; 

class GenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $genres = [
            ["name_genre" => "Acción"],
            ["name_genre" => "Aventura"],
            ["name_genre" => "Animación"],
            ["name_genre" => "Terror"],
            ["name_genre" => "SCI-FI"],
            ["name_genre" => "Comedia"],
            ["name_genre" => "Drama"],
            ["name_genre" => "Bélico"],
            ["name_genre" => "Thriller"],
            ["name_genre" => "Western"],
            ["name_genre" => "Suspense"],
            ["name_genre" => "Familiar"]
        ];

        foreach ($genres as $genre){
            
            genres::create($genre);
        }     
    }
}