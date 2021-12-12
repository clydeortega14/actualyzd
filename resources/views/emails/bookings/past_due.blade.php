@component('mail::message')
# WARNING!!!

Seems like you have an _UNCLOSED BOOKING_, Please close it immediately

@component('mail::button', ['url' => $url ])
Close Now
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
