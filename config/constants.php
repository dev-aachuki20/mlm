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
        'logo' => 'assets/logo/CQR-logo.png',
        'favicon' => 'assets/logo/favicon.png',
        'short_logo' => 'assets/logo/short-logo.png',
        'admin_logo' => 'assets/logo/combined-logo.png',
        'app_name' => env('APP_NAME', 'Qr Social'),
        'combined_logo_white' => 'assets/logo/combined-logo-white.png',
        'transparent_logo' => 'assets/logo/logo-transparent.png',
    ],
   
    'set_timezone' => 'Asia/kolkata', // set timezone
    
    'logo_min_width' => '250', // logo min width
    'logo_min_height' => '150', // logo min height
    'img_max_size' => '3', // logo min height
   

    'gender_options' => [   
        1 => "Male",
        2 => "Female",
        3 => "Other",
    ],
    'copy_right_content'=>'All Rights Reserved.',
   
];