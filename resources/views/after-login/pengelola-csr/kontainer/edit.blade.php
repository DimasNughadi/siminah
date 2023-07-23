<html>
    <body>
        <form enctype="multipart/form-data" method="POST" action="{{route('kontainer.update', $kontainer->id_kontainer)}}">
            @csrf
            @method('put')
            <input type='text' name='id_lokasi' value="{{$kontainer->id_lokasi}}"> <!--harus pake select-->
            <input type='number' name='kapasitas' value="{{$kontainer->kapasitas}}">
            <input type='text' name='keterangan'>
            <button type="submit">submit</button>
        </form>
    </body>
</html>
