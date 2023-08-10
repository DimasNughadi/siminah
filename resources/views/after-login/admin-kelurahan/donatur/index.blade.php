@extends('components._partials.default')

@section('content')

    <div class="container-fluid py-2 ps-4">
        <div class="row">
            <div class="col-lg-11">
                <div class="row">
                    <div class="col-xl-12 reward">Data Donatur</div>
                </div>
                <div class="xrow reedem-reward">
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="table-header-redeem">
                                    <button class="btn border text-inter-regular text-14">
                                        <i class="fa-solid fa-arrow-up-from-bracket"></i>&nbsp;&nbsp;EXPORT</button>
                                </div>
                            </div>
                            {{-- <div class="col-lg 3">
                                <div class="table-header-redeem">
                                    <input type="text" placeholder="Search User">
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <button class="btn btn-primary">ADD USER</button>
                            </div>
                            <div class="col-lg-1">
                                <i class="fa-solid fa-ellipsis-vertical" type="button" data-bs-toggle="dropdown"></i>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="#">Action</a></li>
                                    <li><a class="dropdown-item" href="#">Another action</a></li>
                                    <li><a class="dropdown-item" href="#">Something else here</a></li>
                                </ul>
                            </div> --}}
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <table class="table align-middle mb-0 reward-table ps-5">
                            <thead>
                                <tr>
                                    <td class="form-check">
                                        <input class="form-check-input" type="checkbox">
                                    </td>
                                    <th>USER</th>
                                    <th>JUMLAH DONASI</th>
                                    <th>KELURAHAN</th>
                                    <th>WAKTU DONASI TERBARU</th>
                                    <th>TOTAL DONASI</th>
                                    <th>ACTION</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($donatur as $dn)
                                <tr class="reward-row">
                                    <td class="form-check">
                                        <input class="form-check-input" type="checkbox" name="">
                                    </td>
                                    <td class="ps-4">
                                        <div class="d-flex align-items-center">
                                            <x-userImage />
                                            <div class="ms-3">
                                                <p class="fw-bold mb-1 text-roboto-medium text-14">{{$dn->nama_donatur}}</p>
                                                <!-- <p class="text-muted mb-0 text-roboto-regular text-12">john.doe@gmail.com -->
                                                </p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="ps-4">
                                        <span class="text-inter-regular text-14">{{$dn->sumbangan_sum_berat}}</span>
                                    </td>
                                    <td class="ps-4">
                                        <span class="text-inter-regular text-14">{{$dn->kelurahan}}</span>
                                    </td>
                                    <td class="ps-4">
                                        <span class="text-inter-regular text-14">{{$dn->newest_tanggal}}</span>
                                    </td>
                                    <td class="ps-4">
                                        <span class="text-inter-regular text-14">{{$dn->total_donasi}}</span>
                                    </td>
                                    <td class="ps-4">
                                        <i class="fa-solid fa-ellipsis-vertical" type="button"
                                            data-bs-toggle="dropdown"></i>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="#">Action</a></li>
                                            <li><a class="dropdown-item" href="#">Another action</a></li>
                                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                                        </ul>
                                    </td>
                                </tr>
                                @empty     
                                @endforelse
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
