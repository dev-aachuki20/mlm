@extends('emails.layouts.admin')

@section('email-content')
        @php
            $mailContent  = getSetting('referral_commission_level_two_mail_content');
            //dd($mailContent);
            $mailContent  = str_replace('[REFERRAL_NAME]',$referalName,$mailContent);
            $mailContent  = str_replace('[PACKAGE_NAME]', $planName,$mailContent);
            $mailContent  = str_replace('[REGISTERED_USER_NAME]',$username,$mailContent);
            $mailContent  = str_replace('[REGISTERED_USER_EMAIL]',$useremail,$mailContent);
            $mailContent  = str_replace('[REGISTERED_USER_PHONE]',$userphone,$mailContent);
            $mailContent  = str_replace('[REFERRAL_COMMISSION_AMOUNT]',$commissionAmount,$mailContent);
            $mailContent  = str_replace('[SUPPORT_EMAIL]', getSetting('support_email'), $mailContent);
            $mailContent  = str_replace('[SUPPORT_PHONE]', getSetting('support_phone'), $mailContent);
            $mailContent  = str_replace('[APP_NAME]', config('app.name'), $mailContent);
        @endphp

        @if($mailContent)
            {!! $mailContent !!}
        @else
            <tr>
                <td>
                    <p class="mail-title" style="font-size:14px;">
                        <b>Hello</b> {{ $referalName ? ucwords($referalName) : "" }},
                    </p>
                    <div class="mail-desc">
                        <p style="font-size:14px;">Congratulations! You've Earned a Commission</p>

                        <p style="font-size:14px;">We are excited to inform you that a new user has successfully registered by referral. As a token of our appreciation, you've earned a commission of Amount <span style="color:black; font-weight:bold">₹ {{ $commissionAmount }}</span>
                        </p>
                        <p style="font-size:14px;">Details of the newly registered user: <br>
                            <strong>- Package Purchased:</strong> {{ ucwords($planName) }} <br>
                            <strong>- Name:</strong> {{ ucwords($username) }} <br>
                            <strong>- Email:</strong> {{ $useremail }} <br>
                            <strong>- Phone:</strong> {{ $userphone }} <br>
                        </p>
                    </div>
                </td>

                <tr>
                    <td>
                        <p style="font-size:14px;">If you have any questions or issues, please contact us at {{ getSetting('support_email') ? getSetting('support_email') : config('constants.support_email') }} or {{ getSetting('support_phone') ? getSetting('support_phone') : config('constants.support_phone') }}.</p>
                    </td>
                </tr>

                <tr>
                    <td>
                        <p style="font-size:14px;">Regards,</p>
                        <p style="font-size:14px;">{{ config('app.name') }}</p>
                    </td>
                </tr>
            </tr>
        @endif
@endsection
