@props([
    'src' => 'products/product-1-min.jpg',
    'alt' => '',
    'width' => '44px',
    'height' => '44px'
])

<img class="user-image" src="{{ asset('assets/img/' . $src) }}" alt="{{ $alt }}" width="{{ $width }}" height="{{ $height }}">