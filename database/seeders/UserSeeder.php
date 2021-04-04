<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'carlos',
            'email' => 'carlos@carlos.com',
            'url' => 'https://paginaprueba.com',
            'password' => Hash::make('12345678'),
        ]);


         $user2 = User::create([
            'name' => 'luis',
            'email' => 'luis@luis.com',
            'url' => 'https://luispituis.com',
            'password' => Hash::make('12345678'),
        ]);



        
    }
}
