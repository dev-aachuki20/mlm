<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $users = [
                'id'             => 1,
                'first_name'     => 'MLM',
                'last_name'      => 'Admin',
                'name'           => 'Dev Admin',
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

        $createdUser =  User::create($users);

        $profile = [
                'id'             => 1,
                'user_id'        => $createdUser->id,
                'created_at'     => date('Y-m-d H:i:s'),
                'updated_at'     => date('Y-m-d H:i:s'),
        ];

        $createdUser->profile()->create($profile);
    }
}
