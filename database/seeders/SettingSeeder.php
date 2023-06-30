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
                'value'  => null,
                'type'   => 'image',
                'display_name'  => 'Site Logo',
                'group'  => 'site',
                'status' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'created_by' => 1,
            ],
            [
                'id'     => 2,
                'key'    => 'introduction_video',
                'value'  => null,
                'type'   => 'video',
                'display_name'  => 'Introduction Video',
                'group'  => 'site',
                'status' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'created_by' => 1,
            ],

            [
                'id'     => 3,
                'key'    => 'instagram',
                'value'  => null,
                'type'   => 'text',
                'display_name'  => 'Instagram Url',
                'group'  => 'social_media',
                'status' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'created_by' => 1,
            ],

            [
                'id'     => 4,
                'key'    => 'facebook',
                'value'  => null,
                'type'   => 'text',
                'display_name'  => 'Facebook Url',
                'group'  => 'social_media',
                'status' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'created_by' => 1,
            ],

            [
                'id'     => 5,
                'key'    => 'youtube',
                'value'  => null,
                'type'   => 'text',
                'display_name'  => 'Youtube Url',
                'group'  => 'social_media',
                'status' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'created_by' => 1,
            ],
            
            [
                'id'     => 6,
                'key'    => 'linkedin',
                'value'  => null,
                'type'   => 'text',
                'display_name'  => 'linkedin Url',
                'group'  => 'social_media',
                'status' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'created_by' => 1,
            ],

            [
                'id'     => 7,
                'key'    => 'gmail',
                'value'  => null,
                'type'   => 'text',
                'display_name'  => 'Gmail Url',
                'group'  => 'social_media',
                'status' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'created_by' => 1,
            ],

            [
                'id'     => 8,
                'key'    => 'twitter',
                'value'  => null,
                'type'   => 'text',
                'display_name'  => 'Twitter Url',
                'group'  => 'social_media',
                'status' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'created_by' => 1,
            ],

            [
                'id'     => 9,
                'key'    => 'support_email',
                'value'  => 'Info@Myfuturebiz.In',
                'type'   => 'text',
                'display_name'  => 'Email',
                'group'  => 'support',
                'status' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'created_by' => 1,
            ],

            [
                'id'     => 10,
                'key'    => 'support_phone',
                'value'  => '1234567890',
                'type'   => 'text',
                'display_name'  => 'Phone Number',
                'group'  => 'support',
                'status' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'created_by' => 1,
            ],

            [
                'id'     => 11,
                'key'    => 'support_whatsapp_number',
                'value'  => '1234567890',
                'type'   => 'text',
                'display_name'  => 'Whatsapp Number',
                'group'  => 'support',
                'status' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'created_by' => 1,
            ],

            [
                'id'     => 12,
                'key'    => 'support_available',
                'value'  => '24*7',
                'type'   => 'text',
                'display_name'  => 'Available',
                'group'  => 'support',
                'status' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'created_by' => 1,
            ],

            [
                'id'     => 13,
                'key'    => 'company_address',
                'value'  => 'MyFutureBiz Marketing Private Limited Meena Bhawan, Near Water Tank Tilwar, Tehsil, Rajgarh, Alwar, Rajasthan, India',
                'type'   => 'text_area',
                'display_name'  => 'Company Address',
                'group'  => 'site',
                'status' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'created_by' => 1,
            ],

            [
                'id'     => 14,
                'key'    => 'founder_description',
                'value'  => 'He Is An Entreprenuer, Trainer & Youtuber. He Has 3 Years Plus Experience In Sales And Marketing.',
                'type'   => 'text_area',
                'display_name'  => 'Founder Description',
                'group'  => 'site',
                'status' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'created_by' => 1,
            ],

            [
                'id'     => 15,
                'key'    => 'welcome_mail_content',
                'value'  =>  null,
                'type'   => 'text_area',
                'display_name'  => 'Welcome Mail Content',
                'group'  => 'mail',
                'details' => '[NAME], [SUPPORT_EMAIL], [SUPPORT_PHONE], [APP_NAME]',
                'status' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'created_by' => 1,
            ],

            [
                'id'     => 16,
                'key'    => 'package_purchased_mail_content',
                'value'  =>  null,
                'type'   => 'text_area',
                'display_name'  => 'Package Purchased Mail Content',
                'group'  => 'mail',
                'details' => '[NAME], [PACKAGE_NAME], [SUPPORT_EMAIL], [SUPPORT_PHONE], [APP_NAME]',
                'status' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'created_by' => 1,
            ],

            [
                'id'     => 17,
                'key'    => 'reset_password_mail_content',
                'value'  =>  null,
                'type'   => 'text_area',
                'display_name'  => 'Reset Password Mail Content',
                'group'  => 'mail',
                'details' => '[NAME], [RESET_PASSWORD_BUTTON]',
                'status' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'created_by' => 1,
            ],

            [
                'id'     => 18,
                'key'    => 'contact_us_mail_content',
                'value'  =>  null,
                'type'   => 'text_area',
                'display_name'  => 'Contact Us Mail Content',
                'group'  => 'mail',
                'details' => '[APP_NAME], [MESSAGE], [NAME], [EMAIL]',
                'status' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'created_by' => 1,
            ],

        ];

        Setting::insert($settings);
    }
}
