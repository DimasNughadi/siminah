@extends('components._partials.default')

@section('content')
    <div class="container-fluid py-2 ps-4">
        <div class="row">
            <div class="col-xxl-10 col-xl-10 col-lg-10 col-md-11 col-sm-12 col-12">
                <div class="row animate__animated animate__fadeInLeft">
                    <div class="col-md-12 page-header">
                        <a href="{{ route('redeem') }}" class="link-dark">
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
                    <div class="col-xxl-10 col-xl-10 col-xl-10 col-md-10 col-sm-10 col-10">
                        <div class="table-header-redeem">
                            Daftar hadiah
                        </div>
                    </div>
                    <div class="col-md-12">
                        <x-forms.table id="table-detail-donatur">
                            @slot('headSlot')
                                <th>NAMA HADIAH</th>
                                <th>STOK HADIAH</th>
                                <th>POIN</th>
                                <th>MASA BERLAKU</th>
                                <th>GAMBAR</th>
                            @endslot

                            @slot('bodySlot')
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
                                                <span>{{ $item->masa_berlaku }}</span>
                                            </td>

                                            <td class="ps-4 text-inter-regular text-14">
                                                <div class="cursor-pointer">
                                                    <img src="{{ asset('storage/reward/' . $item->gambar) }}" alt=""
                                                        width="34" alt="gambar {{ $item->nama_reward }}"
                                                        data-bs-toggle="modal" data-bs-target="#detail-image"
                                                        onclick="detailGambarReward('{{ asset('storage/reward/' . $item->gambar) }}')">
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

    <x-modals.detailGambarModal modalName="detail-image" title="Detail gambar reward">
        @slot('slotBody')
            <div class="modal-detail-gambar">
                <img src="#" alt="gambar" id="modal-image-sumbangan">
            </div>
        @endslot
        </x-modals.Modal>
    @stop