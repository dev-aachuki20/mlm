@extends('emails.layouts.admin')

@section('email-content')
<tr>
	<td>
		<p class="mail-title" style="font-size:14px;">
			<b>Hello</b> {{ ucwords($name) }},
		</p>
		<div class="mail-desc">
            <p style="font-size:14px;">Congratulations and welcome to {{ config('app.name') }}! We are thrilled to have you on board and look forward to your success in our program. This email serves as a confirmation of your successful registration.
            </p>
		</div>
	</td>
   
    <tr>
        <td>
            <p style="font-size:14px;">Feel free to explore our MLM platform, where you can:</p>
            <div class="mail-desc" style="font-size:14px;">
                <ul>
                    <li>Access your personalized dashboard.</li>
                    <li>Explore available products and services.</li>
                    <li>Connect with your upline and downline members.</li>
                    <li>Attend training sessions and webinars.</li>
                    <li>Track your earnings and commission.</li>

                </ul>
            </div>
        </td>
    </tr>
    <tr>
        <td>
            <p style="font-size:14px;">
                If you have any questions or need assistance, our support team is always here to help. Don't hesitate to reach out by replying to this email or visiting our support section on the website.
                please contact us at {{ config('constants.support_email') }} or {{ config('constants.support_phone') }}
            </p>
            
            <p style="font-size:14px;">We wish you great success in your MLM journey and hope you achieve your goals and dreams with our program. Remember, your success is our success!</p>

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
