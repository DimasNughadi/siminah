@if (!empty(session('success_alert')))
    <script>
        Swal.fire(
            'Deleted!',
            'Login berhasil yey',
            'success',
        )
    </script>
@endif
