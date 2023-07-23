<html>
    <body>
        <form enctype="multipart/form-data" method="POST" action="{{route('kontainer.store')}}">
            @csrf
            <input type='text' name='id_lokasi'> <!--harus pake select-->
            <input type='number' name='kapasitas'>
            <input type='text' name='keterangan'>
            <button type="submit">submit</button>
        </form>
    </body>
</html>
