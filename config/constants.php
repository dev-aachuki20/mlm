<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Request Type List
    |--------------------------------------------------------------------------
    |
    | Here you may specify which of the request type list 
    |
    */ 
    'app_name' => 'MLM',
    'app_mode' => env('APP_MODE','staging'),
    'owner_email_id' => 'rohithelpfullinsight@gmail.com',
    
    'default' => [
        'logo' => 'images/logo.png',
        'favicon' => 'images/favicon.png',
        'admin_favicon' => 'images/favicon.png',
        'short_logo' => 'images/favicon.png',
        'admin_logo' => 'images/logo.png',
        'transparent_logo' => 'assets/logo/logo-transparent.png',
        'profile_image' => 'default/default-user-man.png',
        'footer-logo'   => 'images/light-logo.png'
    ],
    
    'date_format'     => 'd-m-Y',
    'datetime_format' => 'd-m-Y H:i',
    'time_format'     => 'H:i',
    'search_datetime_format' => '%d-%m-%Y %H:%i',

    'set_timezone' => 'Asia/kolkata', // set timezone
    
    'logo_min_width' => '1000', // logo min width
    'logo_min_height' => '1000', // logo min height
   
    'profile_image_size'=> '1024',
    'img_max_size'   => '2048',
    'video_max_size' => '50240',
    'data_max_file_size'=> "50M",
    'no_image_url'   => 'default/no-image.jpg',

    'slider_limit' => '5',

    'slider_type' => [
        'banner',
    ],

    'gender_options' => [   
        1 => "Male",
        2 => "Female",
        3 => "Other",
    ],

    'setting_types' => [   
       "logo",
       "social media",
       "support",
       "video",
    ],
    'copy_right_content'=>'All Rights Reserved.',

    'support_email' => 'support@gmail.com',
    'support_phone' => '9658456982',

    'datatable_paginations'=>[10,25,50,100],

    'levels' => [   
        1=> "beginner",
        2=> "intermediate",
        3=> "advanced",
    ],
];