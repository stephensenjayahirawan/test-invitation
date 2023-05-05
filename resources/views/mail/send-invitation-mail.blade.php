<x-mail::message>
    Hi {{$name}},

You are invited to join us as {{$role}}. You can register by click the button below:

<x-mail::button :url="$url">
Click Here!
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
