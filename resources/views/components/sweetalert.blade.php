@if (!empty(session('success_alert')))
    <script>
        Swal.fire(
            'Deleted!',
            'Login berhasil yey',
            'success',
        )

        // Swal.fire({
        //         position: 'bottom-end',
        //         title: 'Your work has been saved',
        //         showConfirmButton: false,
        //         timer: 3000,
        //         background: 'rgba(52, 181, 58, 0.2)',
        //         backdrop: false,
        //     })
    </script>
@endif
