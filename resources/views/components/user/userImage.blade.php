@props([
    'src' => 'donatur/default/profile.png',
    'alt' => '',
    'width' => '44px',
    'height' => '44px'
])

<img class="user-image" src="{{ asset('storage/' . $src) }}" alt="{{ $alt }}" width="{{ $width }}" height="{{ $height }}">