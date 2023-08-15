@extends('components._partials.default')

@section('content')
    <div class="container-fluid py-2 ps-4">
        <div class="row">
            <div class="col-lg-11">
                <div class="row">
                    <div class="col-lg-12 reward text-poppins">Donatur</div>
                </div>
                <div class="row reedem-reward animate__animated animate__fadeInLeft">
                    <div class="col-lg-9">
                        <div class="table-header-redeem">
                            Data donatur
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="body">
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
                                    @if (!empty($donatur))
                                        @foreach ($donatur as $item)
                                            <tr class="table-row-image donatur-row">
                                                <td class="ps-4 data-14">
                                                    <div class="d-flex align-items-center">
                                                        <x-user.userImage />
                                                        <div class="ms-3">
                                                            <span>
                                                                {{ Str::substr($item->nama_donatur, 0, 5) }}</span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="ps-4 data-14">
    
                                                    @if ($item->sumbangan_sum_berat === 0 || $item->sumbangan_sum_berat === null)
                                                        -
                                                    @else
                                                        {{ $item->sumbangan_sum_berat }} Kg
                                                    @endif
                                                </td>
                                                <td class="ps-4 data-14">
                                                    {{ $item->kelurahan }}
                                                </td>
                                                <td class="ps-4 data-14">
                                                    14:30, 12 Jan 2023S
                                                </td>
                                                <td class="ps-4 data-14">
                                                    @if ($item->total_donasi === 0)
                                                        -
                                                    @else
                                                        {{ $item->total_donasi }} Kali
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="btn-reward btn-list position-relative">
                                                        <a href="{{ route('donatur.getById', ['id' => $item->id_donatur]) }}"
                                                            class="position-relative add-reward">DETAIL
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td>{{ $message }}</td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                    @endif
    
                                @endslot
                            </x-forms.table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop
