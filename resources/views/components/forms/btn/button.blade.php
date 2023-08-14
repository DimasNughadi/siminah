@props([
    'color',
    'title',
    'type' =>'button'
])

<button type="{{ $type }}" class="btn btn-{{ $color }} text-capitalize">{{ $title }}</button>