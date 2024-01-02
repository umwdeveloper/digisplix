<x-mail::message>
Hi **{{ $name }}**,

You have been registered successfully! Please use the following credentials to login to Client's Dashboard.

Email: **{{ $email }}**

Password: **{{ $password }}**

<x-mail::button :url="config('custom.client_subdomain')">
Login
</x-mail::button>

Thank you,<br>
**{{ config('app.name') }}**
</x-mail::message>
