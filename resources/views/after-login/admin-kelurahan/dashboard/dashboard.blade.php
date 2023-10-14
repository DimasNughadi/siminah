@extends('components._partials.default')
@section('title', 'Dashboard')
@section('content')

<style>
.chart-background-green {
    width: 100%;
    height: 100%;
    background-color: rgba(101, 174, 56, 0.25);
    border-radius: 50%;
    position: relative;
}

.chart-background-yellow {
    width: 100%;
    height: 100%;
    background-color: rgba(255, 167, 38, 0.25);
    border-radius: 50%;
    position: relative;
}

.chart-background-red {
    width: 100%;
    height: 100%;
    background-color: rgba(209, 32, 49, 0.25);
    border-radius: 50%;
    position: relative;
}

.chart-content {
    width: 215px;
    height: 215px;
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

.custom-icon {
    color: #65AE38;
}

.custom-icon2 {
    color: #FFBD3D;
}

.custom-icon3 {
    color: #E31E18;
}


.custom-popup {
    background-color: #fff;
    font-family: 'poppins', sans-serif;
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
    <div class="row animate__animated animate__fadeInUp">
        <div class="col-xl-4 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-header p-3 pt-2">
                    <div
                        class="icon icon-lg icon-shape bg-gradient-info shadow-info text-center border-radius-xl mt-n4 position-absolute">
                        <i class="material-icons opacity-10">local_drink</i>
                    </div>
                    <div class="text-end pt-1">
                        <p class="text-sm mb-0 text-capitalize">Total donasi bulan {{$bulanTahun}}</p>
                        <h4 class="mb-0"><span id="state1" countTo="{{ $totalSumbangan }}"></span> Kg</h4>
                    </div>
                </div>
                <hr class="dark horizontal my-0">
                <div class="card-footer p-3">
                    <p class="mb-0"><span
                            class="{{ $perbandinganSumbangan < 0 ? 'text-danger' : 'text-success' }} text-sm font-weight-bolder">{{ $perbandinganSumbangan }}%
                        </span> dari bulan lalu</p>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-header p-3 pt-2">
                    <div
                        class="icon icon-lg icon-shape bg-gradient-primary shadow-primary text-center border-radius-xl mt-n4 position-absolute">
                        <i class="material-icons opacity-10">people</i>
                    </div>
                    <div class="text-end pt-1">
                        <p class="text-sm mb-0 text-capitalize">Total Donatur bulan {{$bulanTahun}}</p>
                        <h4 class="mb-0"><span id="state2" countTo="{{ $totalDonatur }}"></span> Orang</h4>
                    </div>
                </div>
                <hr class="dark horizontal my-0">
                <div class="card-footer p-3">
                    <p class="mb-0"><span
                            class="{{ $perbandinganDonatur < 0 ? 'text-danger' : 'text-success' }} text-sm font-weight-bolder">{{ $perbandinganDonatur }}
                        </span> orang dari bulan lalu</p>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-header p-3 pt-2">
                    <div
                        class="icon icon-lg icon-shape bg-gradient-warning shadow-warning text-center border-radius-xl mt-n4 position-absolute">
                        <i class="material-icons opacity-10">warning</i>
                    </div>
                    <div class="text-end pt-1">
                        <p class="text-sm mb-0 text-capitalize">Pengajuan belum terverifikasi</p>
                        <h4 class="mb-0"><span id="state3" countTo="{{$pengajuanBelumVerif}}"></span> Pengajuan</h4>
                    </div>
                </div>
                <hr class="dark horizontal my-0">
                <div class="card-footer p-3">
                    <p class="mb-0"><span class="text-danger text-sm font-weight-bolder">-2%</span> than yesterday</p>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-4 animate__animated animate__fadeInUp">
        <div class="col-lg-6 col-md-6 mt-4 mb-4">
            <div class="card z-index-2">
                <div class="card-header p-3 pt-2">
                    <div
                        class="icon icon-lg icon-shape bg-gradient-primary shadow-primary text-center border-radius-xl mt-n4 me-3 float-start">
                        <i class="material-icons opacity-10">leaderboard</i>
                    </div>
                    <div class="d-block d-md-flex">
                        <div class="me-auto">
                            <h6 class="mb-0">Total Sumbangan</h6>
                            <p class="mb-0 text-sm">5 donatur dengan sumbangan terbanyak</p>
                        </div>
                    </div>
                </div>
                <div class="card-body p-3 pt-0">
                    <div class="chart">
                        <canvas id="chart-bars1" class="chart-canvas" height="230"></canvas>
                    </div>
                    <hr class="dark horizontal">
                    <div class="d-flex ">
                        <i class="material-icons text-sm my-auto me-1">schedule</i>
                        <p class="mb-0 text-sm"> campaign sent 2 days ago </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-6 mt-4 mb-4">
            <div class="card z-index-2">
                <div class="card-header p-3 pt-2">
                    <div
                        class="icon icon-lg icon-shape bg-gradient-success shadow-success text-center border-radius-xl mt-n4 me-3 float-start">
                        <i class="material-icons opacity-10">data_usage</i>
                    </div>
                    <div class="d-block d-md-flex">
                        <div class="me-auto">
                            <h6 class="mb-0">Progress Kontainer</h6>
                            <p class="mb-0 text-sm">Progress Kontainer</p>
                        </div>
                    </div>
                </div>
                <div class="card-body p-3 pt-0">
                    <div class="row mt-0 mb-0">
                        <div class="col-md-7 text-center">
                            <div class="chart">
                                <canvas id="myChart1"
                                    class="chart-content mx-auto chart-canvas chart-background-green"></canvas>
                            </div>
                            <h4 class="font-weight-bold mt-n8">
                                <span id="percentageProgress"><span id="state4"
                                        countTo="{{$percentageProgress}}"></span>%</span>
                                <span id="progressText" class="d-block text-body text-sm">{{ $progress[0] }} /
                                    {{$progress[0]+$progress[1]}}</span>
                            </h4>
                        </div>
                        <div class="col-4">
                            <div class="table-responsive">
                                <table class="table align-items-center mb-0">
                                    <tbody>
                                        @foreach($chartData['labels'] as $index => $label)
                                        <tr>
                                            <td>
                                                <div class="d-flex px-2 py-0">
                                                    <i class="material-icons text-lg me-1 my-auto">person</i>
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm">{{ getFirstName($label) }}</h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <h6 class="mb-0 text-sm">
                                                    @if(isset($chartData['values'][$index]))
                                                        {{ $chartData['values'][$index] }} Kg
                                                    @else
                                                        N/A
                                                    @endif
                                                </h6>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <hr class="dark horizontal mt-7">
                    <div class="d-flex">
                        <i id="indicator" class="material-icons text-sm my-auto me-1 custom-icon">brightness_1</i>
                        <p id="indicatorText" class="mb-0 text-sm">Aman</p>
                        <i id="lokasi" class="material-icons position-relative ms-auto text-lg me-1 my-auto">place</i>
                        <p id="lokasiText" class="text-sm my-auto"> {{$namaKel}}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mb-4 animate__animated animate__fadeInUp">
        <div class="col-lg-8 col-md-6 mb-md-0 mb-4">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="row">
                        <div class="col-lg-6 col-7">
                            <h6>Sebaran Lokasi Kontainer</h6>
                            <p class="text-sm mb-0">
                                <i class="fa fa-map-marker text-info" aria-hidden="true"></i>
                                <span class="font-weight-bold ms-1">{{ $totalKontainer }} Lokasi</span> pada
                                {{$bulanTahun}}
                            </p>
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
                    <h6>Notifikasi</h6>
                    <p class="text-sm">
                        <i class="fa fa-bell text-info" aria-hidden="true"></i>
                        <span class="font-weight-bold">0</span> notifikasi bulan {{$bulanTahun}}
                    </p>
                </div>
                <div class="card-body p-3">
                    <div class="row">
                        @if (!empty($notifikasi))
                        @foreach ($notifikasi as $key => $item)
                        @if ($item->status === 'HAMPIR PENUH')
                        <div class="col-md-12">
                            <x-notifikasi.kontainer action="disable" type="warning"
                                notifikasi="Kontainer Utama hampir penuh"
                                type_detail="Ajukan kontainer yang baru supaya dapat terus menerima sumbangan" />
                        </div>
                        @else
                        <div class="col-md-12">
                            <x-notifikasi.kontainer action="disable" type="success"
                                notifikasi="Kontainer Utama dapat diisi"
                                type_detail="Belum membutuhkan pergantian kontainer" />
                        </div>
                        @endif
                        @if ($key === 0)
                        @break
                        @endif
                        @endforeach
                        @else
                        <div class="col-md-12">
                            <x-notifikasi.kontainer action="disable" type="success" kelurahan="Tidak ada permintaan"
                                type_detail="Seluruh kontainer ready" />
                        </div>
                        @endif
                    </div>
                </div>
                <!-- <div class="card-body p-3">
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
                                <h6 class="text-dark text-sm font-weight-bold mb-0">New card added for order
                                    #4395133
                                </h6>
                                <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">20 DEC 2:20 AM</p>
                            </div>
                        </div>
                        <div class="timeline-block mb-3">
                            <span class="timeline-step">
                                <i class="material-icons text-primary text-gradient">key</i>
                            </span>
                            <div class="timeline-content">
                                <h6 class="text-dark text-sm font-weight-bold mb-0">Unlock packages for development
                                </h6>
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
                </div> -->
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('assets/js/core/popper.min.js') }}"></script>
<script src="{{ asset('assets/js/core/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/perfect-scrollbar.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/smooth-scrollbar.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/chartjs.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.3.0/dist/chart.umd.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/leaflet@1.7.1/dist/leaflet.js"></script>
<script src='https://api.mapbox.com/mapbox.js/plugins/leaflet-fullscreen/v1.0.1/Leaflet.fullscreen.min.js'></script>
<script src="https://code.jquery.com/jquery-3.4.1.min.js"
    integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
