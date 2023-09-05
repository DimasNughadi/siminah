@extends('components._partials.default')

@section('content')
    <div class="container-fluid py-2 ps-4">
        <div class="row">
            <div class="col-lg-12 page-header text-poppins">
                <a href="{{ route('sumbangan') }}" class="text-secondary link-secondary">Sumbangan</a>
                <span>
                    <b>
                        &nbsp;/ Detail Sumbangan
                    </b>
                </span>
            </div>
        </div>
        <div class="row pt-3">
            <div class="col-xxl-10">
                <div class="row detail-riwayat-sumbangan animate__animated animate__fadeInUp ">
                    <div class="col-md-8">
                        <div class="container-fluid">
                            <h1>Riwayat Donasi</h1>
                        </div>
                    </div>
                    <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
                        <div class="right-header ms-3 ms-xxl-0 ms-xl-0 ms-lg-0 ms-md-0">
                            <div class="header-button">
                                <div
                                    class="text-poppins text-14 btn-reward-position d-flex justify-content-end align-items-end">
                                    <a href="#"
                                        class="btn-reward 
                                    btn-semi-success d-flex align-items-center export-btn"
                                        onclick="generate()">
                                        EXPORT
                                        <span class="material-symbols-outlined">
                                            download
                                        </span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- {{ dd($riwayat) }} --}}

                    <div class="col-md-12">
                        <div class="body overflowy-kontainer-kelurahan">
                            <x-forms.table id="riwayat-verifikasi-kelurahan">
                                @slot('headSlot')
                                    <th>NAMA</th>
                                    <th>BERAT SUMBANGAN (Kg)</th>
                                    <th>WAKTU SUMBANGAN</th>
                                    <th>STATUS</th>
                                @endslot

                                @slot('bodySlot')
                                    @if (!empty($riwayat))
                                        @foreach ($riwayat as $item)
                                            <tr class="verifikasi-tr">
                                                <td class="ps-4 nama">
                                                    <div class="d-flex align-items-center justify-center">
                                                        <span
                                                            class="top">{{ $item->donatur->nama_donatur}}</span>
                                                    </div>
                                                </td>
                                                <td class="ps-4 tanggal">
                                                    {{ $item->berat }}
                                                </td>
                                                <td class="ps-4 tanggal">
                                                    {{ datetimeFormat($item->updated_at) }}
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

@stop

@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.6/jspdf.plugin.autotable.min.js"></script>
    <script>
        var tanggalHariIni = new Date();
        var options = {
            day: 'numeric',
            month: 'long',
            year: 'numeric'
        };
        var tanggalHariIni = tanggalHariIni.toLocaleDateString('id-ID', options);

        var tableData = [];
        var rows = document.querySelectorAll('#riwayat-verifikasi-kelurahan tr');
        for (var i = 0; i < rows.length; i++) {
            var cells = rows[i].querySelectorAll('td');
            tableData[i] = [];
            for (var j = 0; j < cells.length; j++) {
                tableData[i][j] = cells[j].textContent.replace(/\n/g, '').trim();
            }
        }

        var tableDataWithRowNumbers;
        tableData = tableData.slice(1);
        tableDataWithRowNumbers = tableData.map(function(row, index) {
            return [index + 1].concat(row).slice(0);
        });

        function generate() {
            var doc = new jsPDF('p', 'pt', 'a4');
            var htmlstring = '';
            var tempVarToCheckPageHeight = 0;
            var pageHeight = 0;
            pageHeight = doc.internal.pageSize.height;
            specialElementHandlers = {
                // element with id of "bypass" - jQuery style selector  
                '#bypassme': function(element, renderer) {
                    // true = "handled elsewhere, bypass text extraction"  
                    return true
                }
            };
            margins = {
                top: 150,
                bottom: 60,
                left: 40,
                right: 40,
                width: 600
            };
            var y = 20;
            doc.setLineWidth(2);
            doc.setFontSize(10);
            doc.text(40, y = y + 10, tanggalHariIni);
            doc.setFontSize(16);
            doc.text(110, y = y + 30, "LAPORAN RIWAYAT VERIFIKASI SUMBANGAN");
            doc.setFontSize(12);
            doc.autoTable({
                headStyles: {
                    fillColor: [101, 174, 56],
                    valign: 'middle',
                    halign: 'center',
                },
                // html: '#sumbangan-table',
                head: [
                    ['NO', 'NAMA', 'BERAT SUMBANGAN (Kg)', 'WAKTU SUMBANGAN', 'STATUS']
                ],
                body: tableDataWithRowNumbers,
                startY: 70,
                theme: 'striped',
                columnStyles: {
                    0: {
                        cellWidth: 40,
                    },
                    1: {
                        cellWidth: 140,
                    },
                    2: {
                        cellWidth: 40,
                    },
                    3: {
                        cellWidth: 170,
                    },
                    4: {
                        cellWidth: 150
                    }
                },
                styles: {
                    minCellHeight: 10
                },
                columnStyles: {
                    0: {
                        valign: 'middle',
                        halign: 'center',
                        fontStyle: 'bold',
                    },
                    2: {
                        valign: 'middle',
                        halign: 'center',
                        fontStyle: 'bold',
                    }
                },
                didDrawCell: function(data) {
                    if (data.section === 'body' && data.column.index !== data.table.columns.length - 1) {
                        doc.setDrawColor(200, 200, 200); // Set the color of the delimiter
                        doc.setLineWidth(0.5); // Set the width of the delimiter
                        doc.line(data.cell.x + data.cell.width, data.cell.y, data.cell.x + data.cell.width, data
                            .cell.y + data.cell.height); // Draw the delimiter
                    }
                },
            })
            doc.save('Laporan-riwayat-verifikasi-' + tanggalHariIni.replace(' ', '-') + '.pdf');
        }
    </script>
@endsection
