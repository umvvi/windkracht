@component('mail::message')
# Annulering Afgewezen

Hallo {{ $customerName }},

We hebben je aanvraag om de les van **{{ $lessonDate }}** te annuleren helaas afgewezen.

**Reden:**  
{{ $rejectionReason }}

Mocht je hierover vragen hebben, neem dan alstublieft contact op met ons team.

Met vriendelijke groeten,  
**Windkracht-12 Kitesurfschool**
@endcomponent
