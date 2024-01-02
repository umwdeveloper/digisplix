@props(['url'])
<tr>
    <td class="header">
        <a href="{{ $url }}" style="display: inline-block;">
            @if (trim($slot) === 'DigiSplix')
                <img style="width: 160px; height: auto;" src="https://admin.digisplix.com/images/Logo-Png.png"
                    class="logo">
            @else
                {{ $slot }}
            @endif
        </a>
    </td>
</tr>
