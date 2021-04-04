<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categoria_recetas')->insert([
        	'nombre' => 'Comida Mexicana',
        	'created_at' => date('Y-m-d H:i:s'),
        	'updated_at' => date('Y-m-d H:i:s'),
        ]);

        DB::table('categoria_recetas')->insert([
        	'nombre' => 'Comida Italiana',
        	'created_at' => date('Y-m-d H:i:s'),
        	'updated_at' => date('Y-m-d H:i:s'),
        ]);

        DB::table('categoria_recetas')->insert([
        	'nombre' => 'Comida Argentina',
        	'created_at' => date('Y-m-d H:i:s'),
        	'updated_at' => date('Y-m-d H:i:s'),
        ]);

        DB::table('categoria_recetas')->insert([
        	'nombre' => 'Comida Venezolana',
        	'created_at' => date('Y-m-d H:i:s'),
        	'updated_at' => date('Y-m-d H:i:s'),
        ]);

        DB::table('categoria_recetas')->insert([
        	'nombre' => 'Cortes',
        	'created_at' => date('Y-m-d H:i:s'),
        	'updated_at' => date('Y-m-d H:i:s'),
        ]);

        DB::table('categoria_recetas')->insert([
        	'nombre' => 'Desayunos',
        	'created_at' => date('Y-m-d H:i:s'),
        	'updated_at' => date('Y-m-d H:i:s'),
        ]);

        DB::table('categoria_recetas')->insert([
        	'nombre' => 'Ensaladas',
        	'created_at' => date('Y-m-d H:i:s'),
        	'updated_at' => date('Y-m-d H:i:s'),
        ]);

    }
}
