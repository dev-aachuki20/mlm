@extends('emails.layouts.admin')

@section('email-content')
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
            <p style="font-size:14px;">If you have any questions or issues, please contact us at {{ config('constants.support_email') }} or {{ config('constants.support_phone') }}.</p>
        </td>
    </tr>

    <tr>
        <td>
            <p style="font-size:14px;">Best regards,</p>
            <p style="font-size:14px;">{{ config('app.name') }}</p>
        </td>
    </tr>
</tr>

@endsection
