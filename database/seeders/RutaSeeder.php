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
        DB::table('rutas')->insert(['codigo'=>'0000','nombre'=>'No aplica','descripcion'=>'No aplica para ruta','estado'=>1]);
        DB::table('rutas')->insert(['codigo'=>'0001','nombre'=>'Ruta Occidente','descripcion'=>'descripcion de ruta occidente','estado'=>1]);
        DB::table('rutas')->insert(['codigo'=>'0002','nombre'=>'Ruta Interior','descripcion'=>'descripcion ruta interior de totonicapan','estado'=>1]);


        DB::table('departamento_ruta')->insert(['id'=>'1','ruta_id'=>'2','departamento_id'=>'8','municipio_id'=>'104','nombre_departamento'=>'Totonicapan','nombre_municipio'=>'Totonicapan','observaciones'=>'']);
        DB::table('departamento_ruta')->insert(['id'=>'2','ruta_id'=>'2','departamento_id'=>'8','municipio_id'=>'105','nombre_departamento'=>'Totonicapan','nombre_municipio'=>'San Cristobal Totonicapan','observaciones'=>'']);
        DB::table('departamento_ruta')->insert(['id'=>'3','ruta_id'=>'3','departamento_id'=>'14','municipio_id'=>'229','nombre_departamento'=>'Quiche','nombre_municipio'=>'Chiché','observaciones'=>'por le interior']);
        DB::table('departamento_ruta')->insert(['id'=>'4','ruta_id'=>'2','departamento_id'=>'14','municipio_id'=>'229','nombre_departamento'=>'Quiche','nombre_municipio'=>'Chiché','observaciones'=>'por le interior']);


    }
}
