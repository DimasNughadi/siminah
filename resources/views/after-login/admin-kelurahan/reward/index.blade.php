@extends('components._partials.default')

@section('content')

    <div class="container-fluid py-2 ps-4">
        <div class="row">
            <div class="col-lg-10">
                <div class="row">
                    <div class="col-lg-12 reward text-poppins">Reward</div>
                </div>
                <div class="row reedem-reward">
                    <div class="col-lg-9">
                        <div class="table-header-redeem">
                            Riwayat penukaran hadiah
                        </div>
                    </div>
                    <div class="col-lg-3 text-poppins text-14 btn-reward-position ">
                        <div class="btn-reward btn-custom-success position-relative">
                            <a href="{{ route('reward/reward-list') }}" class="position-relative riwayat-history">Lihat Daftar hadiah</a>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <table class="table align-middle mb-0 reward-table ps-5">
                            <thead>
                                <tr>
                                    <th>NAMA USER</th>
                                    <th>JUMLAH POIN</th>
                                    <th>NAMA HADIAH</th>
                                    <th>WAKTU PENUKARAN</th>
                                    <th>TOTAL PENUKARAN</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="reward-row table-row-image">
                                    <td class="ps-4 text-inter-regular text-14">
                                        <div class="d-flex align-items-center">
                                            <x-userImage />
                                            <div class="ms-3">
                                                <span>Abdi</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="ps-4 text-inter-regular text-14">
                                        <span>500</span>
                                    </td>
                                    <td class="ps-4 text-14">
                                        <span class="text-poppins">Voucher Pulsa</span>
                                        <p class="text-inter-regular text-12">Rp. 50,000.00</p>
                                    </td>
                                    <td class="ps-4 text-inter-regular text-14">
                                        <span>14:30, 12 Jan 2023</span>
                                    </td>
                                    <td class="ps-4 text-inter-regular text-14">
                                        <span>5 Kali</span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop
