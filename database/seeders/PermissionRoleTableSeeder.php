<?php
namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;

class PermissionRoleTableSeeder extends Seeder
{
    public function run()
    {
        $all_permissions = Permission::all();

        $admin_permissions = $all_permissions->filter(function ($permission) {
            return ;
        });
        // dd($admin_permissions->pluck('id','name'));
        Role::findOrFail(1)->permissions()->sync($admin_permissions->pluck('id'));

        $userPermissions = $all_permissions->filter(function ($permission) {
            return substr($permission->title, 0, 11) != 'permission_' || substr($permission->title, 0, 5) != 'role_';
        });
        Role::findOrFail(2)->permissions()->sync($userPermissions);

    }
}
