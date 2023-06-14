<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $users[0] = [
                'id'             => 1,
                'uuid'           => Str::uuid(),
                'first_name'     => 'Super',
                'last_name'      => 'Admin',
                'name'           => 'Super Admin',
                'email'          => 'dev@gmail.com',
                'password'       => bcrypt('dev@123#'),
                'remember_token' => null,
                'date_of_join'   => date('Y-m-d'),
                'my_referral_code'  => generateRandomString(10),
                'email_verified_at' => date('Y-m-d H:i:s'),
                'password_set_at'   => date('Y-m-d H:i:s'),
                'created_at'     => date('Y-m-d H:i:s'),
                'updated_at'     => date('Y-m-d H:i:s'),
            ];
        
        $users[1] = [
                'id'             => 2,
                'uuid'           => Str::uuid(),
                'first_name'     => 'MLM',
                'last_name'      => 'Admin',
                'name'           => 'MLM Admin',
                'email'          => 'admin@admin.com',
                'password'       => bcrypt('admin@123#'),
                'remember_token' => null,
                'date_of_join'   => date('Y-m-d'),
                'my_referral_code'  => generateRandomString(10),
                'email_verified_at' => date('Y-m-d H:i:s'),
                'password_set_at'   => date('Y-m-d H:i:s'),
                'created_at'     => date('Y-m-d H:i:s'),
                'updated_at'     => date('Y-m-d H:i:s'),
            ];

        foreach($users as $key=>$user){
            $createdUser =  User::create($user);

            $profile = [
                    'id'             => $key+1,
                    'user_id'        => $createdUser->id,
                    'created_at'     => date('Y-m-d H:i:s'),
                    'updated_at'     => date('Y-m-d H:i:s'),
            ];
    
            $createdUser->profile()->create($profile);
        }
       
    }
}
