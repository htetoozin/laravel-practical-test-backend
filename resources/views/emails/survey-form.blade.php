@component('mail::message')
# {{ $form->title }}
  
The body of your message.
  
@component('mail::button', ['url' => $link ])
Fill Out
@endcomponent
  
Thanks,

{{ config('app.name') }}
@endcomponent