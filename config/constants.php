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
    'default' => [
        'logo' => 'images/logo.svg',
        'favicon' => 'admin/images/favicon.png',
        'admin_favicon' => 'admin/images/favicon.png',
        'short_logo' => 'assets/logo/short-logo.png',
        'admin_logo' => 'admin/images/logo.svg',
        'transparent_logo' => 'assets/logo/logo-transparent.png',
    ],
    
    'date_format' => 'd-m-Y',
    'datetime_format' => 'd-m-Y h:i:s A',
    'set_timezone' => 'Asia/kolkata', // set timezone
    
    'logo_min_width' => '250', // logo min width
    'logo_min_height' => '150', // logo min height
    'img_max_size' => '3', // logo min height
   
    'logo_max_size' => '1024',
    
    'slider_banner_limit' => '5',

    'gender_options' => [   
        1 => "Male",
        2 => "Female",
        3 => "Other",
    ],
    'copy_right_content'=>'All Rights Reserved.',
   
];