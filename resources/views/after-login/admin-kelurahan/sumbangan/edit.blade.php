<html>
    <body>
        <form enctype="multipart/form-data" method="POST" action="{{route('sumbangan.update', $sumbangan->id_sumbangan)}}">
            @csrf
            @method('put')
            <input type='text' name='id_donatur' value ="{{$sumbangan->id_donatur}}">
            <input type='text' name='id_kontainer' value ="{{$sumbangan->id_kontainer}}">
            <input type='text' name='tanggal' value ="{{$sumbangan->tanggal}}">
            <input type='text' name='berat' value ="{{$sumbangan->berat}}">
            <input type='text' name='photo' value ="{{$sumbangan->photo}}">
            <input type='text' name='status' value ="{{$sumbangan->status}}">
            <input type='text' name='poin_reward' value ="{{$sumbangan->poin_reward}}">
            <button type="submit">submit</button>
        </form>
    </body>
</html>
