<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert(['codigo'=>'00001','nombres'=>'Franky Emmanuel','apellidos'=>'Mejía Vicente','fecha_nacimiento'=>'1988-05-19','cui'=>'1733333333333', 'direccion_departamento'=>'1','direccion_municipio'=>'5', 'telefono_principal'=>'50240404040','tipo_sangre'=>'O+','no_licencia'=>'1234567890123','inicio_labores'=>'2020-01-01','usuario'=>'fmejia', 'email'=>'franky@gmail.com','password'=>bcrypt('12345678'),'sucursal_id'=>2,'estado'=>true]);
        DB::table('users')->insert(['codigo'=>'00002','nombres'=>'Luis Antonio','apellidos'=>'Hernandez Tzoc','fecha_nacimiento'=>'1990-04-21','cui'=>'1833333333333', 'direccion_departamento'=>'1','direccion_municipio'=>'5', 'telefono_principal'=>'50250505050','tipo_sangre'=>'O+','no_licencia'=>'1111122222333','inicio_labores'=>'2020-05-01','usuario'=>'lhernandez', 'email'=>'luis@gmail.com','password'=>bcrypt('12345678'),'sucursal_id'=>2,'estado'=>true]);
        DB::table('users')->insert(['codigo'=>'00003','nombres'=>'Edwin Roberto','apellidos'=>'Tzic','fecha_nacimiento'=>'1995-02-01','cui'=>'1933333333333', 'direccion_departamento'=>'1','direccion_municipio'=>'5', 'telefono_principal'=>'50230303030','tipo_sangre'=>'O+','no_licencia'=>'1111122222333','inicio_labores'=>'2020-05-01','usuario'=>'etzic', 'email'=>'roberto@gmail.com','password'=>bcrypt('12345678'),'sucursal_id'=>2,'estado'=>true]);
        DB::table('users')->insert(['codigo'=>'00004','nombres'=>'Brenda Lucrecia','apellidos'=>'De Leon Blanco','fecha_nacimiento'=>'1995-02-01','cui'=>'1633333333333', 'direccion_departamento'=>'1','direccion_municipio'=>'5', 'telefono_principal'=>'50230303030','tipo_sangre'=>'O+','no_licencia'=>'1111122222333','inicio_labores'=>'2020-05-01','usuario'=>'bdeleon', 'email'=>'brenda@gmail.com','password'=>bcrypt('12345678'),'sucursal_id'=>3,'estado'=>true]);
        DB::table('users')->insert(['codigo'=>'00005','nombres'=>'Mario','apellidos'=>'Tzul','fecha_nacimiento'=>'1995-02-01','cui'=>'1533333333333', 'direccion_departamento'=>'1','direccion_municipio'=>'5', 'telefono_principal'=>'50230303030','tipo_sangre'=>'O+','no_licencia'=>'1111122222333','inicio_labores'=>'2020-05-01','usuario'=>'mtzul', 'email'=>'mario@gmail.com','password'=>bcrypt('12345678'),'sucursal_id'=>1,'estado'=>true]);
        DB::table('model_has_roles')->insert(['role_id'=>'1','model_type'=>'App\Models\User','model_id'=>'1']);
        DB::table('model_has_roles')->insert(['role_id'=>'1','model_type'=>'App\Models\User','model_id'=>'2']);
        DB::table('model_has_roles')->insert(['role_id'=>'1','model_type'=>'App\Models\User','model_id'=>'3']);
        DB::table('model_has_roles')->insert(['role_id'=>'1','model_type'=>'App\Models\User','model_id'=>'4']);
        DB::table('model_has_roles')->insert(['role_id'=>'1','model_type'=>'App\Models\User','model_id'=>'5']);
    }
}
