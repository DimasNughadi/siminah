@extends('components._partials.default')

@section('content')

    <div class="container-fluid py-2 ps-4">
        <div class="row">
            <div class="col-lg-10">
                <div class="row">
                    <div class="col-md-6 reward text-poppins">
                        Tambah Admin
                    </div>
                </div>
                <div class="row forms-admin">
                    <div class="col-md-6">
                        <x-forms.input name="s" placeholder=""/>
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop
