<?php

use Illuminate\Database\Seeder;

class Acercamientos extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $sql = base_path('database/seeds/Inserta_acercamientos.sql');
         DB::unprepared(file_get_contents($sql));
    }
}
