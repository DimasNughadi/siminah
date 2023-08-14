@extends('components._partials.default')

@section('content')

<style>
    .chart-container {
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .chart-content {
        position: relative;
        display: block;
        width: 250px;
        height: 250px;
    }

    .chart-content canvas {
        display: block;
        max-width: 100%;
        max-height: 100%;
        border-radius: 50%;
        z-index: 2;
    }

    .chart-background {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(101, 174, 56, 0.25);
        border-radius: 50%;
        z-index: 1;
        pointer-events: none;
    }

    .chart-background2 {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(20, 94, 168, 0.25);
        border-radius: 50%;
        z-index: 1;
        pointer-events: none;
    }

    .chart-percentage {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        font-size: 32px;
        font-weight: bold;
        color: #65AE38;
    }

    .chart-percentage2 {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        font-size: 32px;
        font-weight: bold;
        color: #145EA8;
    }

    .custom-icon {
        color: #65AE38;
    }

    .custom-icon2 {
        color: #145EA8;
    }


    .custom-popup {
        background-color: #fff;
        font-family: 'Roboto', sans-serif;
        border-radius: 10px;
    }

    .custom-popup .custom-popup-title {
        margin: 0;
        font-size: 18px;
        font-weight: 500;
    }

    .custom-popup .custom-popup-lat,
    .custom-popup .custom-popup-lng {
        margin: 5px 0;
        font-size: 14px;
    }
</style>

<div class="container-fluid py-4">
    <div class="row">
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-header p-3 pt-2">
                    <div
                        class="icon icon-lg icon-shape bg-gradient-dark shadow-dark text-center border-radius-xl mt-n4 position-absolute">
                        <i class="material-icons opacity-10">local_drink</i>
                    </div>
                    <div class="text-end pt-1">
                        <p class="text-sm mb-0 text-capitalize">Total donasi bulan {{$bulanTahun}}</p>
                        <h4 class="mb-0">{{ $totalSumbangan }} L</h4>
                    </div>
                </div>
                <hr class="dark horizontal my-0">
                <div class="card-footer p-3">
                    <p class="mb-0"><span class="{{ $perbandinganSumbangan < 0 ? 'text-danger' : 'text-success' }} text-sm font-weight-bolder">{{ $perbandinganSumbangan }}% </span> dari bulan lalu</p>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-header p-3 pt-2">
                    <div
                        class="icon icon-lg icon-shape bg-gradient-primary shadow-primary text-center border-radius-xl mt-n4 position-absolute">
                        <i class="material-icons opacity-10">people</i>
                    </div>
                    <div class="text-end pt-1">
                        <p class="text-sm mb-0 text-capitalize">Total Donatur</p>
                        <h4 class="mb-0">{{ $totalDonatur }}</h4>
                    </div>
                </div>
                <hr class="dark horizontal my-0">
                <div class="card-footer p-3">
                    <p class="mb-0"><span class="{{ $perbandinganDonatur < 0 ? 'text-danger' : 'text-success' }} text-sm font-weight-bolder">{{ $perbandinganDonatur }}% </span> dari bulan lalu</p>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-header p-3 pt-2">
                    <div
                        class="icon icon-lg icon-shape bg-gradient-success shadow-success text-center border-radius-xl mt-n4 position-absolute">
                        <i class="material-icons opacity-10">person</i>
                    </div>
                    <div class="text-end pt-1">
                        <p class="text-sm mb-0 text-capitalize">New Clients</p>
                        <h4 class="mb-0">3,462</h4>
                    </div>
                </div>
                <hr class="dark horizontal my-0">
                <div class="card-footer p-3">
                    <p class="mb-0"><span class="text-danger text-sm font-weight-bolder">-2%</span> than yesterday</p>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6">
            <div class="card">
                <div class="card-header p-3 pt-2">
                    <div
                        class="icon icon-lg icon-shape bg-gradient-info shadow-info text-center border-radius-xl mt-n4 position-absolute">
                        <i class="material-icons opacity-10">weekend</i>
                    </div>
                    <div class="text-end pt-1">
                        <p class="text-sm mb-0 text-capitalize">Sales</p>
                        <h4 class="mb-0">$103,430</h4>
                    </div>
                </div>
                <hr class="dark horizontal my-0">
                <div class="card-footer p-3">
                    <p class="mb-0"><span class="text-success text-sm font-weight-bolder">+5% </span>than yesterday</p>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-lg-6 col-md-6 mt-4 mb-4">
            <div class="card z-index-2">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2 bg-transparent">
                    <div class="bg-gradient-primary shadow-primary border-radius-lg py-3 pe-1">
                        <div class="text-start pt-1">
                            <h4 class="text-white text-capitalize text-xl ps-3">Donasi kelurahan</h4>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="chart mt-4" style="height: 250px;">
                        <!-- <canvas id="myChart"></canvas> -->
                        <canvas id="bar-chart" class="chart-canvas" height="300" width="767" style="display: block; box-sizing: border-box; height: 300px; width: 767px;"></canvas>
                    </div>
                    <hr class="dark horizontal">
                    <div class="d-flex ">
                        <i class="material-icons text-sm my-auto me-1">schedule</i>
                        <p class="mb-0 text-sm"> 5 donasi terbanyak bulan {{$bulanTahun}} </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-6 mt-4 mb-4">
            <div class="card z-index-2  ">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2 bg-transparent">
                    <div class="bg-gradient-success shadow-success border-radius-lg py-3 pe-1">
                        <div class="row">
                            <div class="col-lg-6 col-7">
                            <div class="text-start pt-1">
                                <h4 class="text-white text-capitalize text-xl ps-3">Kapasitas Kontainer</h4>
                            </div>
                                
                            </div>
                            <div class="col-lg-6 col-5 my-auto text-end">
                                <div class="dropdown float-lg-end pe-4">
                                    <a class="cursor-pointer" id="dropdownTable" data-bs-toggle="dropdown"
                                        aria-expanded="false">
                                        <i class="fa fa-ellipsis-v text-white"></i>
                                    </a>
                                    <ul class="dropdown-menu px-2 py-3 ms-sm-n4 ms-n5" aria-labelledby="dropdownTable">
                                        <li><a class="dropdown-item border-radius-md" href="javascript:;">Action</a></li>
                                        <li><a class="dropdown-item border-radius-md" href="javascript:;">Another action</a></li>
                                        <li><a class="dropdown-item border-radius-md" href="javascript:;">Something else here</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 mt-3 d-flex justify-content-center">
                            <div class="chart-container">
                                <div class="chart-content">
                                    <canvas id="myChart2"></canvas>
                                    <div class="chart-background"></div>
                                    <div class="chart-percentage">75%</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 mt-3 d-flex justify-content-center">
                            <div class="chart-container">
                                <div class="chart-content">
                                    <canvas id="myChart3"></canvas>
                                    <div class="chart-background2"></div>
                                    <div class="chart-percentage2">75%</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr class="dark horizontal">
                    <div class="d-flex">
                        <i class="material-icons text-sm my-auto me-1 custom-icon">lens</i>
                        <p class="mb-0 text-sm"> Kontainer Utama </p>
                        <i class="material-icons text-sm my-auto me-1 custom-icon"></i>
                        <i class="material-icons text-sm my-auto me-1 custom-icon"></i>
                        <i class="material-icons text-sm my-auto me-1 custom-icon"></i>
                        <i class="material-icons text-sm my-auto me-1 custom-icon2">lens</i>
                        <p class="mb-0 text-sm"> Kontainer Cadangan </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mb-4">
        <div class="col-lg-8 col-md-6 mb-md-0 mb-4">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="row">
                        <div class="col-lg-6 col-7">
                            <h6>Sebaran Lokasi Kontainer</h6>
                            <p class="text-sm mb-0">
                                <i class="fa fa-map-marker text-info" aria-hidden="true"></i>
                                <span class="font-weight-bold ms-1">{{ $totalKontainer }} Lokasi</span> pada {{$bulanTahun}}
                            </p>
                        </div>
                        <div class="col-lg-6 col-5 my-auto text-end">
                            <div class="dropdown float-lg-end pe-4">
                                <a class="cursor-pointer" id="dropdownTable" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    <i class="fa fa-ellipsis-v text-secondary"></i>
                                </a>
                                <ul class="dropdown-menu px-2 py-3 ms-sm-n4 ms-n5" aria-labelledby="dropdownTable">
                                    <li><a class="dropdown-item border-radius-md" href="javascript:;">Action</a></li>
                                    <li><a class="dropdown-item border-radius-md" href="javascript:;">Another action</a></li>
                                    <li><a class="dropdown-item border-radius-md" href="javascript:;">Something else here</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div id="map" style="height: 400px;"></div>
                    <hr class="dark horizontal">
                    <div class="d-flex ">
                        <i class="material-icons text-sm my-auto me-1">schedule</i>
                        <p class="mb-0 text-sm"> updated 4 min ago </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6">
            <div class="card h-100">
                <div class="card-header pb-0">
                    <h6>Orders overview</h6>
                    <p class="text-sm">
                        <i class="fa fa-arrow-up text-success" aria-hidden="true"></i>
                        <span class="font-weight-bold">24%</span> this month
                    </p>
                </div>
                <div class="card-body p-3">
                    <div class="timeline timeline-one-side">
                        <div class="timeline-block mb-3">
                            <span class="timeline-step">
                                <i class="material-icons text-success text-gradient">notifications</i>
                            </span>
                            <div class="timeline-content">
                                <h6 class="text-dark text-sm font-weight-bold mb-0">$2400, Design changes</h6>
                                <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">22 DEC 7:20 PM</p>
                            </div>
                        </div>
                        <div class="timeline-block mb-3">
                            <span class="timeline-step">
                                <i class="material-icons text-danger text-gradient">code</i>
                            </span>
                            <div class="timeline-content">
                                <h6 class="text-dark text-sm font-weight-bold mb-0">New order #1832412</h6>
                                <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">21 DEC 11 PM</p>
                            </div>
                        </div>
                        <div class="timeline-block mb-3">
                            <span class="timeline-step">
                                <i class="material-icons text-info text-gradient">shopping_cart</i>
                            </span>
                            <div class="timeline-content">
                                <h6 class="text-dark text-sm font-weight-bold mb-0">Server payments for April</h6>
                                <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">21 DEC 9:34 PM</p>
                            </div>
                        </div>
                        <div class="timeline-block mb-3">
                            <span class="timeline-step">
                                <i class="material-icons text-warning text-gradient">credit_card</i>
                            </span>
                            <div class="timeline-content">
                                <h6 class="text-dark text-sm font-weight-bold mb-0">New card added for order #4395133
                                </h6>
                                <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">20 DEC 2:20 AM</p>
                            </div>
                        </div>
                        <div class="timeline-block mb-3">
                            <span class="timeline-step">
                                <i class="material-icons text-primary text-gradient">key</i>
                            </span>
                            <div class="timeline-content">
                                <h6 class="text-dark text-sm font-weight-bold mb-0">Unlock packages for development</h6>
                                <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">18 DEC 4:54 AM</p>
                            </div>
                        </div>
                        <div class="timeline-block">
                            <span class="timeline-step">
                                <i class="material-icons text-dark text-gradient">payments</i>
                            </span>
                            <div class="timeline-content">
                                <h6 class="text-dark text-sm font-weight-bold mb-0">New order #9583120</h6>
                                <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">17 DEC</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js@4.3.0/dist/chart.umd.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/leaflet@1.7.1/dist/leaflet.css" />
<link href='https://api.mapbox.com/mapbox.js/plugins/leaflet-fullscreen/v1.0.1/leaflet.fullscreen.css' rel='stylesheet' />
<script src="https://cdn.jsdelivr.net/npm/leaflet@1.7.1/dist/leaflet.js" async></script>
<script src='https://api.mapbox.com/mapbox.js/plugins/leaflet-fullscreen/v1.0.1/Leaflet.fullscreen.min.js' async></script>
<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous" async></script>

<script>
    var ctx = document.getElementById('myChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: {!! json_encode($chartData['labels']) !!},
            datasets: [{
                label: 'Total Sumbangan',
                data: {!! json_encode($chartData['values']) !!},
                backgroundColor: 'rgba(209, 32, 49, 0.8)',
                borderColor: 'rgba(209, 32, 49, 1)',
                borderRadius: 10,
                borderWidth: 1
            }]
        },
        options: {
            maintainAspectRatio: false,
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true
                }
            },
            plugins: {
                legend: false
            }
        }
    });
