<html>
    <body>
        <form enctype="multipart/form-data" method="POST" action="{{route('lokasi.store')}}">
            @csrf
            <input type='text' name='nama_kelurahan'>
            <input type='text' name='latitude'>
            <input type='text' name='longitude'>
            <input type='text' name='deskripsi'>
            <button type="submit">submit</button>
        </form>
    </body>
</html>