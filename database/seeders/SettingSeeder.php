<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $settings = [
            [
                'id'     => 1,
                'key'    => 'site_logo',
                'value'  => '',
                'type'   => 'logo',
                'status' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'created_by' => 1,
            ],
            [
                'id'     => 2,
                'key'    => 'dashboard_intro_video',
                'value'  => '',
                'type'   => 'video',
                'status' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'created_by' => 1,

            ],

            [
                'id'     => 3,
                'key'    => 'instagram',
                'value'  => '',
                'type'   => 'social media',
                'status' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'created_by' => 1,
            ],

            [
                'id'     => 4,
                'key'    => 'facebook',
                'value'  => '',
                'type'   => 'social media',
                'status' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'created_by' => 1,
            ],

            [
                'id'     => 5,
                'key'    => 'youtube',
                'value'  => '',
                'type'   => 'social media',
                'status' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'created_by' => 1,
            ],
            
            [
                'id'     => 6,
                'key'    => 'linkedin',
                'value'  => '',
                'type'   => 'social media',
                'status' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'created_by' => 1,
            ],

            [
                'id'     => 7,
                'key'    => 'gmail',
                'value'  => '',
                'type'   => 'social media',
                'status' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'created_by' => 1,
            ],

            [
                'id'     => 8,
                'key'    => 'twitter',
                'value'  => '',
                'type'   => 'social media',
                'status' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'created_by' => 1,
            ],

            [
                'id'     => 9,
                'key'    => 'support_email',
                'value'  => 'Info@Myfuturebiz.In',
                'type'   => 'support',
                'status' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'created_by' => 1,
            ],

            [
                'id'     => 10,
                'key'    => 'support_phone',
                'value'  => '1234567890',
                'type'   => 'support',
                'status' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'created_by' => 1,
            ],

            [
                'id'     => 11,
                'key'    => 'support_whatsapp_number',
                'value'  => '1234567890',
                'type'   => 'support',
                'status' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'created_by' => 1,
            ],

            [
                'id'     => 12,
                'key'    => 'support_available',
                'value'  => '24*7',
                'type'   => 'support',
                'status' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'created_by' => 1,
            ],

            [
                'id'     => 13,
                'key'    => 'company_address',
                'value'  => 'MyFutureBiz Marketing Private Limited Meena Bhawan, Near Water Tank Tilwar, Tehsil, Rajgarh, Alwar, Rajasthan, India',
                'type'   => 'support',
                'status' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'created_by' => 1,
            ],
        ];

        Setting::insert($settings);
    }
}
