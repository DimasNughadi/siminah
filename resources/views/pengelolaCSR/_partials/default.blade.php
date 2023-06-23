<!DOCTYPE html>
<html lang="en">

@include('pengelolaCSR._partials.header')

<body class="g-sidenav-show  bg-gray-200">

	@include('pengelolaCSR._partials.sidebar')

	<main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">

		@include('pengelolaCSR._partials.navbar')

		<div class="container-fluid">

			@yield('content')

			@include('pengelolaCSR._partials.footer')

		</div>

	</main>

	@include('pengelolaCSR._partials.scripts')
  
</body>

</html>