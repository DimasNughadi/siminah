@extends('components._partials.default')

@section('content')
    {{-- {{ dd($reward[0]->nama_reward) }} --}}
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
                                                <th>AKSI</th>
                                            @endslot

                                            @slot('bodySlot')
                                                <tr class="reward-tr permintaan-tr">
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
                                                        <div class="btn-reward btn-table-custom     position-relative">
                                                            <span class="position-relative add-reward">
                                                                Menunggu Konfirmasi
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
                                                </tr>
                                                <tr class="reward-tr permintaan-tr">
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
                                                </tr>
                                            @endslot
                                        </x-forms.table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
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
                                                <tr class="reward-tr permintaan-tr">
                                                    <td class="detail-kelurahan">
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
                                                    <td class="ps-4 d-grid">
                                                        <span>
                                                            28%
                                                        </span>
                                                        <div class="progress-bar">
                                                            <x-progressBar value="15" max="30"/>
                                                        </div>
                                                    </td>
                                                    <td class="ps-4 tanggal">
                                                        18:42, 1 Agu 2023
                                                    </td>
                                                </tr>
                                            @endslot
                                        </x-forms.table>
                                    </div>
                                </div>
                            </div>
                        </div>

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
                                    <div class="col-md-12">
                                        <x-notifikasi.kontainer />
                                    </div>
                                    <div class="col-md-12">
                                        <x-notifikasi.kontainer />
                                    </div>
                                    <div class="col-md-12">
                                        <x-notifikasi.kontainer />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop
