<x-mail::message>
Hi **{{ $name }}**,

Your confirmation code is **{{ $code }}**

If you did not initiate the request, we recommend reviewing your account credentials.

Thank you,

**{{ config('app.name') }}**
</x-mail::message>
