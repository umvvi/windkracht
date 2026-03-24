@component('mail::message')
# Annulering Goedgekeurd

Hallo {{ $customerName }},

Goed nieuws! Je aanvraag om de les van **{{ $lessonDate }}** te annuleren is goedgekeurd.

Je kunt nu een nieuwe lesdatum kiezen. Log in op je account en ga naar je reserveringen om een nieuw moment te selecteren.

Dank je voor je vertrouwen in Windkracht-12!

@component('mail::button', ['url' => route('customer.dashboard')])
Ga naar je Dashboard
@endcomponent

Met vriendelijke groeten,  
**Windkracht-12 Kitesurfschool**
@endcomponent