<script src="{{ asset('assets/js/core/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/countup.min.js') }}"></script>

<script>
var ctx = document.getElementById("chart-bars1").getContext("2d");

new Chart(ctx, {
    type: "bar",
    data: {
        labels: @json(array_map(function($label) {
            return getFirstName($label);
        }, $chartData['labels'])),
        datasets: [{
            label: "Total Sumbangan",
            tension: 1,
            borderWidth: 0,
            borderRadius: 5,
            borderSkipped: false,
            backgroundColor: "rgba(209, 32, 49, 1)",
            data: @json($chartData['values']),
            maxBarThickness: 12
        }, ],
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                display: false,
            }
        },
        interaction: {
            intersect: false,
            mode: 'index',
        },
        scales: {
            y: {
                grid: {
                    drawBorder: false,
                    display: true,
                    drawOnChartArea: true,
                    drawTicks: false,
                    borderDash: [5, 5],
                    color: '#c1c4ce5c'
                },
                ticks: {
                    suggestedMin: 0,
                    suggestedMax: 500,
                    beginAtZero: true,
                    padding: 10,
                    color: "#9ca2b7",
                    font: {
                        size: 10,
                        weight: 300,
                        family: "Poppins",
                        style: 'normal',
                        lineHeight: 2
                    },
                },
            },
            x: {
                grid: {
                    drawBorder: false,
                    display: true,
                    drawOnChartArea: true,
                    drawTicks: false,
                    borderDash: [5, 5],
                    color: '#c1c4ce5c'
                },
                ticks: {
                    display: true,
                    color: '#9ca2b7',
                    padding: 10,
                    font: {
                        size: 12,
                        weight: 300,
                        family: "Poppins",
                        style: 'normal',
                        lineHeight: 2
                    },
                }
            },
        },
    },
});
</script>

