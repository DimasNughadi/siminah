<!DOCTYPE html>
<html lang="en">

@include('pengelolaCSR._partials.header')

<body class="login" data-mdb-animation-start="onLoad">

	<main class="main-content">

		<section class="login-page container-fluid">
            <div class="row">
                <div class="col-md-4 ps-4">
                    <div class="row mt-6 ps-4">
                        <div class="col-md-5">
                            <img class="navbar-brand-img" src="{{ asset('siminah-logo.png') }}" alt="Logo pertamina" width="372" height="47">
                        </div>

                        <div class="col-md-12 mt-6 ps-4 animate__animated animate__fadeInUp">
                            <h1 class="login-header-color .login-fs-header">Sign Into</h1>
                            <h4 class="mt-2 login-header-color .login-fs-subheader">Your Account</h6>
                        </div>

                        <div class="col-md-12 mt-5 animate__animated animate__fadeInUp">
                            <div class="inputContainer">  
                                <i class="fa fa-briefcase icon"></i>
                                <input type="text" class="Field form-control" placeholder="Username" name="username">
                            </div>
                        </div>

                        <div class="col-md-12 mt-5 animate__animated animate__fadeInUp">
                            <div class="inputContainer">
                                <i class="fa fa-lock icon"></i>
                                <input type="password" class="Field form-control" placeholder="Password" name="password">
                            </div>
                        </div>

                        <div class="col-md-12 mt-4 form-check animate__animated animate__fadeInUp">
                            <input class="form-check-input" type="checkbox" value="" id="remember" name="username">
                            <label class="form-check-label" for="remember">
                                Remember Me
                            </label>    
                        </div>

                        <div class="col-md-12 mt-4 animate__animated animate__fadeInUp login-bottom">
                            <button type="submit" class="btn-custom btn-login">Sign in</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-8 bg-pertamina" style="background-image: url('{{ asset('bg-pertamina.jpg') }}')">
                </div>
            </div>
        </section>

      </main>

	@include('pengelolaCSR._partials.scripts')

</body>

</html>