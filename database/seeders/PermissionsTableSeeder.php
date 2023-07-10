<?php
namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $updateDate = $createDate = date('Y-m-d H:i:s');
        $permissions = [
            [
                'title'      => 'permission_create',
                'created_at' => $createDate,
                'updated_at' => $updateDate,
            ],
            [
                'title'      => 'permission_edit',
                'created_at' => $createDate,
                'updated_at' => $updateDate,
            ],
            [
                'title'      => 'permission_show',
                'created_at' => $createDate,
                'updated_at' => $updateDate,
            ],
            [
                'title'      => 'permission_delete',
                'created_at' => $createDate,
                'updated_at' => $updateDate,
            ],
            [
                'title'      => 'permission_access',
                'created_at' => $createDate,
                'updated_at' => $updateDate,
            ],
            [
                'title'      => 'role_create',
                'created_at' => $createDate,
                'updated_at' => $updateDate,
            ],
            [
                'title'      => 'role_edit',
                'created_at' => $createDate,
                'updated_at' => $updateDate,
            ],
            [
                'title'      => 'role_show',
                'created_at' => $createDate,
                'updated_at' => $updateDate,
            ],
            [
                'title'      => 'role_delete',
                'created_at' => $createDate,
                'updated_at' => $updateDate,
            ],
            [
                'title'      => 'role_access',
                'created_at' => $createDate,
                'updated_at' => $updateDate,
            ],
            [
                'title'      => 'user_management_access',
                'created_at' => $createDate,
                'updated_at' => $updateDate,
            ],
            [
                'title'      => 'user_create',
                'created_at' => $createDate,
                'updated_at' => $updateDate,
            ],
            [   
                'title'      => 'user_edit',
                'created_at' => $createDate,
                'updated_at' => $updateDate,
            ],
            [
                'title'      => 'user_show',
                'created_at' => $createDate,
                'updated_at' => $updateDate,
            ],
            [
                'title'      => 'user_delete',
                'created_at' => $createDate,
                'updated_at' => $updateDate,
            ],
            [
                'title'      => 'user_access',
                'created_at' => $createDate,
                'updated_at' => $updateDate,
            ],
            [
                'title'      => 'package_access',
                'created_at' => $createDate,
                'updated_at' => $updateDate,
            ],
            [
                'title'      => 'package_create',
                'created_at' => $createDate,
                'updated_at' => $updateDate,
            ],
            [   
                'title'      => 'package_edit',
                'created_at' => $createDate,
                'updated_at' => $updateDate,
            ],
            [
                'title'      => 'package_show',
                'created_at' => $createDate,
                'updated_at' => $updateDate,
            ],
            [
                'title'      => 'package_delete',
                'created_at' => $createDate,
                'updated_at' => $updateDate,
            ],
            
            [
                'title'      => 'testimonial_access',
                'created_at' => $createDate,
                'updated_at' => $updateDate,
            ],
            [
                'title'      => 'testimonial_create',
                'created_at' => $createDate,
                'updated_at' => $updateDate,
            ],
            [   
                'title'      => 'testimonial_edit',
                'created_at' => $createDate,
                'updated_at' => $updateDate,
            ],
            [
                'title'      => 'testimonial_show',
                'created_at' => $createDate,
                'updated_at' => $updateDate,
            ],
            [
                'title'      => 'testimonial_delete',
                'created_at' => $createDate,
                'updated_at' => $updateDate,
            ],

            [
                'title'      => 'faq_access',
                'created_at' => $createDate,
                'updated_at' => $updateDate,
            ],
            [
                'title'      => 'faq_create',
                'created_at' => $createDate,
                'updated_at' => $updateDate,
            ],
            [   
                'title'      => 'faq_edit',
                'created_at' => $createDate,
                'updated_at' => $updateDate,
            ],
            [
                'title'      => 'faq_show',
                'created_at' => $createDate,
                'updated_at' => $updateDate,
            ],
            [
                'title'      => 'faq_delete',
                'created_at' => $createDate,
                'updated_at' => $updateDate,
            ],

            [
                'title'      => 'slider_access',
                'created_at' => $createDate,
                'updated_at' => $updateDate,
            ],
            [
                'title'      => 'slider_create',
                'created_at' => $createDate,
                'updated_at' => $updateDate,
            ],
            [   
                'title'      => 'slider_edit',
                'created_at' => $createDate,
                'updated_at' => $updateDate,
            ],
            [
                'title'      => 'slider_show',
                'created_at' => $createDate,
                'updated_at' => $updateDate,
            ],
            [
                'title'      => 'slider_delete',
                'created_at' => $createDate,
                'updated_at' => $updateDate,
            ],

            [
                'title'      => 'page_access',
                'created_at' => $createDate,
                'updated_at' => $updateDate,
            ],
            [
                'title'      => 'page_create',
                'created_at' => $createDate,
                'updated_at' => $updateDate,
            ],
            [   
                'title'      => 'page_edit',
                'created_at' => $createDate,
                'updated_at' => $updateDate,
            ],
            [
                'title'      => 'page_show',
                'created_at' => $createDate,
                'updated_at' => $updateDate,
            ],
            [
                'title'      => 'page_delete',
                'created_at' => $createDate,
                'updated_at' => $updateDate,
            ],

            [
                'title'      => 'setting_access',
                'created_at' => $createDate,
                'updated_at' => $updateDate,
            ],
            [
                'title'      => 'setting_create',
                'created_at' => $createDate,
                'updated_at' => $updateDate,
            ],
            [   
                'title'      => 'setting_edit',
                'created_at' => $createDate,
                'updated_at' => $updateDate,
            ],
            [
                'title'      => 'setting_show',
                'created_at' => $createDate,
                'updated_at' => $updateDate,
            ],
            [
                'title'      => 'setting_delete',
                'created_at' => $createDate,
                'updated_at' => $updateDate,
            ],

            [
                'title'      => 'course_access',
                'created_at' => $createDate,
                'updated_at' => $updateDate,
            ],
            [
                'title'      => 'course_create',
                'created_at' => $createDate,
                'updated_at' => $updateDate,
            ],
            [   
                'title'      => 'course_edit',
                'created_at' => $createDate,
                'updated_at' => $updateDate,
            ],
            [
                'title'      => 'course_show',
                'created_at' => $createDate,
                'updated_at' => $updateDate,
            ],
            [
                'title'      => 'course_delete',
                'created_at' => $createDate,
                'updated_at' => $updateDate,
            ],

            
            [
                'title'      => 'team_access',
                'created_at' => $createDate,
                'updated_at' => $updateDate,
            ],
            [
                'title'      => 'team_create',
                'created_at' => $createDate,
                'updated_at' => $updateDate,
            ],
            [   
                'title'      => 'team_edit',
                'created_at' => $createDate,
                'updated_at' => $updateDate,
            ],
            [
                'title'      => 'team_show',
                'created_at' => $createDate,
                'updated_at' => $updateDate,
            ],
            [
                'title'      => 'team_delete',
                'created_at' => $createDate,
                'updated_at' => $updateDate,
            ],

            [
                'title'      => 'kyc_access',
                'created_at' => $createDate,
                'updated_at' => $updateDate,
            ],
            [
                'title'      => 'kyc_edit',
                'created_at' => $createDate,
                'updated_at' => $updateDate,
            ],
            [
                'title'      => 'transactions_access',
                'created_at' => $createDate,
                'updated_at' => $updateDate,
            ],

            [
                'title'      => 'webinar_access',
                'created_at' => $createDate,
                'updated_at' => $updateDate,
            ],
            [
                'title'      => 'webinar_create',
                'created_at' => $createDate,
                'updated_at' => $updateDate,
            ],
            [   
                'title'      => 'webinar_edit',
                'created_at' => $createDate,
                'updated_at' => $updateDate,
            ],
            [
                'title'      => 'webinar_show',
                'created_at' => $createDate,
                'updated_at' => $updateDate,
            ],
            [
                'title'      => 'webinar_delete',
                'created_at' => $createDate,
                'updated_at' => $updateDate,
            ],

            
        ];

        Permission::insert($permissions);

    }
}
