@extends('components._partials.default')

@section('content')
    <div class="container-fluid py-2 ps-4">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-12 reward text-poppins">Lokasi</div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-12 col-sm-12 col-12">
                        <div class="container-fluid olah-donatur animate__animated animate__fadeInUp">
                            <div class="row">
                                <div class="col-md-8 col-sm-7 col-7">
                                    <div class="header">
                                        Daftar lokasi pengumpulan minyak
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-5 col-sm-5">
                                    <div class="laporan-button d-flex align-items-center justify-content-end">
                                        <div class="header-button">
                                            <div
                                                class="text-poppins text-14 btn-reward-position d-flex justify-content-end align-items-end">
                                                <a href="{{ route('lokasi.create') }}"
                                                    class="btn-reward 
                                                btn-semi-success position-relative d-flex align-items-center export-btn">
                                                    Tambah lokasi
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12 col-12">
                                    <div class="body">
                                        <x-forms.table id="sumbangan-table">
                                            @slot('headSlot')
                                                <th>ALAMAT</th>
                                                <th>KECAMATAN</th>
                                                <th>KELURAHAN</th>
                                                <th>JUMLAH KONTAINER</th>
                                                <th>KOORDINAT</th>
                                                <th>AKSI</th>
                                            @endslot

                                            @slot('bodySlot')
                                            @if (!empty($lokasi))
                                                @foreach ($lokasi as $item)
                                                <tr class="reward-tr lokasi-tr">
                                                    <td class="ps-4">
                                                        {{ limitAlamatLength($item->deskripsi) }}
                                                    </td>
                                                    <td class="ps-4">
                                                        {{ $item->kecamatan->nama_kecamatan }}
                                                    </td>
                                                    <td class="ps-4">
                                                        {{ $item->nama_kelurahan }}
                                                    </td>
                                                    <td class="ps-4">
                                                        {{ $item->kontainer_count }}
                                                    </td>
                                                    <td class="ps-4 soft">
                                                        <div class="koordinat">
                                                            <div class="top">
                                                                {{ $item->latitude }}
                                                            </div>
                                                            <div class="bottom">
                                                                {{ $item->longitude }}
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="ps-3">
                                                        <div class="btn-reward btn-list position-relative">
                                                            <a href="{{ route('lokasi.edit', ['id' => $item->id_lokasi]) }}" class="position-relative add-reward">EDIT
                                                            </a>
                                                        </div>
                                                        <div class="btn-reward btn-list
                                                        bg-danger position-relative" onclick="hapusLokasi('{{ route('lokasi.destroy', ['id' => $item->id_lokasi]) }}')">
                                                            <a href="#" class="position-relative add-reward">DELETE
                                                            </a>
                                                        </div>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            @endif
                                            @endslot
                                        </x-forms.table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- forms --}}
    <form id="formsDeleteLokasi" action="" method="POST">
        @csrf
        @method('DELETE')
    </form>
@stop
