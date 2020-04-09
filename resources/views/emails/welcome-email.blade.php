@component('mail::message')
# Welcome To Laragram

This is a community of fellow developers and we love you join us.

@component('mail::button', ['url' => ''])
confirm
@endcomponent

All The Best,<br>
{{ config('app.name') }} Team
@endcomponent
