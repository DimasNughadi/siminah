@extends('components._partials.default')

@section('content')

    <div class="container-fluid py-2 ps-4">
        <div class="row">
            <div class="col-lg-10">
                <div class="row">
                    <div class="col-lg-12 reward text-poppins">Reward</div>
                </div>
                <div class="row reedem-reward">
                    <div class="col-lg-11">
                        <div class="table-header-redeem">
                            Daftar hadiah
                        </div>
                    </div>
                    <div class="col-lg-1 text-poppins text-14 btn-reward-position ">
                        <div class="btn-reward btn-list btn-success position-relative">
                            <a href="{{ route('reward/reward-list') }}" class="position-relative add-reward">ADD</a>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <table class="table align-middle mb-0 reward-table ps-5">
                            <thead>
                                <tr>
                                    <th>NAMA HADIAH</th>
                                    <th>STOK HADIAH</th>
                                    <th>POIN</th>
                                    <th>Gambar</th>
                                    <th>AKSI</th>
                                </tr>
                            </thead>
                            <tbody>
                            @forelse ($reward as $kn)
                                <tr class="reward-row table-row-image">
                                    <td class="ps-4 text-14">
                                        <span class="text-poppins">{{$kn->nama_reward}}</span>
                                        <!-- <p class="text-inter-regular text-12">Rp. 50,000.00</p> -->
                                    </td>
                                    <td class="ps-4 text-inter-regular text-14">
                                        <span>{{$kn->stok}}</span>
                                    </td>
                                    <td class="ps-4 text-inter-regular text-14">
                                        <span>{{$kn->jumlah_poin}}</span>
                                    </td>
                                    
                                    <td class="ps-4 text-inter-regular text-14">
                                        <img src="{{ asset('assets/img/reward/telkomsel.png') }}" alt="" width="34">
                                    </td>
                                    <td class="ps-4 text-inter-regular text-14">
                                        <div class="btn-reward btn-list btn-success position-relative">
                                            <a href="#" class="position-relative add-reward">EDIT</a>
                                        </div> 
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
                                        <div class="btn-reward btn-list btn-custom-danger position-relative">
                                            <a href="#" class="position-relative add-reward">DELETE</a>
                                        </div>  
                                    </td>
                                </tr>
                                @empty
                                @endforelse
                                <tr class="reward-row table-row-image">
                                    <td class="ps-4 text-14">
                                        <span class="text-poppins">Voucher Pulsa</span>
                                        <p class="text-inter-regular text-12">Rp. 50,000.00</p>
                                    </td>
                                    <td class="ps-4 text-inter-regular text-14">
                                        <span>25</span>
                                    </td>
                                    <td class="ps-4 text-inter-regular text-14">
                                        <span>500</span>
                                    </td>
                                    
                                    <td class="ps-4 text-inter-regular text-14">
                                        <img src="{{ asset('assets/img/reward/telkomsel.png') }}" alt="" width="34">
                                    </td>
                                    <td class="ps-4 text-inter-regular text-14">
                                        <div class="btn-reward btn-list btn-success position-relative">
                                            <a href="#" class="position-relative add-reward">EDIT</a>
                                        </div> 
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
                                        <div class="btn-reward btn-list btn-custom-danger position-relative">
                                            <a href="#" class="position-relative add-reward">DELETE</a>
                                        </div>  
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




