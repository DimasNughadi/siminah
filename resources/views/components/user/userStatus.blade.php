<div class="user-status-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 col-12">
                <div class="row">
                    <div class="col-md-6 col-sm-6 col-6">
                        <a href="#">
                            <div class="row">
                                <div class="col-md-6 col-sm-6 col-6 image">
                                    <x-user.userImage />
                                    <div class="aktif"></div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-6 name">
                                    <span>Jim</span>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-3 col-sm-3 col-3 icon">
                        <span onclick="Logout()" class="material-symbols-outlined">
                            logout
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@extends('components._partials.scripts')
@section('script')
    <script>
        function Logout() {
            Swal.fire({
                title: 'Apakah ingin keluar?',
                text: "Anda akan dimintai login kembali",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Logout'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire(
                        'Logout sukses',
                        'Halaman akan di redirect ke login',
                        'success'
                    )
                }
            })
        }
    </script>

    <script>
        
    </script>
@endsection
