<?php

use Illuminate\Database\Seeder;

class Perfiles_users extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $sql = base_path('database/seeds/Inserta_perfiles_usuarios.sql');
         DB::unprepared(file_get_contents($sql));
    }
}
