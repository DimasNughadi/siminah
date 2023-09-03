@props([
        'source',
        'alt'
    ])

<div class="gambar-lokasi" data-bs-toggle="modal" data-bs-target="#ModalDetailGambarLokasi">
    @if (checkFileIsExist($source))
        <img src="{{ $source }}" alt="" onclick="showDetailGambarLokasi('{{ $src }}')">
    @else
        <img src="https://udluthfi.co.id/wp-content/uploads/2022/03/Toren-pLUMBING-01.jpg" alt="Gambar" onclick="showDetailGambarLokasi('https://udluthfi.co.id/wp-content/uploads/2022/03/Toren-pLUMBING-01.jpg')">
    @endif
</div>
