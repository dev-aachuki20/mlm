@extends('emails.layouts.admin')

@section('email-content')
   @php
        $mailContent  = getSetting('contact_us_mail_content');
        $mailContent  = str_replace('[APP_NAME]',config('app.name'),$mailContent);
        $mailContent  = str_replace('[MESSAGE]',$message,$mailContent);
        $mailContent  = str_replace('[NAME]',$name,$mailContent);
        $mailContent  = str_replace('[EMAIL]',$email,$mailContent);

   @endphp
   @if($mailContent)
        {!! $mailContent !!}
   @else
    <tr>
        <td>
            <p class="mail-title" style="font-size:14px;">
                Hello {{ config('app.name') }},
            </p>
            <div class="mail-desc">
                <p style="font-size:14px;">{{ $message }}</p>
            </div>
        </td>

        <tr>
            <td>
                <p style="font-size:14px; line-height:0.5em;">
                    Sincerely,
                </p>
                <p style="font-size:14px; line-height:0.5em;">Name : {{ $name }}</p>
                <p style="font-size:14px; line-height:0.5em;">Email : {{ $email }}</p>
            </td>
        </tr>
    </tr>
   @endif

@endsection