<script>
function updateChart(selectedLokasiId) {
    $.ajax({
        url: '/dashboard/fetchChartData/' + selectedLokasiId,
        method: 'GET',
        dataType: 'json',
        success: function(data) {
            updateMyChart1(data);
        },
        error: function(xhr, textStatus, errorThrown) {
            console.error('Error fetching data: ' + errorThrown);
        }
    });
}

function updateMyChart1(newData) {
    myChart1.data.datasets[0].data = newData;
    var totalSumbangan1 = newData[0];
    var totalKapasitasKontainer = newData[0] + newData[1];
    var percentageProgress = Math.abs(((totalSumbangan1 / totalKapasitasKontainer) * 100).toFixed(2));
    document.getElementById('percentageProgress').textContent = percentageProgress + '%';
    document.getElementById('progressText').textContent = totalSumbangan1.toFixed(2) + '/' + totalKapasitasKontainer;

    var indicatorIcon = document.getElementById('indicator');
    var indicatorText = document.getElementById('indicatorText');
    var chartCanvas = document.getElementById('myChart1');

    indicatorIcon.classList.remove('custom-icon', 'custom-icon2', 'custom-icon3');
    chartCanvas.classList.remove('chart-background-green', 'chart-background-yellow', 'chart-background-red');

    if (percentageProgress <= 50.0) {
        indicatorIcon.classList.add('custom-icon');
        indicatorIcon.textContent = 'brightness_1';
        indicatorText.textContent = 'Aman';
        myChart1.data.datasets[0].backgroundColor = ['rgba(101, 174, 56, 1)', 'rgba(0, 0, 0, 0)'];
        chartCanvas.classList.add('chart-background-green');
    } else if (percentageProgress > 50.0 && percentageProgress <= 80.0) {
        indicatorIcon.classList.add('custom-icon2');
        indicatorIcon.textContent = 'brightness_1';
        indicatorText.textContent = 'Mulai Penuh';
        myChart1.data.datasets[0].backgroundColor = ['rgba(255, 167, 38, 1)', 'rgba(0, 0, 0, 0)'];
        chartCanvas.classList.add('chart-background-yellow');
    } else {
        indicatorIcon.classList.add('custom-icon3');
        indicatorIcon.textContent = 'brightness_1';
        indicatorText.textContent = 'Perlu penjemputan';
        myChart1.data.datasets[0].backgroundColor = ['rgba(209, 32, 49, 1)', 'rgba(0, 0, 0, 0)'];
        chartCanvas.classList.add('chart-background-red');
    }

    myChart1.update();
}

