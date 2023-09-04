@extends('components._partials.default')

@section('content')
    <div class="container-fluid py-2 ps-4">
        <div class="row">
            <div class="col-lg-12 page-header text-poppins">
                <a href="{{ route('sumbangan') }}" class="text-secondary link-secondary">Sumbangan</a>
                <span>
                    <b>
                        &nbsp;/ Detail Sumbangan
                    </b>
                </span>
            </div>
        </div>
        <div class="row pt-3">
            <div class="col-xxl-10">
                <div class="row detail-riwayat-sumbangan animate__animated animate__fadeInRight ">
                    <div class="col-md-12">
                        <div class="container-fluid">
                            <h1>Riwayat Donasi</h1>
                        </div>
                    </div>
                    {{-- {{ dd($riwayat) }} --}}

                    <div class="col-md-12">
                        <div class="body overflowy-kontainer-kelurahan">
                            <x-forms.table>
                                @slot('headSlot')
                                    <th>NAMA</th>
                                    <th>BERAT SUMBANGAN</th>
                                    <th>WAKTU SUMBANGAN</th>
                                    <th>STATUS</th>
                                @endslot

                                @slot('bodySlot')
                                    @if (!empty($riwayat))
                                        @foreach ($riwayat as $item)
                                            <tr class="verifikasi-tr">
                                                <td class="ps-4 nama">
                                                    <div class="d-flex align-items-center justify-center">
                                                        <x-user.userImage src="{{ 'donatur/' . $item->donatur->photo }}" />
                                                        <div class="ms-2">
                                                            <span
                                                                class="top">{{ getFirstName($item->donatur->nama_donatur) }}</span><br>
                                                            <span class="bottom">{{ $item->berat }}
                                                                Kg</span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="ps-4 tanggal">
                                                  {{ $item->berat }}
                                                  Kg
                                                </td>
                                                <td class="ps-4 tanggal">
                                                    {{ datetimeFormat($item->updated_at) }}
                                                </td>
                                                <td class="ps-4 ">
                                                    @if (strtolower($item->status) === 'terverifikasi')
                                                        <div
                                                            class="btn-reward btn-table-custom bg-success
                                              position-relative">
                                                            <span class="position-relative add-reward">
                                                                Terverifikasi
                                                            </span>
                                                        </div>
                                                    @else
                                                        <div
                                                            class="btn-reward btn-table-custom bg-danger
                                              position-relative">
                                                            <span class="position-relative add-reward">
                                                                Ditolak
                                                            </span>
                                                        </div>
                                                    @endif
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

@stop
