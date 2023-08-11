@props([
    'color',
    'title',
    'type' =>'button'
])

<button type="{{ $type }}" class="btn btn-{{ $color }}">{{ $title }}</button>