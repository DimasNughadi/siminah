@extends('components._partials.default')

@section('content')
    <div class="container-fluid py-2 ps-4">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-12 reward text-poppins">Kontainer</div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-4 col-sm-12 col-12">
                        <div class="container-fluid kontainer-kelurahan animate__animated animate__fadeInLeft">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="header">
                                        Kapasitas kontainer
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12 col-12">
                                    <div class="body">
                                        <div class="row">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="196" height="196"
                                                viewBox="0 0 196 196" fill="none">
                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                    d="M98 196C152.124 196 196 152.124 196 98C196 43.8761 152.124 0 98 0C43.8761 0 0 43.8761 0 98C0 152.124 43.8761 196 98 196Z"
                                                    fill="#E2FBD7" />
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="footer">
                                        <canvas class="circle"></canvas>
                                        <span>Kontainer terisi</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8 col-sm-12 col-12">
                        <div class="table-kontainer-kelurahan animate__animated animate__fadeInUp">
                            <div class="main-table">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-8 col-sm-12 col-12">
                                                <div class="header">
                                                    Riwayat penggantian kontainer
                                                </div>
                                            </div>
                                            <div class="col-md-4 header-button">
                                                <div
                                                    class="btn-reward btn-kontainer-kelurahan btn-danger
                                                    position-relative">
                                                    <span class="position-relative add-reward">
                                                        Diajukan
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- {{ ($kontainer) }} --}}
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="body overflowy-kontainer-kelurahan">
                                            <x-forms.table>
                                                @slot('headSlot')
                                                    <th>WAKTU PERMINTAAN PERGANTIAN</th>
                                                    <th>STATUS</th>
                                                @endslot

                                                @slot('bodySlot')
                                                    @if (!empty($permintaan))
                                                        @foreach ($permintaan as $item)
                                                            <tr class="reward-tr permintaan-tr">
                                                                <td class="ps-4 tanggal">
                                                                    {{ datetimeFormat($item->created_at) }}
                                                                </td>
                                                                <td class="ps-4 ">
                                                                    @if (strtolower($item->status_permintaan) === 'diterima')
                                                                        <div
                                                                            class="btn-reward btn-table-custom bg-success
                                                          position-relative">
                                                                        @elseif(strtolower($item->status_permintaan) === 'ditolak')
                                                                            <div
                                                                                class="btn-reward btn-table-custom bg-danger
                                                                position-relative">
                                                                            @else
                                                                                <div
                                                                                    class="btn-reward btn-table-custom bg-success
                                                                position-relative">
                                                                    @endif
                                                                    <span class="position-relative add-reward text-capitalize">
                                                                        {{ $item->status_permintaan }}
                                                                    </span>
                                            </div>
                                            </td>
                                            </tr>
                                            @endforeach
                                        @else
                                            <tr class="reward-tr permintaan-tr">
                                                <td class="ps-4 tanggal">
                                                    18:42, 1 Agustus 2023
                                                </td>
                                                <td class="ps-4 ">
                                                    @if (strtolower($item->status_permintaan) === 'diterima')
                                                        <div
                                                            class="btn-reward btn-table-custom bg-success
                                                                position-relative">
                                                            <span class="position-relative add-reward">
                                                                Berhasil
                                                            </span>
                                                        </div>
                                                    @else
                                                    @endif
                                                </td>
                                            </tr>
                                            @endif
                                        @endslot
                                        </x-forms.table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- alert --}}

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
                                        @foreach ($notifikasi as $key => $item)
                                            <div class="col-md-12">
                                                <x-notifikasi.kontainer action="disable" type="danger"
                                                    notifikasi="Kontainer Utama hampir penuh"
                                                    type_detail="Ajukan kontainer yang baru supaya dapat terus menerima sumbangan" />
                                            </div>
                                            @if ($key === 0)
                                            @break
                                        @endif
                                    @endforeach
                                @else
                                    <div class="col-md-12">
                                        <x-notifikasi.kontainer action="disable" type="success"
                                            notifikasi="Kontainer Utama dapat diisi"
                                            type_detail="Belum membutuhkan pergantian kontainer" />
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
</div>

@stop
