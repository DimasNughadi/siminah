@extends('components._partials.default')

@section('content')

    <div class="container-fluid py-2 ps-4">
        <div class="row">
            <div class="col-lg-10">
                <div class="row">
                    <div class="col-lg-12 reward text-poppins">
                        Admin Kelurahan
                    </div>
                </div>
                <div class="row reedem-reward">
                    <div class="col-lg-10">
                        <div class="table-header-redeem">
                            Daftar Admin
                        </div>
                    </div>
                    <div
                        class="col-lg-2 text-poppins text-14 btn-reward-position d-flex justify-content-end align-items-end">
                        <div>
                            <a href="{{ route('admin.create') }}"
                                class="btn-reward btn-custom-success position-relative">Tambah</a>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <x-forms.table>
                            @slot('headSlot')
                                <th class="text-semi-dark">NAMA ADMIN</th>
                                <th class="text-semi-dark">EMAIL</th>
                                <th class="text-semi-dark">NO TELEPON</th>
                                <th class="text-semi-dark">ALAMAT</th>
                                <th class="text-semi-dark">AKSI</th>
                            @endslot

                            @slot('bodySlot')
                                <tr class="reward-row table-row-image">
                                    <td class="ps-4">
                                        <span class="top">Josep Ronaldo</span>
                                        <span class="bottom">Dumai Panjang</span>
                                    </td>
                                    <td class="ps-4 text-semi-dark text-inter-regular text-14">
                                        josep@gmail.com
                                    </td>
                                    <td class="ps-4 text-semi-dark text-inter-regular text-14">
                                        0821-991-221
                                    </td>
                                    <td class="ps-4 text-semi-dark-68 text-inter-regular text-14">
                                        Jl.Lobak,Dumai panjang, Dumai, Riau
                                    </td>
                                    <td>
                                        <div class="btn-reward btn-list btn-success position-relative">
                                            <a href="#" class="position-relative add-reward" data-bs-toggle="modal"
                                                data-bs-target="#edit-reward">EDIT
                                            </a>
                                        </div>
                                        &nbsp;&nbsp;&nbsp;
                                        <div class="btn-reward btn-list btn-custom-danger position-relative">
                                            <a href="#" class="position-relative add-reward"
                                                onclick="deleteRecord(1)">DELETE</a>
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
