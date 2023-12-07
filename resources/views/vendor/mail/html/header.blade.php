@props(['url'])
<tr>
    <td class="header">
        <a href="{{ $url }}" style="display: inline-block;">
            @if (trim($slot) === 'Digisplix')
                <img src="{{ asset('images/d-png.png') }}" class="logo" alt="Digisplix Logo">
            @else
                {{ $slot }}
            @endif
        </a>
    </td>
</tr>
