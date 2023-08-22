@extends('components._partials.default')

@section('content')
{{-- {!! json_encode($chartData['labels']) !!}
{{!! json_encode(number_format($persentase, 1)) !!}} --}}
    <div class="container-fluid py-2 ps-4">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-12 reward text-poppins">Sumbangan</div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-3 col-sm-12 col-12">
                        <div class="container-fluid sumbangan-kelurahan">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="header">
                                        Total verifikasi
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12 col-12">
                                    <div class="body">
                                        <div class="row">
                                            <div class="chart-container">
                                                <div class="chart-content">
                                                    <canvas id="myChart2"></canvas>
                                                    <div class="chart-background"></div>
                                                    <div class="chart-circle-white"></div>
                                                    <div class="chart-circle-colored"></div>
                                                    <div class="chart-percentage">{{ number_format($persentase, 1) }}%</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="footer">
                                        <div class="row">
                                            <div class="col-md-6 col-6 col-sm-6">
                                                <canvas class="circle fill"></canvas>
                                                <span>Sudah</span>
                                            </div>
                                            <div class="col-md-6 col-6 col-sm-6">
                                                <canvas class="circle transparent"></canvas>
                                                <span>Belum</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12 col-12">
                        <div class="container-fluid sumbangan-kelurahan mt-sm-3 mt-3 mt-md-0">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="header">
                                        Total verifikasi
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12 col-12">
                                    <div class="body">
                                        <div class="row">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="196" height="196"
                                                viewBox="0 0 196 196" fill="none">
                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                    d="M98 196C152.124 196 196 152.124 196 98C196 43.8761 152.124 0 98 0C43.8761 0 0 43.8761 0 98C0 152.124 43.8761 196 98 196Z"
                                                    fill="#E2FBD7" />
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5 col-sm-12 col-12">
                        <div class="table-sumbangan-kelurahan mt-sm-3 mt-3 mt-md-0">
                            <div class="main-table">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-8 col-sm-8 col-8">
                                                <div class="header">
                                                    Riwayat verifikasi
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="body overflowy-kontainer-kelurahan">
                                            <x-forms.table>
                                                @slot('headSlot')
                                                    <th>NAMA</th>
                                                    <th>WAKTU SUMBANGAN</th>
                                                    <th>STATUS</th>
                                                @endslot

                                                @slot('bodySlot')
                                                    {{-- {{ dd($riwayat) }} --}}
                                                    @if (!empty($riwayat))
                                                        @foreach ($riwayat as $item)
                                                            <tr class="verifikasi-tr">
                                                                <td class="ps-4 nama">
                                                                    <div class="d-flex align-items-center justify-center">
                                                                        <x-user.userImage
                                                                            src="{{ 'donatur/' . $item->donatur->photo }}" />
                                                                        <div class="ms-2">
                                                                            <span
                                                                                class="top">{{ getFirstName($item->donatur->nama_donatur) }}</span><br>
                                                                            <span class="bottom">{{ $item->berat }} Kg</span>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td class="ps-4 tanggal">
                                                                    {{ datetimeFormat($item->created_at) }}
                                                                </td>
                                                                <td class="ps-4 ">
                                                                @if (strtolower($item->status) === 'terverifikasi')
                                                                    <div
                                                                        class="btn-reward btn-table-custom bg-success
                                                                    position-relative">
                                                                            <span class="position-relative add-reward">
                                                                                Terverifikasi
                                                                            </span>
                                                                        </div>
                                                                    @else
                                                                        <div
                                                                            class="btn-reward btn-table-custom bg-danger
                                                                    position-relative">
                                                                            <span class="position-relative add-reward">
                                                                                Ditolak
                                                                            </span>
                                                                        </div>
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    @endif
                                                @endslot
                                            </x-forms.table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 col-12 col-sm-12">
                        <div class="verifikasi-donasi mt-2 mt-md-4 mt-sm-2 ">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="header">
                                        Verifikasi donasi
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                {{-- {{ dd($verifikasiStatus) }} --}}
                                <div class="col-md-12">
                                    <div class="body mt-2">
                                        <x-forms.table>
                                            @slot('headSlot')
                                                <th>NAMA DONATUR</th>
                                                <th>JUMLAH DONASI</th>
                                                <th>KELURAHAN</th>
                                                <th>WAKTU DONASI</th>
                                                <th>FOTO DONASI</th>
                                                <th>AKSI</th>
                                            @endslot

                                            @slot('bodySlot')
                                                @if (!empty($verifikasiStatus))
                                                    @foreach ($verifikasiStatus as $item)
                                                        <tr class="verifikasi-row">
                                                            <td class="ps-4 nama">
                                                                <div class="d-flex align-items-center justify-center">
                                                                    <x-user.userImage
                                                                        src="{{ 'donatur/' . $item->donatur->photo }}" />
                                                                    <span
                                                                        class="ps-2">{{ getFirstName($item->donatur->nama_donatur) }}</span>
                                                                </div>
                                                            </td>
                                                            <td class="ps-4 berat">
                                                                {{ $item->berat }} Kg
                                                            </td>
                                                            <td class="ps-4 kelurahan">
                                                                {{ $item->donatur->nama_kelurahan }}
                                                            </td>
                                                            <td class="ps-4 tanggal">
                                                                {{ datetimeFormat($item->created_at) }}
                                                            </td>
                                                            <td class="ps-4">
                                                                <div class="foto-donasi cursor-pointer">
                                                                    <img src="{{ asset('storage/sumbangan/' . $item->photo) }}"
                                                                        alt="gambar sumbangan" data-bs-toggle="modal"
                                                                        data-bs-target="#detailImage" id="gambar-sumbangan"
                                                                        onclick="detailSumbangan('{{ asset('storage/sumbangan/' . $item->photo) }}')">
                                                                </div>
                                                            </td>
                                                            <td class="ps-4 ">
                                                                <div class="d-flex">
                                                                    <div class="btn-reward btn-table-custom bg-success
                                                                position-relative"
                                                                        onclick="verifikasiSumbangan('{{ route('sumbangan.update', ['id' => $item->id_donatur, 'created_at' => $item->created_at]) }}')">
                                                                        <span
                                                                            class="position-relative add-reward cursor-pointer">
                                                                            Verifikasi
                                                                        </span>
                                                                    </div>
                                                                    <div class="btn-reward btn-table-custom bg-danger
                                                                position-relative ms-1"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#deskripsi-penolakan"
                                                                        onclick="TolakSumbangan('{{ route('sumbangan.update', ['id' => $item->id_donatur, 'created_at' => $item->created_at]) }}')">
                                                                        <span
                                                                            class="position-relative add-reward cursor-pointer">
                                                                            Tolak
                                                                        </span>
                                                                    </div>

                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @endif
                                            @endslot
                                        </x-forms.table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Sweetalert --}}
    <x-sweetalert />
    {{-- Verifikasi status forms --}}
    <form method="POST" action="" id="verifikasiStatusForm">
        @csrf
        @method('PUT')
        <input type="hidden" name="status" value="terverifikasi">
    </form>
    {{-- Modal --}}
    <x-modals.detailGambarModal modalName="detailImage" title="Detail gambar sumbangan">
        @slot('slotBody')
            <div class="modal-detail-gambar">
                <img src="" alt="gambar" id="modal-image-sumbangan">
            </div>
        @endslot
        </x-modals.Modal>

        {{-- Modal tolak --}}
        <x-modals.Modal modalName="deskripsi-penolakan" route="sumbangan.update" title="Deskripsi penolakan">
            @slot('slotMethod')
                <form action="" id="FormPenolakanSumbangan" method="POST">
                @csrf
                @method('PUT')
            @endslot

            @slot('slotBody')
                <input type="hidden" name="status" value="ditolak">
                <div class="form-floating border rounded">
                    <textarea class="form-control ps-2" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 200px"
                        name="keterangan"></textarea>
                    <label for="floatingTextarea2">Deskripsi</label>
                </div>
            @endslot

            @slot('slotFooter')
                <x-forms.btn.button type="submit" color="danger" title="Simpan" />
            @endslot
        </x-modals.Modal>
        <style>
            .chart-container {
                display: flex;
                justify-content: center;
                align-items: center;
            }
        
            .chart-content {
                position: relative;
                display: block;
                width: 194px;
                height: 194px;
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
                background-color: rgba(255, 58, 41, .25);
                border-radius: 50%;
                z-index: 1;
                pointer-events: none;
            }
        
            .chart-percentage {
                position: absolute;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                font-size: 22px;
                font-family: DM Sans
                font-weight: bold;
                color: white;
                z-index: 5;
            }
        
            .chart-circle-colored {
                position: absolute;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                width: 86px;
                height: 86px;
                border-radius: 50%;
                background-color: #FF3A29;
                z-index: 4;
            }
        
            .chart-circle-white {
                position: absolute;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                width: 165px;
                height: 165px;
                border-radius: 50%;
                background-color: white;
                z-index: 3;
            }
        </style>

        <script src="https://cdn.jsdelivr.net/npm/chart.js@4.3.0/dist/chart.umd.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.4.1.min.js"
            integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous" async></script>


        <script>
            var ctx1 = document.getElementById('myChart2').getContext('2d');
            var data1 = [{!! json_encode(number_format($persentase ,1)) !!}, {!! json_encode(100 - number_format($persentase ,1)) !!}];;
            var colors1 = ['rgba(255, 58, 41, 1)', 'rgba(0, 0, 0, 0)'];
            var cutout1 = '85%';
            var myChart1 = new Chart(ctx1, {
                type: 'doughnut',
                data: {
                    // labels: ['Terverifikasi', 'Belum terverifikasi'],
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
        </script>


@stop

@extends('components._partials.scripts')
@section('script')
    <script>
        function TolakSumbangan(action) {
            const FormPenolakanSumbangan = document.querySelector('#FormPenolakanSumbangan')

            FormPenolakanSumbangan.action = action;
            FormPenolakanSumbangan.sumbit()
        }
    </script>
@endsection
