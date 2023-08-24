@extends('components._partials.default')

@section('content')
    <div class="container-fluid py-2 ps-4">
        <div class="row">
            <div class="col-md-10">
                <div class="row animate__animated animate__fadeInLeft">
                    <div class="col-md-12 page-header">
                        <a href="{{ route('reward') }}" class="link-dark">
                            <span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="25" viewBox="0 0 24 25"
                                    fill="none">
                                    <path
                                        d="M14.3914 7.57892L9.0173 12.9999L14.3914 18.4211C15.2029 19.2398 15.2029 20.5673 14.3914 21.3859C13.5797 22.2047 12.2639 22.2047 11.4522 21.3859L4.6087 14.4824C4.21895 14.0893 4 13.5559 4 12.9999C4 12.444 4.21895 11.9108 4.6087 11.5175L11.4522 4.61405C12.2639 3.79532 13.5797 3.79532 14.3914 4.61405C15.2029 5.43277 15.2029 6.7602 14.3914 7.57892Z"
                                        fill="black" />
                                </svg>
                            </span>
                            Hadiah
                        </a>
                    </div>
                </div>
                <div class="row reedem-reward animate__animated animate__fadeInLeft">
                    <div class="col-md-10 col-sm-10 col-10">
                        <div class="table-header-redeem">
                            Daftar hadiah
                        </div>
                    </div>
                    <div
                        class="col-md-2 col-sm-2 col-2 text-poppins text-14 btn-reward-position d-flex justify-content-end align-items-end">
                        <div class="btn-reward bg-success btn-success position-relative">
                            <a href="{{ route('reward/reward-list') }}" class="position-relative add-reward"
                                data-bs-toggle="modal" data-bs-target="#add-reward">Tambah
                            </a>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <x-forms.table>
                            @slot('headSlot')
                                <th>NAMA HADIAH</th>
                                <th>STOK HADIAH</th>
                                <th>POIN</th>
                                <th>GAMBAR</th>
                                <th>AKSI</th>
                            @endslot

                            @slot('bodySlot')
                                {{-- {{ dd($reward) }} --}}
                                @if (!empty($reward))
                                    @foreach ($reward as $item)
                                        <tr class="reward-row table-row-image">
                                            <td class="ps-4 text-14">
                                                <span class="text-poppins">
                                                    {{ $item->nama_reward }}
                                                </span>
                                            </td>
                                            <td class="ps-4 text-inter-regular text-14">
                                                <span>{{ $item->stok }}</span>
                                            </td>
                                            <td class="ps-4 text-inter-regular text-14">
                                                <span>{{ $item->jumlah_poin }}</span>
                                            </td>

                                            <td class="ps-4 text-inter-regular text-14">
                                                <div class="cursor-pointer">
                                                    <img src="{{ asset('storage/reward/' . $item->gambar) }}" alt=""
                                                        width="34" alt="gambar {{ $item->nama_reward }}"
                                                        data-bs-toggle="modal" data-bs-target="#detail-image"
                                                        onclick="detailGambarReward('{{ asset('storage/reward/' . $item->gambar) }}')">
                                                </div>
                                            </td>
                                            <td class="ps-4 text-inter-regular text-14">
                                                <div class="btn-reward btn-list position-relative">
                                                    <a href="#" class="position-relative add-reward" id="edit-reward-id"
                                                        data-bs-toggle="modal" data-bs-target="#edit-reward"
                                                        onclick="
                                                        editDataReward(
                                                            '{{ $item->nama_reward }}', 
                                                            '{{ $item->stok }}', 
                                                            '{{ $item->jumlah_poin }}',
                                                            '{{ route('reward.update', ['id' => $item->id_reward]) }}')
                                                    ">EDIT
                                                    </a>
                                                </div>
                                                &nbsp;&nbsp;&nbsp;
                                                <div class="btn-reward btn-list btn-custom-danger position-relative">
                                                    <a href="#" class="position-relative add-reward"
                                                        onclick="deleteReward('{{ route('reward.delete', ['id' => $item->id_reward]) }}')">DELETE</a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    @if (!empty($message))
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td>{{ $message }}</td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                    @endif
                                @endif
                            @endslot
                        </x-forms.table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <x-forms.deleted />

    {{-- Detail gambar --}}
    <x-modals.detailGambarModal modalName="detail-image" title="Detail gambar reward">
        @slot('slotBody')
            <div class="modal-detail-gambar">
                <img src="#" alt="gambar" id="modal-image-sumbangan">
            </div>
        @endslot
        </x-modals.Modal>

        {{-- Insert modal --}}
        <x-modals.Modal modalName="add-reward" title="Tambah reward">
                @slot('slotMethod')
                    <form enctype="multipart/form-data" method="POST" action="{{ route('reward.store') }}">
                    @csrf
                @endslot

                @slot('slotBody')
                    <x-forms.input placeholder="Nama hadiah" name="nama_reward" />
                    <x-forms.input placeholder="Stok hadiah" name="stok" />
                    <x-forms.input placeholder="Poin yang dibutuhkan" name="jumlah_poin" />
                    <x-forms.fileInputModal name="gambar" />
                @endslot

                @slot('slotFooter')
                    <x-forms.btn.button color="danger" type="submit" title="Simpan" />
                @endslot
        </x-modals.Modal>

        {{-- Edit modal --}}
        <x-modals.Modal modalName="edit-reward" title="Ubah reward">
            @slot('slotMethod')
                <form enctype="multipart/form-data" method="POST" action="" id="modal-forms-edit">
                    @csrf   
                    @method('PUT')
                @endslot

                @slot('slotBody')
                    <x-forms.input placeholder="Nama hadiah" name="nama_reward" id="editNama" />
                    <x-forms.input placeholder="Stok hadiah" name="stok" id="editStok" />
                    <x-forms.input placeholder="Poin yang dibutuhkan" name="jumlah_poin" id="editPoin" />
                    <x-forms.fileEditModal name="gambar" />
                @endslot

                @slot('slotFooter')
                    <x-forms.btn.button type="submit" color="danger" title="Ubah" />
                @endslot
        </x-modals.Modal>
    @stop