</script>

<script>
    var ctx1 = document.getElementById('myChart2').getContext('2d');
    var data1 = [75, 25];
    var colors1 = ['rgba(101, 174, 56, 1)', 'rgba(0, 0, 0, 0)'];
    var cutout1 = '85%';
    var myChart1 = new Chart(ctx1, {
        type: 'doughnut',
        data: {
            labels: ['Terisi', 'kosong'],
            datasets: [{
                label: 'Total',
                data: data1,
                backgroundColor: colors1,
                cutout: cutout1,
                borderRadius: 50,
                borderWidth: 0,
                hoverOffset: 0
            }]
        },
        options: {
            maintainAspectRatio: false,
            responsive: true,
            layout: {
                padding: 0
            },
            plugins: {
                legend: false
            }
        }
    });

    var ctx2 = document.getElementById('myChart3').getContext('2d');
    var data2 = [75, 25];
    var colors2 = ['rgba(20, 94, 168, 1)', 'rgba(0, 0, 0, 0)'];
    var cutout2 = '85%';
    var myChart2 = new Chart(ctx2, {
        type: 'doughnut',
        data: {
            labels: ['Terisi', 'kosong'],
            datasets: [{
                label: 'Total',
                data: data2,
                backgroundColor: colors2,
                cutout: cutout2,
                borderRadius: 50,
                borderWidth: 0,
                hoverOffset: 0
            }]
        },
        options: {
            maintainAspectRatio: false,
            responsive: true,
            layout: {
                padding: 0
            },
            plugins: {
                legend: false
            }
        }
    });
</script>

<script>
    var map = L.map('map').setView([1.6692, 101.4478], 11);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors',
        maxZoom: 16,
    }).addTo(map);

    map.addControl(new L.Control.Fullscreen());

    var mapData = {!! $mapData !!};

    for (var i = 0; i < mapData.length; i++) {
        var marker = mapData[i];

        var popupContent = '<div class="custom-popup">' +
            '<h3 class="custom-popup-title">' + marker.nama + '</h3>' + '<hr class="dark horizontal">' +
            '<p class="custom-popup-lat">Total Donatur: ' + marker.total_donatur + ' Orang</p>' +
            '<p class="custom-popup-lng">Total Berat: ' + marker.total_berat + ' L</p>' +
            '</div>';

        L.marker([marker.lat, marker.lng])
            .addTo(map)
            .bindPopup(popupContent, { className: 'custom-popup' });
    }
</script>

@stop