var ctx1 = document.getElementById('myChart1').getContext('2d');
var colors1 = ['rgba(101, 174, 56, 1)', 'rgba(0, 0, 0, 0)'];
var cutout1 = '85%';

var myChart1 = new Chart(ctx1, {
    type: 'doughnut',
    data: {
        labels: ['Terisi', 'kosong'],
        datasets: [{
            label: 'Total',
            data: @json($progress),
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
        interaction: {
            intersect: false,
            mode: 'index',
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

var mapData = {!!$mapData!!};

for (var i = 0; i < mapData.length; i++) {
    var marker = mapData[i];

    var popupContent = '<div class="custom-popup">' +
        '<h3 class="custom-popup-title">' + marker.nama + '</h3>' + '<hr class="dark horizontal">' +
        '<p class="custom-popup-lat">Total Donatur: ' + marker.total_donatur + ' Orang</p>' +
        '<p class="custom-popup-lng">Total Berat: ' + marker.total_berat + ' L</p>' +
        '</div>';

    L.marker([marker.lat, marker.lng])
        .addTo(map)
        .bindPopup(popupContent, {
            className: 'custom-popup'
        });
}
</script>

<script>
if (document.getElementById('state1')) {
    var initialValue = parseFloat(document.getElementById("state1").getAttribute("countTo")).toFixed(2);

    const countUp = new CountUp('state1', initialValue, {
        useGrouping: false,
        separator: '',
        decimalPlaces: 1,
        duration: 1
    });

    if (!countUp.error) {
        countUp.start();
    } else {
        console.error(countUp.error);
    }
}
if (document.getElementById('state2')) {
    var initialValue = parseFloat(document.getElementById("state2").getAttribute("countTo")).toFixed(2);

    const countUp = new CountUp('state2', initialValue, {
        useGrouping: false,
        separator: '',
        duration: 1
    });

    if (!countUp.error) {
        countUp.start();
    } else {
        console.error(countUp.error);
    }
}
if (document.getElementById('state3')) {
    var initialValue = parseFloat(document.getElementById("state3").getAttribute("countTo")).toFixed(2);

    const countUp = new CountUp('state3', initialValue, {
        useGrouping: false,
        separator: '',
        decimalPlaces: 0,
        duration: 1
    });

    if (!countUp.error) {
        countUp.start();
    } else {
        console.error(countUp.error);
    }
}
if (document.getElementById('state4')) {
    var initialValue = parseFloat(document.getElementById("state4").getAttribute("countTo")).toFixed(2);

    const countUp = new CountUp('state4', initialValue, {
        useGrouping: false,
        separator: '',
        decimalPlaces: 2,
        duration: 1
    });

    if (!countUp.error) {
        countUp.start();
    } else {
        console.error(countUp.error);
    }
}
</script>

@stop