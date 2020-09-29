@component('mail::message')
# Bienvenue

Merci de vous etre inscrit sur notre application.

@component('mail::button', ['url' => ''])
Button Text
@endcomponent

Cordialement,<br>
{{ config('app.name') }}
@endcomponent
