@component('mail::message')
# Introduction

Hello {{ $client->name }}, you are now registered to actualyzd web application

@component('mail::button', ['url' => '/'])
View Profile
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
