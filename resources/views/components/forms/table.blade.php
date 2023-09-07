@props(['id' => ''])

<div class="table-responsive-sm table-responsive-xl table-responsive-lg table-responsive-md">
    <table id="{{ $id }}" data-id="{{ $id }}"
        class="tableForPagination table align-middle mb-0 reward-table ps-6">
        <thead>
            <tr>
                {{ $headSlot }}
            </tr>
        </thead>
        <tbody>
            {{ $bodySlot }}
        </tbody>
    </table>
</div>

@section('script')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script>
        
        const dataId = $('.tableForPagination').data('id')
        console.log(dataId);
        const dataTableConfig = {
                destroy: true,
                searching: false,
                ordering: false,
                paging: true,
                lengthChange: false,
                pageLength: 5,
                info: false,
                language: {
                    paginate: {
                        first: '&laquo;', 
                        previous: '&lt;', 
                        next: '&gt;',
                        last: '&raquo;'
                    }
                },
            }

        if (dataId === 'table-detail-donatur') {
            $.fn.dataTable.ext.classes.sPageButton = 'btn-paginate';
            dataTableConfig.pageLength = 7; 
            $('#table-detail-donatur').DataTable(dataTableConfig);
        } else if (dataId === 'table-verifikasi-donasi') {
            $.fn.dataTable.ext.classes.sPageButton = 'btn-paginate';
            $('#table-verifikasi-donasi').DataTable(dataTableConfig);
        } else if (dataId === 'table-penggantian-kontainer') {
            
        }else if (dataId === 'table-index-donatur'){
            $.fn.dataTable.ext.classes.sPageButton = 'btn-paginate';
            dataTableConfig.pageLength = 8; 
            $('#table-index-donatur').DataTable(dataTableConfig);
        }else if (dataId === 'tabel-index-reward'){
            $.fn.dataTable.ext.classes.sPageButton = 'btn-paginate';
            dataTableConfig.pageLength = 8; 
            $('#tabel-index-reward').DataTable(dataTableConfig);
        }else if (dataId === 'tabel-index-admin'){
            $.fn.dataTable.ext.classes.sPageButton = 'btn-paginate';
            dataTableConfig.pageLength = 6; 
            $('#tabel-index-admin').DataTable(dataTableConfig);
        }else if (dataId === 'tabel-manajemen-permintaan'){
            $.fn.dataTable.ext.classes.sPageButton = 'btn-paginate';
            dataTableConfig.pageLength = 7; 
            $('#tabel-manajemen-permintaan').DataTable(dataTableConfig);
        }else if (dataId === 'tabel-index-lokasi'){
            $.fn.dataTable.ext.classes.sPageButton = 'btn-paginate';
            dataTableConfig.pageLength = 3; 
            $('#tabel-index-lokasi').DataTable(dataTableConfig);
        }else if (dataId === 'table-penggantian-kontainer'){
            $.fn.dataTable.ext.classes.sPageButton = 'btn-paginate';
            dataTableConfig.pageLength = 1; 
            $('#table-penggantian-kontainer').DataTable(dataTableConfig);
        }else if (dataId === 'table-detail-donatur'){
            $.fn.dataTable.ext.classes.sPageButton = 'btn-paginate';
            dataTableConfig.pageLength = 4; 
            $('#table-detail-donatur').DataTable(dataTableConfig);
        }else if (dataId === 'table-detail-reward'){
            $.fn.dataTable.ext.classes.sPageButton = 'btn-paginate';
            dataTableConfig.pageLength = 7; 
            $('#table-detail-reward').DataTable(dataTableConfig);
        }
    </script>
@endsection
