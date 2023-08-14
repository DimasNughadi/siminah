@extends('components._partials.default')

@section('content')
    <div class="container-fluid py-2 ps-4">
        <div class="row">
            <div class="col-lg-12 page-header text-poppins">
                <a href="{{ route('donatur') }}" class="text-secondary link-secondary">Donatur</a>
                <span>
                    <b>
                        &nbsp;/ Detail Donatur
                    </b>
                </span>
            </div>
        </div>
        <div class="row pt-3">
            <div class="col-md-4 detail-donatur-wrapper margin-left-24">
                <div class="detail-donatur-card">
                    <div class="row header">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-12 d-flex justify-content-center align-items-center">
                                    <img src="https://images.unsplash.com/photo-1438761681033-6461ffad8d80?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mnx8cGVyc29ufGVufDB8fDB8fHww&w=1000&q=80"
                                        alt="Abdi">
                                </div>
                                <div class="col-md-12 d-flex justify-content-center align-items-center">
                                    <span>
                                        Abdi
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row summary">
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-3 icon">
                                    <span class="material-symbols-outlined">
                                        water_drop
                                    </span>
                                </div>
                                <div class="col-md-9 sum">
                                    <div class="row">
                                        <div class="col-md-12 top">
                                            15 L
                                        </div>
                                        <div class="col-md-12 bottom">
                                            Jumlah Donasi
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-3 icon">
                                    <span class="material-symbols-outlined">
                                        place_item
                                    </span>
                                </div>
                                <div class="col-md-9 sum">
                                    <div class="row">
                                        <div class="col-md-12 top">
                                            23
                                        </div>
                                        <div class="col-md-12 bottom">
                                            Total Donasi
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row detail">
                        <div class="col-md-12 header">
                            <span>
                                Detail
                            </span>
                        </div>
                        <div class="col-md-12 line">
                            <hr>
                        </div>
                        <div class="col-md-12 user-detail">
                            <div class="row">
                                <div class="col-md-12">
                                    <span class="head">Nama: </span>
                                    <span class="body">Andi</span>
                                </div>
                                <div class="col-md-12">
                                    <span class="head">Email: </span>
                                    <span class="body">Abdi@gmail.com</span>
                                </div>
                                <div class="col-md-12">
                                    <span class="head">Kontak: </span>
                                    <span class="body">+62 821231313</span>
                                </div>
                                <div class="col-md-12">
                                    <span class="head">Jalan: </span>
                                    <span class="body">Jl. Dumai Selatan</span>
                                </div>
                                <div class="col-md-12">
                                    <span class="head">Kelurahan: </span>
                                    <span class="body">Tanjung Palas</span>
                                </div>
                                <div class="col-md-12">
                                    <span class="head">Kecamatan: </span>
                                    <span class="body">Dumai Timur</span>
                                </div>
                                <div class="col-md-12">
                                    <span class="head">Kota: </span>
                                    <span class="body">Dumai</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="row riwayat-donatur-wrapper">
                    <div class="col-md-12">
                        <div class="container-fluid">
                            <h1>Riwayat Donasi</h1>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <x-forms.table>
                            @slot('headSlot')
                                <th class="text-semi-dark">LOKASI KONTAINER</th>
                                <th class="text-semi-dark">JUMLAH KONTAINER</th>
                                <th class="text-semi-dark">TANGGAL</th>
                                <th class="text-semi-dark">WAKTU</th>
                            @endslot

                            @slot('bodySlot')
                                <tr class="reward-row table-row-image">
                                    <td class="ps-4 text-semi-dark">
                                        Tanjung Palas
                                    </td>
                                    <td class="ps-4 text-semi-dark text-inter-regular text-14">
                                        3 L
                                    </td>
                                    <td class="ps-4 text-semi-dark text-inter-regular text-14">
                                        12 Januari 2023
                                    </td>
                                    <td class="ps-4 text-semi-dark-68 text-inter-regular text-14">
                                        17:51
                                    </td>
                                </tr>
                            @endslot
                        </x-forms.table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop
