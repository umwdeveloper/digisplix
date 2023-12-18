<x-mail::message>
# Registration

Hi **{{ $name }}**,

You are registered successfully! Please use the following credentials to login to the website.

Email: **{{ $email }}**

Password: **{{ $password }}**

<x-mail::button :url="env('CLIENT_SUBDOMAIN')">
Login
</x-mail::button>

Thank you,<br>
**{{ config('app.name') }}**
</x-mail::message>
