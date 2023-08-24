@extends('components._partials.default')

@section('content')
    <div class="container-fluid py-2 ps-4">
        <div class="row">
            <div class="col-md-12 page-header text-poppins">
                <a href="{{ route('lokasi') }}" class="text-secondary link-secondary">Lokasi</a>
                <span>
                    <b>
                        &nbsp;/ Ubah lokasi
                    </b>
                </span>
            </div>
        </div>
        {{-- @dd($lokasi) --}}
        <div class="row">
            <div class="container-fluid lokasi">
                <form action="{{ route('lokasi.update', ['id' => $lokasi->id_lokasi]) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="col-md-12">
                        <div class="row header d-flex justify-content middle">
                            <div class="col-md-9 col-sm-9 col-9 title">
                                <h3 class="align-middle">Ubah lokasi pengumpulan minyak</h3>
                            </div>
                            <div class="col-md-3 col-sm-3 col-3 button d-flex justify-content-end">
                                {{-- <button type="submit">ss</button> --}}
                                <x-forms.btn.button type="submit" color="danger" title="Simpan"
                                    id="sumbit-tambah-lokasi" />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-11 line">
                        <div class="container-fluid body">
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <x-forms.formControlAdmin label="Alamat lengkap" name="deskripsi"
                                                placeholder="Detail alamat pengumpulan minyak" value="{{ $lokasi->deskripsi }}"/>
                                        </div>
                                    </div>

                                    <div class="row mt-4">
                                        <div class="col-md-12">
                                            <x-forms.formControlAdmin label="Kelurahan" name="nama_kelurahan"
                                                placeholder="Pilih kelurahan" value="{{ $lokasi->nama_kelurahan }}"/>
                                            <p class="text-danger" id="kelurahan-exist"></p>
                                        </div>
                                        {{-- <div class="col-md-12 section-2">
                                            <x-forms.formControlAdmin label="Kota" name="kota" placeholder="Pilih Kota" />
                                        </div> --}}
                                    </div>
                                    <div class="row mt-4">
                                        <div class="col-md-12">
                                            <x-forms.formControlAdmin label="Koordinat" name="koordinat"
                                                placeholder="Koordinat (Longitude  Latitude)" value="{{ $lokasi->latitude. ', ' .$lokasi->longitude }}"/>
                                        </div>
                                    </div>
                                    <div class="row d-none">
                                        <div class="col-md-12">
                                            <x-forms.formControlAdmin label="Latitude" name="latitude"
                                                placeholder="Pilih latitude" value="{{ $lokasi->latitude }}"/>
                                        </div>
                                    </div>
                                    <div class="row d-none">
                                        <div class="col-md-12">
                                            <x-forms.formControlAdmin label="Longitude" name="longitude"
                                                placeholder="Pilih longitude" value="{{ $lokasi->longitude }}"/>
                                        </div>
                                    </div>
                                    <div class="row d-none">
                                        <div class="col-md-12">
                                            <x-forms.formControlAdmin label="lokasi" name="id_lokasi"
                                                placeholder="Pilih longitude" value="{{ $lokasi->id_lokasi }}"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="container-maps">
                                            <div class="d-flex">
                                                <div class="left">Atur Pin Point</div>
                                                <div class="right">
                                                    &nbsp;&nbsp;(Opsional)
                                                </div>
                                            </div>
                                            <div class="col-md-12 mt-1">
                                                <div class="maps" id="maps">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <x-sweetalert />
@stop

@extends('components._partials.scripts')
@section('script')
    <script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM="
        crossorigin="anonymous"></script>
    <script src="{{ asset('assets/js/maps.js') }}"></script>
@endsection
