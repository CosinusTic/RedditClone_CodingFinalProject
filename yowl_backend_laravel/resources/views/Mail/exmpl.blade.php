@component('mail::message')
Hello **{{$name}}**,  {{-- use double space for line break --}}
Thank you for creating an account!
Click below to verify your email and finalize your registration to Rebbit!
@component('mail::button', ['url' => $link])
Verify your email
@endcomponent
Sincerely,
Mailtrap team.