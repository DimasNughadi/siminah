<!DOCTYPE html>
<html lang="en">

@include('pengelolaCSR._partials.header')

<body data-mdb-animation-start="onLoad">

	<main class="main-content">

		<div class="container">
            <x-progressBar value="24" max=50 type="donatur" color="red"/>
        </div>

    </main>

	@include('pengelolaCSR._partials.scripts')

</body>

</html>