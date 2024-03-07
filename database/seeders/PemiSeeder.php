<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\p_pemi; 

class PemiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $pemis = [
            ["number_pemi" => "0"],
            ["number_pemi" => "7"],
            ["number_pemi" => "12"],
            ["number_pemi" => "16"],
            ["number_pemi" => "18"]
        ];

        foreach ($pemis as $pemi){
            
            p_pemi::create($pemi);
        }     
    }
}