<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       // DB::table('unidads')->insert(['nombre'=>'Pediatria','estado'=>1]);

        $role1= Role::create(['name'=>'Administrador']);
        $role2= Role::create(['name'=>'Bodegero']);
        $role3= Role::create(['name'=>'Digitador']);
        $role4= Role::create(['name'=>'Contabilidad']);



        Permission::create(['name'=>'inicio'])->syncRoles([$role1,$role2,$role3,$role4]);
        Permission::create(['name'=>'cliente'])->syncRoles([$role1,$role2,$role3,$role4]);
        Permission::create(['name'=>'proveedor'])->syncRoles([$role1,$role2,$role3,$role4]);
        Permission::create(['name'=>'usuario'])->syncRoles([$role1,$role2,$role3,$role4]);
        Permission::create(['name'=>'role'])->syncRoles([$role1,$role2,$role3,$role4]);
        Permission::create(['name'=>'compra'])->syncRoles([$role1,$role2,$role3,$role4]);
        Permission::create(['name'=>'inventario'])->syncRoles([$role1,$role2,$role3,$role4]);
        Permission::create(['name'=>'producto'])->syncRoles([$role1,$role2,$role3,$role4]);
        Permission::create(['name'=>'marca'])->syncRoles([$role1,$role2,$role3,$role4]);
        Permission::create(['name'=>'tipo'])->syncRoles([$role1,$role2,$role3,$role4]);
        Permission::create(['name'=>'disenio'])->syncRoles([$role1,$role2,$role3,$role4]);
        Permission::create(['name'=>'material'])->syncRoles([$role1,$role2,$role3,$role4]);
        Permission::create(['name'=>'venta'])->syncRoles([$role1,$role2,$role3,$role4]);
        Permission::create(['name'=>'credito'])->syncRoles([$role1,$role2,$role3,$role4]);
        Permission::create(['name'=>'abono'])->syncRoles([$role1,$role2,$role3,$role4]);


        /*
        Permission::create(['name'=>'departamento'])->syncRoles([$role1]);




        Permission::create(['name'=>'municipio'])->syncRoles([$role1]);




        Permission::create(['name'=>'unidad'])->syncRoles([$role1]);


*/
    }
}
