<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RutaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('rutas')->insert(['codigo'=>'0001','nombre'=>'Ruta Occidente','descripcion'=>'descripcion de ruta occidente','primero_direccion_departamento'=>'1','primero_direccion_municipio'=>'1','estado'=>1]);
        DB::table('rutas')->insert(['codigo'=>'0002','nombre'=>'Ruta Interior','descripcion'=>'descripcion ruta interior de totonicapan','primero_direccion_departamento'=>'1','primero_direccion_municipio'=>'1','estado'=>1]);

    }
}
