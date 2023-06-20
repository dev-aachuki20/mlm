@extends('emails.layouts.admin')

@section('email-content')
<tr>
	<td>
		<p class="mail-title" style="font-size:14px;">
			<b>Hello</b> {{ $name ?? "" }},
		</p>
		<div class="mail-desc">
			<p style="font-size:14px;">Thank you for signing up for {{ config('app.name') }}. Your password for accessing your account is <b>"{{$password}}"</b>. Please keep it safe and do not share it with anyone.</p>
			<p style="font-size:14px;">To log in to your account, please visit <a href="{{ route('auth.login') }}">{{ route('auth.login') }}</a> and enter your email address and password. You can also change your password anytime from your account settings.</p>
		</div>
	</td>
    <tr>
        <td>
            <p style="font-size:14px;">If you have any questions or issues, please contact us at {{ config('constants.support_email') }} or {{ config('constants.support_phone') }}.</p>
            
            <p style="font-size:14px;">We hope you enjoy using our service.</p>
        </td>
    </tr>

    <tr>
        <td>
            <p style="font-size:14px;">Regards,</p>
            <p style="font-size:14px;">{{ config('app.name') }}</p>
        </td>
    </tr>
</tr>

@endsection
