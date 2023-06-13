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
            ],
            [
                'id'     => 2,
                'key'    => 'dashboard_intro_video',
                'value'  => '',
                'type'   => 'video',
                'status' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],

            [
                'id'     => 3,
                'key'    => 'instagram',
                'value'  => '',
                'type'   => 'social media',
                'status' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],

            [
                'id'     => 4,
                'key'    => 'facebook',
                'value'  => '',
                'type'   => 'social media',
                'status' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],

            [
                'id'     => 5,
                'key'    => 'youtube',
                'value'  => '',
                'type'   => 'social media',
                'status' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            
            [
                'id'     => 6,
                'key'    => 'linkedin',
                'value'  => '',
                'type'   => 'social media',
                'status' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],

            [
                'id'     => 7,
                'key'    => 'gmail',
                'value'  => '',
                'type'   => 'social media',
                'status' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],

            [
                'id'     => 8,
                'key'    => 'twitter',
                'value'  => '',
                'type'   => 'social media',
                'status' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],

            [
                'id'     => 9,
                'key'    => 'support_email',
                'value'  => '',
                'type'   => 'support',
                'status' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],

            [
                'id'     => 10,
                'key'    => 'support_phone',
                'value'  => '',
                'type'   => 'support',
                'status' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],

            [
                'id'     => 11,
                'key'    => 'support_whatsapp_number',
                'value'  => '',
                'type'   => 'support',
                'status' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],

            [
                'id'     => 12,
                'key'    => 'support_available',
                'value'  => '',
                'type'   => 'support',
                'status' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],

            [
                'id'     => 13,
                'key'    => 'company_address',
                'value'  => '',
                'type'   => 'support',
                'status' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
        ];

        Setting::insert($settings);
    }
}
