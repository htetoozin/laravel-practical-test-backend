@component('mail::message')
# {{ $form->title }}
  
I've invited you to fill out a form:
  
@component('mail::button', ['url' => $link ])
Fill Out Form
@endcomponent
  
Thanks,

{{ config('app.name') }}
@endcomponent
