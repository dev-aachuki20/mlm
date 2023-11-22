<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Custom validation rule
        Validator::extend('valid_extensions', function ($attribute, $value, $parameters, $validator) {
            $allowedExtensions = $parameters;
            $fileExtension = strtolower($value->getClientOriginalExtension());

            return in_array($fileExtension, $allowedExtensions);
        });
        
        Validator::extend('strip_tags', function ($attribute, $value, $parameters, $validator) {
            $cleanValue = trim(strip_tags($value));
            $replacedVal = trim(str_replace(['&nbsp;', '&ensp;', '&emsp;'], ['','',''], $cleanValue));
            
            if (empty($replacedVal)) {
                return false;
            }

            if(count($parameters)>0){
               return strlen($cleanValue) <= $parameters[0];
            }else{
              return strlen($cleanValue) > 0;
            }
            
        });
    }
}
