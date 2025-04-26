<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'id' => (string) Str::uuid(),
            'name' => 'Petugas',
            'email' => 'petugas@gmail.com',
            'age' => 33, 
        ]);
        DB::table('users')->insert([
            'id' => (string) Str::uuid(),
            'name' => 'topan',
            'email' => 'topan@gmail.com',
            'age' => 33, 
        ]);
        DB::table('users')->insert([
            'id' => (string) Str::uuid(),
            'name' => 'topan2',
            'email' => 'topan2@gmail.com',
            'age' => 33, 
        ]);
        DB::table('users')->insert([
            'id' => (string) Str::uuid(),
            'name' => 'topan3',
            'email' => 'topan3@gmail.com',
            'age' => 33, 
        ]);
        DB::table('users')->insert([
            'id' => (string) Str::uuid(),
            'name' => 'topan4',
            'email' => 'topan4@gmail.com',
            'age' => 33, 
        ]);
        DB::table('users')->insert([
            'id' => (string) Str::uuid(),
            'name' => 'topan5',
            'email' => 'topan5@gmail.com',
            'age' => 33, 
        ]);
    }
}
