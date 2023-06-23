@extends('emails.layouts.admin')

@section('email-content')
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

@endsection
