@component('mail::message')
# Welcome {{ $user->name }}

You are now a part of Actualyzd Organization!

{{-- @component('mail::button', ['url' => ''])
Button Text
@endcomponent --}}

Thanks,<br>
{{ config('app.name') }}
@endcomponent
