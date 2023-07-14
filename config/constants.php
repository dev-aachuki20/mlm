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
        'short_logo' => 'images/logo-mini.png',
        'transparent_logo' => 'assets/logo/logo-transparent.png',
        'profile_image' => 'default/default-user.svg',
        'footer-logo'   => 'images/light-logo.png'
    ],
    
    'date_format'     => 'd-m-Y',
    'datetime_format' => 'd-m-Y H:i',
    'time_format'     => 'H:i:s',
    'search_datetime_format' => '%d-%m-%Y %H:%i',

    'set_timezone' => 'Asia/kolkata', // set timezone
    
    'logo_min_width' => '1000', // logo min width
    'logo_min_height' => '1000', // logo min height
   
    'profile_image_size'=> '1024',

    'img_max_size'   => '2048',
    'video_max_size' => '50240',
    'data_max_file_size'=> "50M",
    'no_image_url'   => 'default/no-image.jpg',
    'default_user_logo' => 'default/default-user.svg',

    'pancard_image' => [
        'size'=>[
            'min'=>'20',
            'max'=>'60',
        ],
        'extensions' =>'jpeg,jpg,JPG',
    ],

    'aadharcard_image' => [
        'size'=>[
            'min'=>'50',
            'max'=>'100',
        ],
        'extensions' =>'jpeg,jpg,JPG',
    ],
  

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

    'referral_levels' => [   
        1=> "Level 1",
        2=> "Level 2",
        3=> "Level 3",
    ],

    'levels' => [   
        1=> "beginner",
        2=> "intermediate",
        3=> "advanced",
    ],

    'page_types' => [   
        1=> "support menu",
        2=> "useful links",
        3=> "header",
        4=> "growth",
        5=> "rewards"
    ],

    'kyc_status'=>[
        1=>'pending',
        2=>'approve',
        3=>'reject',
    ],

    'min_review_length' => '200'
];