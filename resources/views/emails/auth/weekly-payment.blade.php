@extends('emails.layouts.admin')

@section('email-content')
        @php
           $mailContent  = getSetting('weekly_payment_mail_content');
            //dd($mailContent);
            $mailContent  = str_replace('[USERNAME]',$userName,$mailContent);
            $mailContent  = str_replace('[WEEKLY_EARNING_AMOUNT]', $weeklyEarning,$mailContent);
            $mailContent  = str_replace('[TOTAL_EARNING_AMOUNT]',$totalEarning,$mailContent);
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
                        <b>Dear</b> {{ $userName ? ucwords($userName) : "" }},
                    </p>
                    <div class="mail-desc">
                        <p style="font-size:14px;">
                            We hope this mail finds you in high spirits. It's time to celebrate your hard work and success in our dynamic network marketing program! We're thrilled to inform you that your weekly earnings are now ready for withdrawal.
                        </p>

                        <p style="font-size:14px;">Here's a quick overview of your achievements this week:<br>
                            <strong>Total Earning Generated</strong> : ₹ {{ $weeklyEarning }}<br>
                            <strong>Total Earnings</strong>: ₹ {{ $totalEarning }}<br>
                        </p>

                        <p style="font-size:14px;">
                            Your dedication and commitment have not only contributed to your personal growth but have also played a significant role in the success of our entire network. We value your efforts and are excited to reward you for your achievements.
                        </p>

                        <p style="font-size:14px;">
                            We appreciate your ongoing dedication to our network, and we look forward to witnessing your continued success. Keep up the fantastic work!
                        </p>

                        <p style="font-size:14px;">
                            Congratulations again, and here's to another week of prosperity!
                        </p>

                    </div>
                </td>

                <tr>
                    <td>
                        <p style="font-size:14px;">If you have any questions or need assistance with our support team is here to help. Simply reply to this email, and we'll get back to you promptly. {{ config('constants.support_email') }} or {{ config('constants.support_phone') }}.</p>
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
