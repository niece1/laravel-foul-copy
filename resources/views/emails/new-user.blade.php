@component('mail::message')
# Welcome to Rosy.

This is our new shop.

@component('mail::button', ['url' => 'www.rosy.biz'])
Return to Rosy
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
