<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'Italo Donoso',
                'email' => 'italo.donoso@ucn.cl',
                'password' => 'Turjoy91',
                'role' => 1,
            ]
            ]);
    }
}