<?php

namespace App\Http\Middleware;

use App\Models\Role;
use App\Models\User;
use Closure;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;

class AuthGates
{
    public function handle($request, Closure $next)
    {
        //dd($next);
        
        try {
           $user = \Auth::user();

            if (!app()->runningInConsole() && $user) {
                $roles            = Role::with('permissions')->get();
                $permissionsArray = [];
    
                foreach ($roles as $role) {
                    foreach ($role->permissions as $permissions) {
                       if (!empty($permissions->title)) {
                            $permissionsArray[$permissions->title][] = $role->id;
                        }
                    }
                }
    
                foreach ($permissionsArray as $title => $roles) {
                    Gate::define($title, function (User $user) use ($roles) {
                        return count(array_intersect($user->roles->pluck('id')->toArray(), $roles)) > 0;
                    });
                }
    
            }
    
            return $next($request);
            
        } catch (\Exception $e) {
            // dd($e->getMessage().'->'.$e->getLine());
             Log::error('Error in auth gate middleware: ' . $e->getMessage().'->'.$e->getLine());
             
            // Handle the exception and display the custom message
            return response()->json(['error' => trans('messages.error_message')], 500);
        }
        
       
      
      

    }
    
  

}
