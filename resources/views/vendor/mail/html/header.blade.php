@props(['url'])
<tr>
    <td class="header">
        <a href="{{ $url }}" style="display: inline-block;">
            @if (trim($slot) === 'DigiSplix')
                <img src="https://admin.digisplix.com/images/d-png.png" class="logo">
            @else
                {{ $slot }}
            @endif
        </a>
    </td>
</tr>
