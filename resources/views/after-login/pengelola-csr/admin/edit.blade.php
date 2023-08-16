@extends('components._partials.default')

@section('content')
{{-- {{ $user }} --}}
    <div class="container-fluid py-2 ps-4">
        <div class="row">
            <div class="col-md-12 page-header text-poppins">
                <a href="{{ route('admin') }}" class="text-secondary link-secondary">Admin Kelurahan</a>
                <span>
                    <b>
                        &nbsp;/ Edit
                    </b>
                </span>
            </div>
        </div>
        <div class="row">
            <div class="container-fluid manajemen-admin">
                <form action="">
                    <div class="col-md-12">
                        <div class="row header d-flex justify-content middle">
                            <div class="col-md-9 col-sm-9 col-9 title">
                                <h3 class="align-middle">Edit admin kelurahan</h3>
                            </div>
                            <div class="col-md-3 col-sm-3 col-3 button d-flex justify-content-end">
                                <x-forms.btn.button color="danger" title="Simpan"/>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 line">
                        <div class="container-fluid body">
                            <div class="row">
                                <div class="col-md-4 section-1">
                                    <x-forms.formControlAdmin label="Nama" name="nama" placeholder="Nama lengkap"/>
                                </div>
                                <div class="col-md-4 section-2">
                                    <x-forms.formControlAdmin label="Email" name="email" placeholder="Email"/>
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="col-md-4 section-1">
                                    <x-forms.formControlAdmin label="No Telepon" name="no_hp" placeholder="Nomor telepon" />
                                </div>
                                <div class="col-md-4 section-2">
                                    <x-forms.formControlAdmin label="Alamat" name="alamat" placeholder="Alamat tempat tinggal Admin Kelurahan" />
                                </div>
                                {{-- <div class="col-md-4 section-2">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <x-forms.formControlAdmin label="No Telepon" name="no_hp" placeholder="Nomor telepon"/>
                                        </div>
                                    </div>
                                </div> --}}
                            </div>
                            <div class="row mt-4">
                                <div class="col-md-4">
                                    <x-forms.selectOption name="kelurahan" label="Kelurahan">
                                        @slot('slotOptions')
                                            <option value="1">One</option>
                                            <option value="2">Two</option>
                                            <option value="3">Three</option>
                                        @endslot
                                    </x-forms.selectOption>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@stop
