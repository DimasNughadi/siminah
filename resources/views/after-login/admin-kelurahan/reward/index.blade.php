@extends('components._partials.default')

@section('content')
    {{-- {{ dd($reward[0]->nama_reward) }} --}}
    <div class="container-fluid py-2 ps-4">
        <div class="row">
            <div class="col-md-10">
                <div class="row">
                    <div class="col-md-12 reward text-poppins">Reward</div>
                </div>
                <div class="row reedem-reward">
                    <div class="col-md-9">
                        <div class="table-header-redeem">
                            Riwayat penukaran hadiah
                        </div>
                    </div>
                    <div
                        class="col-md-3 text-poppins text-14 btn-reward-position d-flex justify-content-center align-items-center">
                        <div class="btn-reward btn-custom-success position-relative">
                            <a href="{{ route('reward/reward-list') }}" class="position-relative add-reward">Lihat Daftar
                                hadiah</a>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <x-forms.table>
                            @slot('headSlot')
                                <th>NAMA USER</th>
                                <th>JUMLAH POIN</th>
                                <th>NAMA HADIAH</th>
                                <th>WAKTU PENUKARAN</th>
                                <th>TOTAL PENUKARAN</th>
                            @endslot

                            @slot('bodySlot')
                                <tr class="reward-tr table-row-image">
                                    <td class="ps-4">
                                        <div class="d-flex align-items-center">
                                            <x-userImage src="../assets/img/products/product-1-min.jpg" alt="as"/>
                                            <div class="ms-2 poppins">
                                                Abdi
                                            </div>
                                        </div>
                                    </td>
                                    <td class="ps-4 poppins">
                                        500
                                    </td>
                                    <td class="ps-4">
                                        <div class="d-flex flex-column gap-0">
                                            <span class="poppins">as</span>
                                        </div>
                                    </td>
                                    <td class="ps-4">
                                        14:30, 12 Jan 2023
                                    </td>
                                    <td class="ps-4">
                                        5 Kali
                                    </td>
                                </tr>
                                {{-- @if (!empty($reward))
                                @else
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td>{{ $message }}</td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                @endif --}}
                            @endslot
                        </x-forms.table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop
