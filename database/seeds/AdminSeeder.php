<?php
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Admin;
class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // factory(App\Admin::class, 5)->create();
        $admin = Admin::create([
            "avatar" => "storage/admins/default.png",
            "name" => "Locker Ag",
            "email" => "soporte@locker.com.mx",
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10)
        ]);
        $rol = Role::create(['name' => 'Administrador', 'guard_name' => 'admin']);
        $permisos = DB::table('permissions') -> select('id') -> get();
        foreach ($permisos as $key => $value) {
            $rol -> givePermissionTo($value -> id);
        }
        $admin -> assignRole($rol);
    }
}
