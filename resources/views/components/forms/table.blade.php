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
    <script>
        const dataId = $('.tableForPagination').data('id')
        console.log(dataId);
        pagination(dataId)
    </script>
@endsection
