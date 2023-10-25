<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('assets/img/apple-icon.png') }}">
    <link rel="icon" type="image/png" href="{{ asset('favicon.ico') }}">
    <title>{{ config('app.name') }} | Developer </title>
    <!--     Fonts and icons     -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" type="text/css"
        href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
    <!-- Nucleo Icons -->
    <link href="{{ asset('assets/css/nucleo-icons.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/nucleo-svg.css') }}" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    {{-- <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script> --}}
    <script src="https://kit.fontawesome.com/48621cfea3.js" crossorigin="anonymous"></script>
    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet" async defer>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet" async defer>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:opsz,wght@9..40,500&display=swap" rel="stylesheet"
        async defer>
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200"
        async defer />
    <!-- CSS Files -->
    <link id="pagestyle" href="{{ asset('assets/css/material-dashboard.css?v=3.1.0') }}" rel="stylesheet" />
    <link id="pagestyle" href="{{ asset('assets/css/style.css') }}" rel="stylesheet" />
    <link id="pagestyle" href="{{ asset('assets/css/animated.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/leaflet@1.7.1/dist/leaflet.css" />
    <link
        href='https://api.mapbox.com/mapbox.js/plugins/leaflet-fullscreen/v1.0.1/leaflet.fullscreen.css'rel='stylesheet' />
    <!-- Nepcha Analytics (nepcha.com) -->
    <!-- Nepcha is a easy-to-use web analytics. No cookies and fully compliant with GDPR, CCPA and PECR. -->
    {{-- <script defer data-site="YOUR_DOMAIN_HERE" src="https://api.nepcha.com/js/nepcha-analytics.js"></script> --}}

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
</head>

<body data-mdb-animation-start="onLoad">

    <main class="main-content developer">
        <section class="logo">
            <div class="siminah">
                <a href="/">
                    <img src="{{ asset('assets/img/default/siminah.png') }}">
                </a>
            </div>
            <span></span>
            <div class="pcr">
                <a href="https://pcr.ac.id/">
                    <img src="{{ asset('assets/img/default/logo_pcr.png') }}">
                </a>
            </div>
            <span></span>
            <div class="psti">
                <a href="https://psti.pcr.ac.id/">
                    <img src="{{ asset('assets/img/default/logo_psti.png') }}">
                </a>
            </div>
        </section>

        <section class="body container">
            <div class="sidebar">
                <div class="row">
                    <div class="col-xxl-5 col-xl-5 col-lg-5 col-md-12 col-sm-12 col-12">
                        <div class="list-group">
                            <h1>Siminah Team</h1>
                            <a href="#" class="nav-list" data-department="lecture">Lectures</a>
                            <a href="#" class="nav-list" data-department="mobile">Mobile Developer</a>
                            <a href="#" class="nav-list last" data-department="web">Website Developer</a>
                        </div>
                    </div>
                    <div class="col-xxl-7 col-xl-7 col-lg-7 col-md-12 col-sm-12 col-12">
                        <div class="row user-list">
                            @foreach ($developer as $item)
                                <div class="col-md-4 person-col" data-department="{{ $item['roles'] }}">
                                    <div class="person">
                                        <x-user.userImage width="130" height="130" alt="Gambar {{ $item['nama'] }}" src="{{ $item['gambar'] }}" role="developer"/>
                                        <h2>{{ $item['nama'] }}</h2>
                                        <h5 class="text-center">{{ $item['role'] }}</h5>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    @include('components._partials.scripts')
    <script>
        $(document).ready(function() {
            // $('.user-list .person-col').show();
            $('.user-list .person-col[data-department="lecturer"]').show();

            $('.list-group .nav-list').click(function() {
                $('.list-group .nav-list').removeClass('active');
                $(this).addClass('active');
                var department = $(this).data('department');

                $('.user-list .person-col').hide();
                $('.user-list .person-col[data-department="' + department + '"]').show();
            });
        });
    </script>
</body>

</html>
