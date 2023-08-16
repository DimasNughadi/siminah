@if (!empty(session('login_alert')))
    @if (session('login_alert') === 'success')
        <script>
            Swal.fire(
                'Login!',
                'Login berhasil',
                'success',
            );
        </script>
    @elseif(session('login_alert') === 'error')
        <script>
            Swal.fire(
                'Login!',
                'Username atau Password salah!',
                'error',
            );
        </script>
    @endif
@elseif (!empty(session('logout_alert')))
    @if (session('logout_alert') === 'success')
        <script>
            Swal.fire(
                'Logout!',
                'Logout berhasil',
                'success',
            );
        </script>
    @else
        
    @endif
    {{-- Swal.fire({
        position: 'bottom-end',
        title: 'Your work has been saved',
        showConfirmButton: false,
        timer: 3000,
        background: 'rgba(52, 181, 58, 0.2)',
        backdrop: false,
    }) --}}
@endif
