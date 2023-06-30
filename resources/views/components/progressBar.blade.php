@if(strtolower($type) == "kontainer")

    <progress class="progress-{{ $color }} progress-kontainer" value="{{ $value }}" max="{{ $max }}"></progress>

@else

    @if (($value) <= (($max/2)))
        <progress class="progress-red" value="{{ $value }}" max="{{ $max }}"></progress>
    @else
        <progress class="progress-green" value="{{ $value }}" max="{{ $max }}"></progress>
    @endif

@endif