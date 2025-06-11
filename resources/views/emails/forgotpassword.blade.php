@component('mail::message')

<p>Hello {{ $user->name }}</p>

<p>Please click on reset your password</p>

@component('mail::button', ['url' => 'http://127.0.0.1:8000/reset-password/'.$user->remember_token])
Reset Your Password
@endcomponent

Thank You <br/>
{{ config('app.name') }}

@endcomponent