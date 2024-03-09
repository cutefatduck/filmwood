<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\p_role;

class roleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $roles = [
            ["role" => "administrador"],
            ["role" => "usuario"]
        ];

        foreach ($roles as $rol){
            
            p_role::create($rol);
        }     
    }
}