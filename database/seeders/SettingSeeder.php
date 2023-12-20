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

                'key'    => 'footer_logo',
                'value'  => null,
                'type'   => 'image',
                'display_name'  => 'Footer Logo',
                'group'  => 'site',
                'details' => '232 × 54',
                'status' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'created_by' => 1,
            ],
            [

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

                'key'    => 'welcome_mail_content',
                'value'  =>  null,
                'type'   => 'text_area',
                'display_name'  => 'Welcome Mail Content',
                'group'  => 'mail',
                'details' => '[NAME], [EMAIL], [PASSWORD], [SUPPORT_EMAIL], [SUPPORT_PHONE], [APP_NAME]',
                'status' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'created_by' => 1,
            ],

            [

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

                'key'    => 'referral_commission_level_one_mail_content',
                'value'  =>  null,
                'type'   => 'text_area',
                'display_name'  => 'Referral Commision Mail Content For Level 1',
                'group'  => 'mail',
                'details' => '[REFERRAL_NAME], [PACKAGE_NAME], [REGISTERED_USER_NAME], [REGISTERED_USER_EMAIL], [REGISTERED_USER_PHONE], [REFERRAL_COMMISSION_AMOUNT], [SUPPORT_EMAIL], [SUPPORT_PHONE], [APP_NAME]',
                'status' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'created_by' => 1,
            ],
            [

                'key'    => 'referral_commission_level_two_mail_content',
                'value'  =>  null,
                'type'   => 'text_area',
                'display_name'  => 'Referral Commision Mail Content For Level 2',
                'group'  => 'mail',
                'details' => '[REFERRAL_NAME], [PACKAGE_NAME], [REGISTERED_USER_NAME], [REGISTERED_USER_EMAIL], [REGISTERED_USER_PHONE], [REFERRAL_COMMISSION_AMOUNT], [SUPPORT_EMAIL], [SUPPORT_PHONE], [APP_NAME]',
                'status' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'created_by' => 1,
            ],
            [

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
            [

                'key'    => 'shipped_to',
                'value'  =>  null,
                'type'   => 'text_area',
                'display_name'  => 'Shipped To',
                'group'  => 'site',
                'details' => null,
                'status' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'created_by' => 1,
            ],
            [

                'key'    => 'join_program_link',
                'value'  => 'https://bizshiksha.com/',
                'type'   => 'text',
                'display_name'  => 'Join Program Link',
                'group'  => 'site',
                'details' => null,
                'status' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'created_by' => 1,
            ],
            [

                'key'    => 'promote_link',
                'value'  => 'https://bizshiksha.com/',
                'type'   => 'text',
                'display_name'  => 'Promote Link',
                'group'  => 'site',
                'details' => null,
                'status' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'created_by' => 1,
            ],
            [

                'key'    => 'earn_money_link',
                'value'  => 'https://bizshiksha.com/',
                'type'   => 'text',
                'display_name'  => 'Earn Money Link',
                'group'  => 'site',
                'details' => null,
                'status' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'created_by' => 1,
            ],
            [

                'key'    => 'founder_youtube_link',
                'value'  => 'https://youtube.com/',
                'type'   => 'text',
                'display_name'  => 'Founder Youtube Link',
                'group'  => 'site',
                'details' => null,
                'status' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'created_by' => 1,
            ],
            [

                'key'    => 'founder_instagram_link',
                'value'  => 'https://instagram.com/',
                'type'   => 'text',
                'display_name'  => 'Founder Instagram Link',
                'group'  => 'site',
                'details' => null,
                'status' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'created_by' => 1,
            ],
            [

                'key'    => 'total_trainers',
                'value'  => '200',
                'type'   => 'text',
                'display_name'  => 'Total Trainers',
                'group'  => 'counters',
                'details' => null,
                'status' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'created_by' => 1,
            ],
            [

                'key'    => 'students_enrolled',
                'value'  => '1.8',
                'type'   => 'text',
                'display_name'  => 'Students Enrolled',
                'group'  => 'counters',
                'details' => null,
                'status' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'created_by' => 1,
            ],
            [

                'key'    => 'live_training',
                'value'  => '500',
                'type'   => 'text',
                'display_name'  => 'Live Training',
                'group'  => 'counters',
                'details' => null,
                'status' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'created_by' => 1,
            ],
            [

                'key'    => 'community_earning',
                'value'  => '65',
                'type'   => 'text',
                'display_name'  => 'Community Earning',
                'group'  => 'counters',
                'details' => null,
                'status' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'created_by' => 1,
            ],

            [

                'key'    => 'weekly_payment_mail_content',
                'value'  =>  null,
                'type'   => 'text_area',
                'display_name'  => 'Weekly Payment Mail Content',
                'group'  => 'mail',
                'details' => '[USERNAME], [WEEKLY_EARNING_AMOUNT], [TOTAL_EARNING_AMOUNT], [SUPPORT_EMAIL], [SUPPORT_PHONE], [APP_NAME]',
                'status' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'created_by' => 1,
            ],

            [
                'key'    => 'payment_qr_code_google',
                'value'  => null,
                'type'   => 'image',
                'display_name'  => 'COD QR Code Image',
                'group'  => 'payment',
                'details' => '',
                'status' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'created_by' => 1,
            ],

            [
                'key'    => 'payment_cod_status',
                'value'  => null,
                'type'   => 'toggle',
                'display_name'  => 'COD Status',
                'group'  => 'payment',
                'details' => 'active, inactive',
                'status' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'created_by' => 1,
            ],

            [
                'key'    => 'razorpay_key',
                'value'  => null,
                'type'   => 'text',
                'display_name'  => 'Razorpay Key',
                'group'  => 'payment',
                'details' => '',
                'status' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'created_by' => 1,
            ],

            [
                'key'    => 'razorpay_secret',
                'value'  => null,
                'type'   => 'text',
                'display_name'  => 'Razorpay Secret',
                'group'  => 'payment',
                'details' => '',
                'status' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'created_by' => 1,
            ],

            [
                'key'    => 'razorpay_status',
                'value'  => null,
                'type'   => 'toggle',
                'display_name'  => 'Razorpay Status',
                'group'  => 'payment',
                'details' => 'active, inactive',
                'status' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'created_by' => 1,
            ],

            [
                'key'    => 'phone_pe_merchant_id',
                'value'  => null,
                'type'   => 'text',
                'display_name'  => 'Phone Pe Merchant ID',
                'group'  => 'payment',
                'details' => '',
                'status' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'created_by' => 1,
            ],

            [
                'key'    => 'phone_pe_key',
                'value'  => null,
                'type'   => 'text',
                'display_name'  => 'Phone Pe Key',
                'group'  => 'payment',
                'details' => '',
                'status' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'created_by' => 1,
            ],

            [
                'key'    => 'phone_pe_status',
                'value'  => null,
                'type'   => 'toggle',
                'display_name'  => 'Phone Pe Status',
                'group'  => 'payment',
                'details' => 'active, inactive',
                'status' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'created_by' => 1,
            ],


        ];

        Setting::insert($settings);
    }
}
