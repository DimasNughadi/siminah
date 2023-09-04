@extends('components._partials.default')

@section('content')
    {{-- {{ dd($laporan) }} --}}
    <div class="container-fluid py-2 ps-4">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-12 reward text-poppins">Sumbangan</div>
                </div>
                <div class="row mt-3">
                    <div class="col-xxl-10 col-xl-10 col-lg-11 col-md-12 col-sm-12 col-12">
                        <div class="container-fluid olah-donatur animate__animated animate__fadeInUp">
                            <div class="row">
                                <div class="col-xxl-8 col-xl-8 col-lg-8 col-md-8 col-sm-12 col-12">
                                    <div class="header">
                                        Laporan Sumbangan Minyak Jelantah
                                    </div>
                                </div>
                                <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
                                    <div class="right-header ms-3 ms-xxl-0 ms-xl-0 ms-lg-0 ms-md-0">
                                        <x-forms.inputDate />
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
                                <div class="col-md-12 col-sm-12 col-12">
                                    <div class="body">
                                        <x-forms.table id="sumbangan-table">
                                            @slot('headSlot')
                                                <th>KECAMATAN</th>
                                                <th>KELURAHAN</th>
                                                <th>JUMLAH (KG)</th>
                                                <th>JUMLAH DONATUR</th>
                                                <th>TANGGAL PELAPORAN</th>
                                            @endslot

                                            @slot('bodySlot')
                                                {{-- @dd($laporan) --}}
                                                @if (!empty($laporan))
                                                    @foreach ($laporan as $item)
                                                        <tr class="reward-tr donatur-csr-tr">
                                                            <td class="ps-3 detail-kelurahan">
                                                                <div class="d-flex align-items-center">
                                                                    <div class="ms-2  d-grid">
                                                                        <span class="top">
                                                                            {{ $item->nama_kecamatan }}
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td class="ps-3 detail-kelurahan">
                                                                <div class="d-flex align-items-center">
                                                                    <div class="ms-2  d-grid">
                                                                        <span class="top">
                                                                            {{ $item->nama_kelurahan }}
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td class="ps-4 subdata">
                                                                {{ $item->total_berat }}
                                                            </td>
                                                            <td class="ps-4 subdata">
                                                                {{ $item->total_donatur }}
                                                            </td>
                                                            <td class="ps-4 tanggal" id="tanggal">
                                                                {{ dateFormat($item->tanggal_laporan) }}
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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.6/jspdf.plugin.autotable.min.js"></script>
    <script>
        const input = document.getElementById('bulan');
        const table = document.getElementById('sumbangan-table');
        const tableRows = table.getElementsByTagName('tr');

        // get current Time
        var tanggalHariIni = new Date();
        var options = {
            day: 'numeric',
            month: 'long',
            year: 'numeric'
        };
        var tanggalHariIni = tanggalHariIni.toLocaleDateString('id-ID', options);
        // console.log(formattedDate);

        var tableData = [];
        var rows = document.querySelectorAll('#sumbangan-table tr');
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

        function isMonth(month) {
            const monthNames = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September',
                'October', 'November', 'December'
            ];
            const length = monthNames[month - 1].length;
            if (length <= 5) {
                input.style.width = '100px'
            } else if (length <= 6) {
                input.style.width = '120px'
            } else if (length <= 7) {
                input.style.width = '140px'
            } else {
                input.style.width = '150px'
            }
        }

        function strToDate(dateStr) {
            const date = new Date(dateStr);
            const monthNames = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
            const monthName = monthNames[date.getMonth()];
            const year = date.getFullYear();
            const formattedDate = `${monthName} ${year}`;
            return formattedDate;
        }

        function searchByMonthAndYear(keyword) {
            // let sumRowsDeleted = 0;
            tableData = [];

            for (let i = 1; i < tableRows.length; i++) {
                const row = tableRows[i];
                const tanggalCell = row.querySelector('td#tanggal');
                const tanggalText = tanggalCell.textContent;
                if (tanggalText.includes(keyword)) {
                    row.style.display = '';
                    var rowData = [];
                    var cells = row.querySelectorAll('td');
                    for (let j = 0; j < cells.length; j++) {
                        rowData.push(cells[j].textContent.trim());
                    }
                    tableData.push(rowData);
                } else {
                    row.style.display = 'none';
                }

            }

            tableDataWithRowNumbers;
            tableDataWithRowNumbers = tableData.map(function(row, index) {
                return [index + 1].concat(row).slice(0);
            });
        }

        function setCurrentMonth() {
            const currentDate = new Date();
            const currentMonth = currentDate.getMonth() + 1;
            const currentMonthString = currentMonth < 10 ? '0' + currentMonth : currentMonth;
            const currentYear = currentDate.getFullYear();
            const currentValue = `${currentYear}-${currentMonthString}`;
            input.value = currentValue;
            // length
            isMonth(currentMonth)
            // datetime
            // const searchData = strToDate(currentValue)
            // searchByMonthAndYear(searchData)
        }

        setCurrentMonth();

        input.addEventListener("input", function() {
            if (input.value === "") {
                tableData = [];

                for (let i = 1; i < tableRows.length; i++) {
                    const row = tableRows[i];
                    const tanggalCell = row.querySelector('td#tanggal');
                    const tanggalText = tanggalCell.textContent;
                    row.style.display = '';
                    var rowData = [];
                    var cells = row.querySelectorAll('td');
                    for (let j = 0; j < cells.length; j++) {
                        rowData.push(cells[j].textContent.trim());
                    }
                    tableData.push(rowData);

                }

                tableDataWithRowNumbers;
                tableDataWithRowNumbers = tableData.map(function(row, index) {
                    return [index + 1].concat(row).slice(0);
                });

                // Set again
                const currentDate = new Date();
                const currentMonth = currentDate.getMonth() + 1;
                const currentMonthString = currentMonth < 10 ? '0' + currentMonth : currentMonth;
                const currentYear = currentDate.getFullYear();
                const currentValue = `${currentYear}-${currentMonthString}`;
                input.value = currentValue;
            }

        });


        function adjustInputWidth() {
            const selectedMonth = input.value;
            const monthValue = selectedMonth.split('-')[1];
            isMonth(monthValue.split('')[1])

            // Search
            const keyword = strToDate(selectedMonth)
            // console.log(keyword);
            searchByMonthAndYear(keyword)
        }


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
            doc.text(130, y = y + 30, "LAPORAN SUMBANGAN MINYAK JELANTAH");
            doc.setFontSize(12);
            doc.autoTable({
                headStyles: {
                    fillColor: [101, 174, 56],
                    valign: 'middle',
                    halign: 'center',
                },
                // html: '#sumbangan-table',
                head: [
                    ['NO', 'KECAMATAN', 'KELURAHAN', 'JUMLAH (KG)', 'JUMLAH DONATUR', 'TANGGAL PELAPORAN']
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
                        cellWidth: 140,
                    },
                    3: {
                        cellWidth: 80,
                    },
                    4: {
                        cellWidth: 80
                    },
                    5: {
                        cellWidth: 60
                    },
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
                    3: {
                        valign: 'middle',
                        halign: 'center',
                        fontStyle: 'bold',
                    },
                    4: {
                        valign: 'middle',
                        halign: 'center',
                        fontStyle: 'bold',
                    },
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
            doc.save('Laporan-sumbangan-minyak-' + tanggalHariIni.replace(' ', '-') + '.pdf');
        }
    </script>

@stop
