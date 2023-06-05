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

        $superAdminPermissions = $all_permissions->filter(function ($permission) {
            return $permission;
        });
       
        Role::findOrFail(1)->permissions()->sync($superAdminPermissions->pluck('id'));

        $adminPermissions = $all_permissions->filter(function ($permission) {
            return substr($permission->title, 0, 11) != 'permission_' && substr($permission->title, 0, 5) != 'role_' &&
            substr($permission->title, 0, 8) != 'package_' && substr($permission->title, 0, 12) != 'testimonial_' && substr($permission->title, 0, 4) != 'faq_' && substr($permission->title, 0, 14) != 'slider_banner_';
        });
        
        Role::findOrFail(2)->permissions()->sync($adminPermissions);

        $userPermissions = $all_permissions->filter(function ($permission) {
            return substr($permission->title, 0, 11) != 'permission_' && substr($permission->title, 0, 5) != 'role_' &&
            substr($permission->title, 0, 8) != 'package_' && substr($permission->title, 0, 12) != 'testimonial_' && substr($permission->title, 0, 4) != 'faq_' && substr($permission->title, 0, 14) != 'slider_banner_';
        });
        Role::findOrFail(3)->permissions()->sync($userPermissions);

    }
}
