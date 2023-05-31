<?php

return [
    'userManagement' => [
        'title'          => 'User Management',
        'title_singular' => 'User Management',
    ],
    'user'           => [
        'title'          => 'Users',
        'title_singular' => 'User',
        'fields'         => [
            'id'                       => 'ID',
            'first_name'               => 'First Name',
            'last_name'                => 'Last Name',
            'name'                     => 'Name',
            'company'                  => 'Company',
            'email'                    => 'Email',
            'phone'                    => 'Phone Number',
            'profile_image'            => 'Profile Image',
            'email_verified_at'        => 'Email verified at',
            'password'                 => 'Password',
            'confirm_password'         => 'Password Confirm',
            'role'                     => 'User Level',
            'remember_token'           => 'Remember Token',
            'created_at'               => 'Created at',
            'updated_at'               => 'Updated at',
            'deleted_at'               => 'Deleted at',
        ],
    ],
    'permission'     => [
        'title'          => 'Permissions',
        'title_singular' => 'Permission',
        'fields'         => [
            'id'                => 'ID',
            'title'             => 'Title',
            'created_at'        => 'Created at',
            'updated_at'        => 'Updated at',
            'deleted_at'        => 'Deleted at',
        ],
    ],
   
    'package' => [
        'title' => 'Packages',
        'title_singular' => 'Package',
        'fields' => [
            'title' => 'Title',
            'description' => 'Description',
            'commission'  => 'Commission',
            'level_one_commission'   => 'Level 1',
            'level_two_commission'   => 'Level 2',
            'level_three_commission' => 'Level 3',           
            'created_at' => 'Created At',
        ],
    ],

   

];
