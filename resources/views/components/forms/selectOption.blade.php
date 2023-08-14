@props([
    'name',
    'label'
    ])

<div class="form-control-admin">
    <label for="{{ $name }}" class="form-label">{{ $label }}</label>
    <select class="form-select" aria-label="Default select example" name="kelurahan">
        <option selected>Pilih {{ $name }}</option>
        {{ $slotOptions }}
    </select>
</div>
