@component('mail::message')
# Introduction

Hi {{ $first_name }}! You have just successfully registered an account. Please verify your email address first before using the app's services. Your verification code is <b>{{ $code }}</b>.

@component('mail::button', ['url' => $url])
Verify my account
@endcomponent

Thanks,<br>
{{ config('app.name') }} Team
@endcomponent