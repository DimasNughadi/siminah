@props(['color', 'title', 'type' => 'button', 'id' => ''])

@if ($id === '')
    <button type="{{ $type }}"
        class="forms-sumbit btn btn-{{ $color }} text-capitalize">{{ $title }}</button>
@else
    <button type="{{ $type }}"
        class="forms-sumbit btn btn-{{ $color }} text-capitalize" id="{{ $id }}">{{ $title }}</button>
@endif
