@extends('components._partials.default')

@section('content')
    {{-- {{ dd($notifikasi) }} --}}
    <div class="container-fluid py-2 ps-4">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-12 reward text-poppins">Olah Kontainer</div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-7 col-sm-12 col-12">
                        <div class="container-fluid manajemen-permintaan animate__animated animate__fadeInUp">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="header">
                                        Manajemen permintaan pergantian
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12 col-12">
                                    <div class="body">
                                        <x-forms.table>
                                            @slot('headSlot')
                                                <th>KELURAHAN</th>
                                                <th>TANGGAL PERMINTAAN</th>
                                                <th>STATUS</th>
                                                {{-- <th>AKSI</th> --}}
                                            @endslot

                                            @slot('bodySlot')
                                            @if (!empty($permintaan))
                                                @foreach ($permintaan as $item)
                                                    <tr class="reward-tr permintaan-tr">
                                                        <td class="ps-3 detail-kelurahan">
                                                            <div class="d-flex align-items-center">
                                                                {{-- <x-user.userImage width="34" height="34"/> --}}
                                                                <div class="ms-2  d-grid">
                                                                    <span class="top">
                                                                        {{ $item->lokasi->nama_kelurahan }}
                                                                    </span>
                                                                    {{-- <span class="bottom">
                                                                        Dumai Kota
                                                                    </span> --}}
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td class="ps-4 tanggal">
                                                            {{ datetimeFormat($item->tanggal_permintaant) }}
                                                        </td>
                                                        <td class="ps-4">
                                                            @if (strtolower($item->status_permintaan) === 'menunggu konfirmasi')
                                                                <div class="btn-reward btn-table-custom     position-relative">
                                                                    <span class="position-relative add-reward">
                                                                        Menunggu Konfirmasi
                                                                    </span>
                                                                </div>
                                                            @else
                                                                <div class="btn-reward btn-table-custom bg-success position-relative">
                                                                    <span class="position-relative add-reward">
                                                                        Berhasil diganti
                                                                    </span>
                                                                </div>
                                                            @endif
                                                        </td>
                                                        {{-- <td class="ps-4">
                                                            @if (strtolower($item->status_permintaan) === 'menunggu konfirmasi')
                                                            <div class="btn-reward btn-table-custom bg-light-success position-relative">
                                                                <span class="position-relative add-reward">
                                                                    GANTI
                                                                </span>
                                                            </div>
                                                            @else
                                                            <div class="btn-reward btn-table-custom bg-light-success position-relative">
                                                                <span class="position-relative add-reward">
                                                                    GANTI
                                                                </span>
                                                            </div>

                                                            @endif
                                                        </td> --}}
                                                    </tr>
                                                @endforeach
                                            @else
                                            @endif
                                                {{-- <tr class="reward-tr permintaan-tr">
                                                    <td class="ps-4 detail-kelurahan">
                                                        <div class="d-flex align-items-center">
                                                            <x-user.userImage width="34" height="34"/>
                                                            <div class="ms-2  d-grid">
                                                                <span class="top">
                                                                    Abdi
                                                                </span>
                                                                <span class="bottom">
                                                                    Dumai Kota
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="ps-4 tanggal">
                                                        18:42, 1 Agustus 2023
                                                    </td>
                                                    <td class="ps-4">
                                                        <div class="btn-reward btn-table-custom bg-success position-relative">
                                                            <span class="position-relative add-reward">
                                                                Berhasil diganti
                                                            </span>
                                                        </div>
                                                    </td>
                                                    <td class="ps-4">
                                                        <div class="btn-reward btn-table-custom bg-light-success position-relative">
                                                            <span class="position-relative add-reward">
                                                                GANTI
                                                            </span>
                                                        </div>
                                                    </td>
                                                </tr> --}}
                                            @endslot
                                        </x-forms.table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                                {{-- {{ dd($kontainer) }} --}}
                    <div class="col-md-5">
                        <div class="container-fluid detail-manajemen-kontainer animate__animated animate__fadeInUp">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="header">
                                        Manajemen Kontainer
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-12">
                                    <div class="body overflowy">
                                        <x-forms.table>
                                            @slot('headSlot')
                                                <th>KELURAHAN</th>
                                                <th>KAPASITAS</th>
                                                <th>TERAKHIR DIISI</th>
                                            @endslot

                                            @slot('bodySlot')
                                            @if (!empty($kontainer))
                                                @foreach ($kontainer as $item)
                                                    <tr class="reward-tr permintaan-tr">
                                                        <td class="detail-kelurahan ps-3">
                                                            <div class="d-flex align-items-center">
                                                                {{-- <x-user.userImage width="34" height="34"/> --}}
                                                                <div class="ms-2  d-grid">
                                                                    <span class="top">
                                                                        {{ $item->lokasi->nama_kelurahan }}
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td class="ps-4 d-grid">
                                                            <span>
                                                                {{ $item->sumbangan_sum_berat }} kg
                                                            </span>
                                                            <div class="progress-bar">
                                                                <x-progressBar value="{{ $item->sumbangan_sum_berat }}" max="{{ $item->kapasitas }}"/>
                                                            </div>
                                                        </td>
                                                        <td class="ps-4 tanggal">
                                                            {{ datetimeFormat($item->sumbangan_max_updated_at) }}
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @else
                                                
                                            @endif
                                            @endslot
                                        </x-forms.table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- {{ dd($notifikasi) }} --}}

                        <div class="notifikasi-kontainer animate__animated animate__fadeInUp">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="header">
                                        Notifikasi
                                    </div>
                                </div>  
                            </div>
                            <div class="body">
                                <div class="row">
                                    @if (!empty($notifikasi))
                                        @foreach ($notifikasi as $item)
                                            <div class="col-md-12">
                                                <x-notifikasi.kontainer action="enable" type="danger"
                                                notifikasi="Kelurahan {{ $item['nama_kelurahan'] }}"
                                                type_detail="Meminta pengajuan pergantian kontainer" id="{{ $item['id_permintaan'] }}"/>
                                            </div>
                                        @endforeach
                                    @else
                                        <div class="col-md-12">
                                            <x-notifikasi.kontainer action="disable" type="success" kelurahan="Tidak ada permintaan" type_detail="Seluruh kontainer ready"/>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@extends('components._partials.scripts')
@section('script')
    <x-sweetalert />
@endsection
