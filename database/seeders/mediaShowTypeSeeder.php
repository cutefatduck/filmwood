<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\p_media_show_type;

class mediaShowTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $mediaShowTypes = [
            ["type" => "Pelicula"],
            ["type" => "Serie"]
        ];

        foreach ($mediaShowTypes as $mediaShowType){
            
            p_media_show_type::create($mediaShowType);
        }     
    }
}