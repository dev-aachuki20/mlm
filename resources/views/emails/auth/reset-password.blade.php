@extends('emails.layouts.admin')

@section('styles')
  <style>
    .reset-password-btn{
        box-sizing:border-box;
        font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,Helvetica,Arial,sans-serif,'Apple Color Emoji','Segoe UI Emoji','Segoe UI Symbol';
        border-radius:4px;
        color:#fff;
        display:inline-block;
        overflow:hidden;
        text-decoration:none;
        background-color:#f34d03;
        border-bottom:8px solid #f34d03;border-left:18px solid #f34d03;border-right:18px solid #f34d03;border-top:8px solid #f34d03;
    }
  </style>
@endsection

@section('email-content')
    @php
        $mailContent  = getSetting('reset_password_mail_content');
        $mailContent  = str_replace('[NAME]',$name,$mailContent);

        $resetPasswordBtn = '<a href="'.$reset_password_url.'" class="reset-password-btn" target="_blank">Reset Password</a>';

        $mailContent  = str_replace('[RESET_PASSWORD_BUTTON]', $resetPasswordBtn, $mailContent);

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
                <p style="font-size:14px;">You are receiving this email because we received a password reset request for your account</p>
                <p style="font-size:14px;">Please click on the link below to reset your password and get access to your account :</p>
            </div>
        </td>
        <tr>
            <td style="box-sizing:border-box;text-align: center;font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,Helvetica,Arial,sans-serif,'Apple Color Emoji','Segoe UI Emoji','Segoe UI Symbol'">

            <a href="{{ $reset_password_url }}" style="box-sizing:border-box;font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,Helvetica,Arial,sans-serif,'Apple Color Emoji','Segoe UI Emoji','Segoe UI Symbol';border-radius:4px;color:#fff;display:inline-block;overflow:hidden;text-decoration:none;background-color:#f34d03;border-bottom:8px solid #f34d03;border-left:18px solid #f34d03;border-right:18px solid #f34d03;border-top:8px solid #f34d03" target="_blank">Reset Password</a>

            </td>
        </tr>
        <tr>
            <td>
                <p style="font-size:14px;">If you did not request a password reset, no further action is required.</p>
            </td>
        </tr>
    </tr>
   @endif

@endsection
