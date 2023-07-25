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
            'full_name'                => 'Full name',
            'email'                    => 'Email',
            'phone'                    => 'Phone Number',
            'dob'                      => 'Dob',
            'profile_image'            => 'Profile Image',
            'email_verified_at'        => 'Email verified at',
            'password'                 => 'Password',
            'confirm_password'         => 'Password Confirm',
            'role'                     => 'User Level',
            'date_of_join'             => 'Date Of Join',
            'my_referral_code'         => 'My referral code',
            'referral_code'            => 'Referral code',
            'referral_name'            => 'Referral Name',
            'remember_token'           => 'Remember Token',
            'created_at'               => 'Created at',
            'updated_at'               => 'Updated at',
            'deleted_at'               => 'Deleted at',
            'sponser_id'               => 'Sponser ID',
            'sponser_name'               => 'Sponser Name',
            'joining_date'             => 'Joining Date',
        ],

        'profile'         => [
            'guardian_name'            => 'Guardian name',
            'gender'                   => 'Gender',
            'profession'               => 'Profession',
            'marital_status'           => 'Marital status',
            'address'                  => 'Address',
            'state'                    => 'State',
            'city'                     => 'City',
            'pin_code'                 => 'Pin code',
            'nominee_name'             => 'Nominee name',
            'nominee_dob'              => 'Nominee DOB',
            'nominee_relation'         => 'Nominee relation',
            'level_one_user'           => 'Level 1 user',
            'level_two_user'           => 'Level 2 user',
            'level_three_user'         => 'Level 3 user',
            'created_at'               => 'Created at',
            'updated_at'               => 'Updated at',
            'deleted_at'               => 'Deleted at',
        ],

        'payment'         => [
            'total_earning'            => 'Total Earning',
            'total_remaning_earning'   => 'Total Remaning Earning',
            'total_withdrawal'         => 'Total Withdrawal',
        ],
        'level'         => [
            'level_01_earning'         => 'Level 01 Earning',
            'level_02_earning'         => 'Level 02 Earning',
            'level_03_earning'         => 'Level 03 Earning',
        ],

        'kyc'        => [
            'aadhar_card_name'         => 'Aadhar Card Name',
            'aadhar_card_number'       => 'Aadhar Card Number',
            'bank_name'                => 'Bank Name',
            'branch_name'              => 'Branch Name',
            'ifsc_code'                => 'Ifsc Code',
            'account_holder_name'      => 'Account Holder Name',
            'account_number'           => 'Account number',
            'pan_card_name'            => 'Pan Card Name',
            'pan_card_number'          => 'Pan Card Number',
        ]
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
            'title' => 'Package Name',
            'sub_title' => 'Sub Title',
            'amount' => 'Package Price',
            'features' => 'Features',
            'description' => 'Description',
            'commission'  => 'Level Of Commission',
            'level_one_commission'   => 'Level 1',
            'level_two_commission'   => 'Level 2',
            'level_three_commission' => 'Level 3',
            'duration' => 'Duration',
            'level' => 'Level',
            'image' => 'Image',
            'video' => 'Video',
            'created_at' => 'Created At',
        ],
    ],

    'faq' => [
        'title' => 'Faqs',
        'title_singular' => 'Faq',
        'fields' => [
            'question' => 'Question',
            'answer' => 'Answer',
        ],
    ],

    'testimonial' => [
        'title' => 'Testimonials',
        'title_singular' => 'Testimonial',
        'fields' => [
            'name'   => 'Name',
            'rating' => 'Rating',
            'designation' => 'Designation',
            'description' => 'Description',
            'image' => 'Image',
            'created_at' => 'Created At',
        ],
    ],

    'slider' => [
        'title' => 'Sliders',
        'title_singular' => 'Slider',
        'fields' => [
            'name' => 'Name',
            'type' => 'Type',
            'image' => 'Image'
        ],
    ],


    'page' => [
        'title' => 'Pages',
        'title_singular' => 'Page',
        'fields' => [
            'parent_page' => 'Parent page',
            'title' => 'Title',
            'sub_title' => 'Sub title',
            'type'  => 'Type',
            'slug'  => 'Slug',
            'description'    => 'Description',
            'template_name'  => 'Template name',
            'created_by'     => 'Created by',
            'slider_image'   => 'Slider Image',

        ],
    ],

    'setting' => [
        'title' => 'Settings',
        'title_singular' => 'Setting',
        'fields' => [
            'key'   => 'Key',
            'value' => 'Value',
            'display_name' => 'Display Name',
            'group' => 'Group',
            'type'  => 'Type',
            'created_by'     => 'Created by',
        ],
    ],


    'course' => [
        'title' => 'Courses',
        'title_singular' => 'Course',
        'fields' => [
            'name'        => 'Name',
            'package'     => 'Package',
            'description' => 'Description',
            'video_image' => 'Video Image',
            'video'       => 'Video',
            'created_by'  => 'Created By',
        ],
    ],

    'team' => [
        'title' => 'Teams',
        'title_singular' => 'Team',
        'fields' => [
            'name'        => 'Name',
            'first_name'  => 'First Name',
            'last_name'   => 'Last Name',
            'email'       => 'Email',
            'phone_number' => 'Phone Number',
            'profile_image' => 'Profile Image',
            'password'      => 'Password',
            'password_confirmation'      => 'Password Confirmation',
            'created_by'  => 'Created By',
            'joining_date' => 'Joining Date',
        ],
    ],



];
