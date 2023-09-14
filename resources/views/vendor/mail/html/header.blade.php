<tr>
    <td class="header">
        <a href="{{ $url }}" style="display: inline-block;">
            @if (trim($slot) === 'MG Metals')
                <img src="{{ asset('frontend/images/logo-gold.png') }}" class="logo" alt="MG Metal Logo">
            @else
                {{ $slot }}
            @endif
        </a>
    </td>
</tr>
