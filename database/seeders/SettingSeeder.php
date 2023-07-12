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
                'details' => '220 × 51',
                'status' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'created_by' => 1,
            ],
            [
                'id'     => 2,
                'key'    => 'favicon',
                'value'  => null,
                'type'   => 'image',
                'display_name'  => 'Favicon',
                'group'  => 'site',
                'details' => '32 × 32',
                'status' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'created_by' => 1,
            ],
            [
                'id'     => 3,
                'key'    => 'short_logo',
                'value'  => null,
                'type'   => 'image',
                'display_name'  => 'Short Logo',
                'group'  => 'site',
                'details' => '55 × 46',
                'status' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'created_by' => 1,
            ],
            [
                'id'     => 4,
                'key'    => 'footer_logo',
                'value'  => null,
                'type'   => 'image',
                'display_name'  => 'Footer Logo',
                'group'  => 'site',
                'details' => '200 × 54',
                'status' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'created_by' => 1,
            ],
            [
                'id'     => 5,
                'key'    => 'introduction_video_title',
                'value'  => null,
                'type'   => 'text',
                'display_name'  => 'Title',
                'group'  => 'introduction_video',
                'details' => null,
                'status' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'created_by' => 1,
            ],
            [
                'id'     => 6,
                'key'    => 'introduction_video_description',
                'value'  => null,
                'type'   => 'text_area',
                'display_name'  => 'Description',
                'group'  => 'introduction_video',
                'details' => null,
                'status' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'created_by' => 1,
            ],
            [
                'id'     => 7,
                'key'    => 'introduction_video_image',
                'value'  => null,
                'type'   => 'image',
                'display_name'  => 'Image',
                'group'  => 'introduction_video',
                'details' => '424 × 278',
                'status' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'created_by' => 1,
            ],
            [
                'id'     => 8,
                'key'    => 'introduction_video',
                'value'  => null,
                'type'   => 'video',
                'display_name'  => 'Video',
                'group'  => 'introduction_video',
                'details' => null,
                'status' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'created_by' => 1,
            ],
            
            [
                'id'     => 9,
                'key'    => 'company_email',
                'value'  => 'rohithelpfullinsight@gmail.com',
                'type'   => 'text',
                'display_name'  => 'Company Email',
                'group'  => 'site',
                'details' => null,
                'status' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'created_by' => 1,
            ],

            [
                'id'     => 10,
                'key'    => 'company_address',
                'value'  => 'MyFutureBiz Marketing Private Limited Meena Bhawan, Near Water Tank Tilwar, Tehsil, Rajgarh, Alwar, Rajasthan, India',
                'type'   => 'text_area',
                'display_name'  => 'Company Address',
                'group'  => 'site',
                'details' => null,
                'status' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'created_by' => 1,
            ],

            [
                'id'     => 11,
                'key'    => 'founder_description',
                'value'  => 'He Is An Entreprenuer, Trainer & Youtuber. He Has 3 Years Plus Experience In Sales And Marketing.',
                'type'   => 'text_area',
                'display_name'  => 'Founder Description',
                'group'  => 'site',
                'details' => null,
                'status' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'created_by' => 1,
            ],

            [
                'id'     => 12,
                'key'    => 'instagram',
                'value'  => null,
                'type'   => 'text',
                'display_name'  => 'Instagram Url',
                'group'  => 'social_media',
                'details' => null,
                'status' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'created_by' => 1,
            ],

            [
                'id'     => 13,
                'key'    => 'facebook',
                'value'  => null,
                'type'   => 'text',
                'display_name'  => 'Facebook Url',
                'group'  => 'social_media',
                'details' => null,
                'status' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'created_by' => 1,
            ],

            [
                'id'     => 14,
                'key'    => 'youtube',
                'value'  => null,
                'type'   => 'text',
                'display_name'  => 'Youtube Url',
                'group'  => 'social_media',
                'details' => null,
                'status' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'created_by' => 1,
            ],
            
            [
                'id'     => 15,
                'key'    => 'linkedin',
                'value'  => null,
                'type'   => 'text',
                'display_name'  => 'linkedin Url',
                'group'  => 'social_media',
                'details' => null,
                'status' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'created_by' => 1,
            ],

            [
                'id'     => 16,
                'key'    => 'gmail',
                'value'  => null,
                'type'   => 'text',
                'display_name'  => 'Gmail Url',
                'group'  => 'social_media',
                'details' => null,
                'status' => 0,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'created_by' => 1,
            ],

            [
                'id'     => 17,
                'key'    => 'twitter',
                'value'  => null,
                'type'   => 'text',
                'display_name'  => 'Twitter Url',
                'group'  => 'social_media',
                'details' => null,
                'status' => 0,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'created_by' => 1,
            ],

            [
                'id'     => 18,
                'key'    => 'support_email',
                'value'  => 'Info@Myfuturebiz.In',
                'type'   => 'text',
                'display_name'  => 'Email',
                'group'  => 'support',
                'details' => null,
                'status' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'created_by' => 1,
            ],

            [
                'id'     => 19,
                'key'    => 'support_phone',
                'value'  => '1234567890',
                'type'   => 'text',
                'display_name'  => 'Phone Number',
                'group'  => 'support',
                'details' => null,
                'status' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'created_by' => 1,
            ],

            [
                'id'     => 20,
                'key'    => 'support_whatsapp_number',
                'value'  => '1234567890',
                'type'   => 'text',
                'display_name'  => 'Whatsapp Number',
                'group'  => 'support',
                'details' => null,
                'status' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'created_by' => 1,
            ],

            [
                'id'     => 21,
                'key'    => 'support_available',
                'value'  => '24*7',
                'type'   => 'text',
                'display_name'  => 'Available',
                'group'  => 'support',
                'details' => null,
                'status' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'created_by' => 1,
            ],

           

            [
                'id'     => 22,
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
                'id'     => 23,
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
                'id'     => 24,
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
                'id'     => 25,
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
