@extends('components._partials.default')

@section('content')
    <div class="container-fluid py-2 ps-4">
        <div class="row">
            <div class="col-lg-10">
                <div class="row">
                    <div class="col-lg-12 reward text-poppins">Donatur</div>
                </div>
                <div class="row reedem-reward">
                    <div class="col-lg-9">
                        <div class="table-header-redeem">
                            Data donatur
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <x-forms.table>
                            @slot('headSlot')
                                <th>NAMA DONATUR</th>
                                <th>JUMLAH DONASI</th>
                                <th>KELURAHAN</th>
                                <th>WAKTU DONASI</th>
                                <th>TOTAL DONASI</th>
                                <th>AKSI</th>
                            @endslot

                            @slot('bodySlot')
                                <tr class="table-row-image donatur-row">
                                    <td class="ps-4 data-14">
                                        <div class="d-flex align-items-center">
                                            <x-user.userImage />
                                            <div class="ms-3">
                                                <span>Abdi</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="ps-4 data-14">
                                        15 L
                                    </td>
                                    <td class="ps-4 data-14">
                                        Tanjung Palas
                                    </td>
                                    <td class="ps-4 data-14">
                                        14:30, 12 Jan 2023S
                                    </td>
                                    <td class="ps-4 data-14">
                                        5 Kali
                                    </td>
                                    <td>
                                        <div class="btn-reward btn-list position-relative">
                                            <a href="{{ route('donatur.getById', 1) }}" class="position-relative add-reward">DETAIL
                                            </a>
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
@stop
