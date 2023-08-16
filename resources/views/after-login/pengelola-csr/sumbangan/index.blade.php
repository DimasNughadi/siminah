@extends('components._partials.default')

@section('content')
    {{-- {{ dd($reward[0]->nama_reward) }} --}}
    <div class="container-fluid py-2 ps-4">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-12 reward text-poppins">Sumbangan</div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-10 col-sm-12 col-12">
                        <div class="container-fluid olah-donatur animate__animated animate__fadeInUp">
                            <div class="row">
                                <div class="col-md-10 col-sm-7 col-7">
                                    <div class="header">
                                        Laporan Sumbangan Minyak Jelantah
                                    </div>
                                </div>
                                <div class="col-md-2 col-sm-5 col-sm-5">
                                    <div class="header-button">
                                        <x-forms.inputDate />
                                        <div
                                            class="text-poppins text-14 btn-reward-position d-flex justify-content-end align-items-end">
                                            <a href="#"
                                                class="btn-reward 
                                            btn-semi-success position-relative d-flex align-items-center">
                                                EXPORT
                                                <span class="material-symbols-outlined">
                                                    download
                                                </span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12 col-12">
                                    <div class="body">
                                        <x-forms.table>
                                            @slot('headSlot')
                                                <th>KELURAHAN</th>
                                                <th>JUMLAH (LITER)</th>
                                                <th>JUMLAH DONATUR</th>
                                                <th>TANGGAL PELAPORAN</th>
                                            @endslot

                                            @slot('bodySlot')
                                                <tr class="reward-tr donatur-csr-tr">
                                                    <td class="ps-3 detail-kelurahan">
                                                        <div class="d-flex align-items-center">
                                                            {{-- <x-user.userImage width="34" height="34"/> --}}
                                                            <div class="ms-2  d-grid">
                                                                <span class="top">
                                                                    Dumai Kota
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="ps-4 subdata">
                                                        130
                                                    </td>
                                                    <td class="ps-4 subdata">
                                                        60
                                                    </td>
                                                    <td class="ps-4 tanggal">
                                                        18 Juli 2023
                                                    </td>
                                                </tr>
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

@stop
