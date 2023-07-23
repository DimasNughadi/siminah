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
                                    <th>NO HP</th>
                                    <th>LOKASI DONASI</th>
                                    <th>JENIS SUMBANGAN</th>
                                    <th>TIME</th>
                                    <th>TOTAL SUMBANGAN</th>
                                    <th>ACTION</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="reward-row">
                                    <td class="form-check">
                                        <input class="form-check-input" type="checkbox" name="">
                                    </td>
                                    <td class="ps-4">
                                        <div class="d-flex align-items-center">
                                            <x-userImage />
                                            <div class="ms-3">
                                                <p class="fw-bold mb-1 text-roboto-medium text-14">John Doe</p>
                                                <p class="text-muted mb-0 text-roboto-regular text-12">john.doe@gmail.com
                                                </p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="ps-4">
                                        <span class="text-inter-regular text-14">087893504595</span>
                                    </td>
                                    <td class="ps-4">
                                        <span class="text-inter-regular text-14">Umban Sari</span>
                                    </td>
                                    <td class="ps-4">
                                        <span class="text-inter-regular text-14">Minyak Jelantah</span>
                                    </td>
                                    <td class="ps-4">
                                        <span class="text-inter-regular text-14">15 Jun - 15 Sep</span>
                                    </td>
                                    <td class="ps-4">
                                        <x-progressBar value="20" max="100" type="redeem" /><span>20</span>
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
                                <tr class="reward-row">
                                    <td class="ps-4"></td>
                                    <td class="ps-4"></td>
                                    <td class="ps-4">
                                        <span class="text-inter-regular text-14">087893504595</span>
                                    </td>
                                    <td class="ps-4">
                                        <span class="text-inter-regular text-14">Umban Sari</span>
                                    </td>
                                    <td class="ps-4">
                                        <span class="text-inter-regular text-14">Minyak Jelantah</span>
                                    </td>
                                    <td class="ps-4">
                                        <span class="text-inter-regular text-14">15 Jun - 15 Sep</span>
                                    </td>
                                    <td class="ps-4">
                                        <x-progressBar value="75" max="100" type="redeem" /><span>75</span>
                                    </td>
                                    <td class="ps-4"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
