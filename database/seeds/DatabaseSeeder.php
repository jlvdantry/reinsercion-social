<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(Users::class);
        $this->call(Perfiles::class);
        $this->call(Menus::class);
        $this->call(Perfiles_menus::class);
        $this->call(Perfiles_users::class);
        $this->call(Alcaldias::class);
        $this->call(Acercamientos::class);
        $this->call(Comoseenteros::class);
        $this->call(Etnicas::class);
        $this->call(Estudios::class);
        $this->call(Entidades::class);
        $this->call(Ocupaciones::class);
        $this->call(Eciviles::class);
    }
}
