@props(['id' => ''])

<div class="table-responsive">
    <table id="{{ $id }}" class="table align-middle mb-0 reward-table ps-5">
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

{{-- @extends('components._partials.scripts')
@section('script')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            var table = $('#example').DataTable();

            if ($.fn.DataTable.isDataTable('#example')) {
                table.destroy();
            }

            $('#example').DataTable({
                // DataTables configuration options
            });
        });

        $(document).ready(function() {
            $('#example').DataTable({
                destroy: true,
                searching: true,
                paging: true,
                lengthChange: false,
                pageLength: 8,
                info: false
            });

            var rows = table.rows().nodes();
            $(rows).removeClass('last-row');
            $(rows).last().addClass('last-row');
        });
    </script>
@endsection --}}
