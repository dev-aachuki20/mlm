@extends('emails.layouts.admin')

@section('email-content')
    @php
        $mailContent  = getSetting('package_purchased_mail_content');
        $mailContent  = str_replace('[NAME]',$name,$mailContent);
        $mailContent  = str_replace('[PACKAGE_NAME]', $planName, $mailContent);
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
                    <b>Hello</b> {{ $name ?? "" }},
                </p>
                <div class="mail-desc">
                    <p style="font-size:14px;">Thank you for purchasing the "{{ $planName }}" plan from  {{ config('app.name') }}.</p>
                    <p style="font-size:14px;">You can now enjoy the benefits and features of this plan.</p>
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
