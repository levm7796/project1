<x-mail::message>
    Hello, {{$email}}<br>
    {{$token}}<br>
    Reset password:
<x-mail::button :url="'http://localhost:5173/setPassword/'.$token.'/'.$email">
reset
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
