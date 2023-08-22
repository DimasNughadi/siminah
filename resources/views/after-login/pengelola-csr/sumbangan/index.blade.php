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
                    <div class="col-md-10 col-sm-12 col-12">
                        <div class="container-fluid olah-donatur animate__animated animate__fadeInUp">
                            <div class="row">
                                <div class="col-md-8 col-sm-7 col-7">
                                    <div class="header">
                                        Laporan Sumbangan Minyak Jelantah
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-5 col-sm-5">
                                    <div class="laporan-button d-flex align-items-center justify-content-end">
                                        <x-forms.inputDate />
                                        <div class="header-button">
                                            <div
                                                class="text-poppins text-14 btn-reward-position d-flex justify-content-end align-items-end">
                                                <a href="#"
                                                    class="btn-reward 
                                                btn-semi-success position-relative d-flex align-items-center export-btn"
                                                    onclick="exportToPdf()">
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
                                                <th>KELURAHAN</th>
                                                <th>JUMLAH (LITER)</th>
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
                                                                    {{-- <x-user.userImage width="34" height="34"/> --}}
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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script>
        const input = document.getElementById('bulan');
        const table = document.getElementById('sumbangan-table');
        const tableRows = table.getElementsByTagName('tr');

        function isMonth(month) {
            const monthNames = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September',
                'October', 'November', 'December'
            ];
            const length = monthNames[month - 1].length;
            if (length <= 5) {
                input.style.width = '100px'
            } else if (length <= 6) {
                input.style.width = '120px'
            } else {
                input.style.width = '140px'
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
            for (let i = 1; i < tableRows.length; i++) {
                const row = tableRows[i];
                const tanggalCell = row.querySelector('td#tanggal');
                const tanggalText = tanggalCell.textContent;
                if (tanggalText.includes(keyword)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            }
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


        function adjustInputWidth() {
            const selectedMonth = input.value;
            const monthValue = selectedMonth.split('-')[1];
            isMonth(monthValue.split('')[1])

            // Search
            const keyword = strToDate(selectedMonth)
            console.log(keyword);
            searchByMonthAndYear(keyword)
        }

        function exportToPdf() {
            const doc = new jsPDF();
            doc.autoTable({
                html: '#sumbangan-table'
            });
            doc.save('table.pdf');
        }
    </script>
@stop
