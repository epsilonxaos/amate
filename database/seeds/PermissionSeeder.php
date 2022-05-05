<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Truncamos la tabla
        // DB::table('model_has_roles')->delete();
        // DB::table('roles')->delete();
        // DB::table('role_has_permissions')->delete();
        // DB::table('permissions')->delete();
        //Agregamos nuevamente los permisos
        //Limpiar la cache
        // php artisan cache:forget spatie.permission.cache
        foreach (PermissionKey::getConstants() as $key => $modulo) {
            foreach($modulo['permissions'] as $permiso){
                if(!DB::table('permissions')->where('name', $permiso['name'])->first()){
                    DB::table('permissions')->insert([
                        'name' => $permiso['name'],
                        'guard_name' => 'admin',
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s')
                    ]);
                }
            }
        }
    }
}
