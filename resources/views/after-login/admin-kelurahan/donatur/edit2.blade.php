<html>
    <body>
        <form enctype="multipart/form-data" method="POST" action="{{route('donatur.update', $donatur->id_donatur)}}">
            @csrf
            @method('put')
            <input type='text' name='no_hp'>
            <input type='text' name='nama_donatur'>
            <input type='text' name='alamat_donatur'>
            <input type='text' name='kelurahan'>
            <input type='file' name='photo'>
            <input type='text' name='password'>
            <button type="submit">submit</button>
        </form>
    </body>
</html>
