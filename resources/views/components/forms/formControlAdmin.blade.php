@props([
        'label',
        'type' => 'text',
        'name',
        'placeholder'
    ])

<div class="form-control-admin animate__animated animate__fadeInUp">
    <label for="{{ $name }}" class="form-label">{{ $label }}</label>
    <input type="{{ $type }}" class="form-control" id="{{ $name }}" placeholder="{{ $placeholder }}">
</div>