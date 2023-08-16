@extends('components._partials.default')

@section('content')
    <div class="container-fluid py-2 ps-4">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-12 reward text-poppins">Sumbangan</div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-3 col-sm-12 col-12">
                        <div class="container-fluid sumbangan-kelurahan">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="header">
                                        Total verifikasi
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
                                        <div class="row">
                                            <div class="col-md-6 col-6 col-sm-6">
                                                <canvas class="circle fill"></canvas>
                                                <span>Sudah</span>
                                            </div>
                                            <div class="col-md-6 col-6 col-sm-6">
                                                <canvas class="circle transparent"></canvas>
                                                <span>Belum</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12 col-12">
                        <div class="container-fluid sumbangan-kelurahan mt-sm-3 mt-3 mt-md-0">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="header">
                                        Total verifikasi
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
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5 col-sm-12 col-12">
                        <div class="table-sumbangan-kelurahan mt-sm-3 mt-3 mt-md-0">
                            <div class="main-table">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-8 col-sm-8 col-8">
                                                <div class="header">
                                                    Riwayat verifikasi
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="body overflowy-kontainer-kelurahan">
                                            <x-forms.table>
                                                @slot('headSlot')
                                                    <th>NAMA</th>
                                                    <th>WAKTU SUMBANGAN</th>
                                                    <th>STATUS</th>
                                                @endslot

                                                @slot('bodySlot')
                                                    {{-- {{ dd($riwayat) }} --}}
                                                    @if (!empty($riwayat))
                                                        @foreach ($riwayat as $item)
                                                            <tr class="verifikasi-tr">
                                                                <td class="ps-4 nama">
                                                                    <div class="d-flex align-items-center justify-center">
                                                                        <x-user.userImage src="{{ 'donatur/' . $item->donatur->photo }}" />
                                                                        <div class="ms-2">
                                                                            <span
                                                                                class="top">{{ getFirstName($item->donatur->nama_donatur) }}</span><br>
                                                                            <span class="bottom">{{ $item->berat }} Kg</span>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td class="ps-4 tanggal">
                                                                    {{ datetimeFormat($item->created_at) }}
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
                </div>
                <div class="row">
                    <div class="col-md-12 col-12 col-sm-12">
                        <div class="verifikasi-donasi mt-2 mt-md-4 mt-sm-2 ">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="header">
                                        Verifikasi donasi
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                {{-- {{ dd($verifikasiStatus) }} --}}
                                <div class="col-md-12">
                                    <div class="body mt-2">
                                        <x-forms.table>
                                            @slot('headSlot')
                                                <th>NAMA DONATUR</th>
                                                <th>JUMLAH DONASI</th>
                                                <th>KELURAHAN</th>
                                                <th>WAKTU DONASI</th>
                                                <th>FOTO DONASI</th>
                                                <th>AKSI</th>
                                            @endslot

                                            @slot('bodySlot')
                                                {{-- {{ dd($verifikasiStatus) }} --}}
                                                @if (!empty($verifikasiStatus))
                                                    @foreach ($verifikasiStatus as $item)
                                                        <tr class="verifikasi-row">
                                                            <td class="ps-4 nama">
                                                                <div class="d-flex align-items-center justify-center">
                                                                    <x-user.userImage src="{{ 'donatur/' . $item->donatur->photo }}" />
                                                                    <span
                                                                        class="ps-2">{{ getFirstName($item->donatur->nama_donatur) }}</span>
                                                                </div>
                                                            </td>
                                                            <td class="ps-4 berat">
                                                                {{ $item->berat }} Kg
                                                            </td>
                                                            <td class="ps-4 kelurahan">
                                                                {{ $item->donatur->nama_kelurahan }}
                                                            </td>
                                                            <td class="ps-4 tanggal">
                                                                {{ datetimeFormat($item->created_at) }}
                                                            </td>
                                                            <td class="ps-4">
                                                                <div class="foto-donasi cursor-pointer">
                                                                    <img src="{{ asset('storage/sumbangan/' . $item->photo) }}"
                                                                        alt="gambar sumbangan" data-bs-toggle="modal"
                                                                        data-bs-target="#detailImage" id="gambar-sumbangan"
                                                                        onclick="detailSumbangan()">
                                                                </div>
                                                            </td>
                                                            <td class="ps-4 ">
                                                                <div class="d-flex">
                                                                    <div
                                                                        class="btn-reward btn-table-custom bg-success
                                                                position-relative" onclick="verifikasiSumbangan(1)">
                                                                        <span
                                                                            class="position-relative add-reward cursor-pointer">
                                                                            Verifikasi
                                                                        </span>
                                                                    </div>
                                                                    <div class="btn-reward btn-table-custom bg-danger
                                                                position-relative ms-1"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#deskripsi-penolakan">
                                                                        <span
                                                                            class="position-relative add-reward cursor-pointer">
                                                                            Tolak
                                                                        </span>
                                                                    </div>

                                                                </div>
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
            </div>
        </div>
    </div>
    {{-- Modal --}}
    <x-modals.detailGambarModal modalName="detailImage" title="Detail gambar sumbangan">
        @slot('slotBody')
            <div class="modal-detail-gambar">
                <img src="#" alt="gambar" id="modal-image-sumbangan">
            </div>
        @endslot
        </x-modals.Modal>

        {{-- Modal tolak --}}
        <x-modals.Modal modalName="deskripsi-penolakan" route="sumbangan.update" title="Deskripsi penolakan">
            @slot('slotMethod')
                @csrf
                @method('PUT')
            @endslot

            @slot('slotBody')
                <div class="form-floating border rounded">
                    <textarea class="form-control ps-2" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 200px"
                        name="deskripsi"></textarea>
                    <label for="floatingTextarea2">Deskripsi</label>
                </div>
            @endslot

            @slot('slotFooter')
                <x-forms.btn.button type="submit" color="danger" title="Simpan" />
            @endslot
        </x-modals.Modal>


    @stop

    @extends('components._partials.scripts')
    @section('script')
        <script>
            function verifikasiSumbangan() {
                Swal.fire({
                    title: 'Lanjutkan verifikasi?',
                    text: "Anda tidak dapat membatalkan status kembali",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Logout'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // document.getElementById('logout-form').submit();
                    }
                })
            }
        </script>
    @endsection
