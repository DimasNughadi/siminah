@extends('components._partials.default')

@section('content')
    {{-- {{ dd($reward[0]->nama_reward) }} --}}
    <div class="container-fluid py-2 ps-4">
        <div class="row">
            <div class="col-md-10">
                <div class="row">
                    <div class="col-md-12 reward text-poppins">Reward</div>
                </div>
                <div class="row reedem-reward animate__animated animate__fadeInLeft">
                    <div class="col-md-9 col-sm-7 col-7">
                        <div class="table-header-redeem">
                            Riwayat penukaran hadiah
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-5 col-5">
                        <div class="text-poppins text-14 btn-reward-position d-flex justify-content-end align-items-end">
                            <div class="btn-reward btn-custom-success position-relative">
                                <a href="{{ route('reward/reward-list') }}" class="position-relative add-reward">Lihat
                                    Daftar
                                    hadiah</a>
                            </div>
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
                                @if (!empty($redeem))
                                {{-- {{ dd($redeem[0]) }} --}}
                                    @foreach ($redeem as $item)
                                        <tr class="reward-tr table-row-image">
                                            <td class="ps-4">
                                                <div class="d-flex align-items-center">
                                                    <x-user.userImage src="{{ 'donatur/' . $item->donatur->photo }}"/>
                                                    {{-- <x-user.userImage src="{{ $item->donatur->photo }}"/> --}}
                                                    <div class="ms-2 poppins">
                                                        {{ Str::substr($item->donatur->nama_donatur, 0, 5) }}
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="ps-4 poppins">
                                                {{ $item->reward->jumlah_poin }}
                                            </td>
                                            <td class="ps-4">
                                                <div class="d-flex flex-column gap-0">
                                                    <span class="poppins">
                                                        {{ $item->reward->nama_reward }}
                                                    </span>
                                                </div>
                                            </td>
                                            <td class="ps-4">
                                                {{ datetimeFormat($item->tanggal_redeem) }}
                                            </td>
                                            <td class="ps-4">
                                                {{ $item->redeem_count }} Kali
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

@stop
