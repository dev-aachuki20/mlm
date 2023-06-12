@extends('emails.layouts.admin')

@section('email-content')
<tr>
	<td>
		<p class="mail-title">
			<b>Hello</b> {{ $name ?? "" }},
		</p>
		<div class="mail-desc">
			<p>Thank you for signing up for [service name]. Your password for accessing your account is {{$password}}. Please keep it safe and do not share it with anyone.</p>
			<p>To log in to your account, please visit <a href="{{ route('auth.login') }}">{{ route('auth.login') }}</a> and enter your email address and password. You can also change your password anytime from your account settings.</p>
		</div>
	</td>
    <tr>
        <td>
            <p style="font-size:14px;">If you have any questions or issues, please contact us at {{ config('constants.support_email') }} or {{ config('constants.support_phone') }}.</p>
            
            <p>We hope you enjoy using our service.</p>
        </td>
    </tr>

    <tr>
        <td>
            <p style="font-size:14px;">Sincerely</p>
            <p>{{ config('app.name') }}</p>
        </td>
    </tr>
</tr>

@endsection
