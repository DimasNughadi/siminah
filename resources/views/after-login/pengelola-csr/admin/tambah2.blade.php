<html>
    <body>
        <form enctype="multipart/form-data" method="POST" action="{{route('admin.store')}}">
            @csrf
            nama
            <input type='text' name='name'> <!--harus pake select-->
            lokasi
            <input type='text' name='id_lokasi'>
            alamat
            <input type='text' name='alamat_rumah'>
            no hp
            <input type='text' name='no_hp'>
            username
            <input type='text' name='username'>
            email
            <input type='text' name='email'>
            <button type="submit">submit</button>
        </form>
    </body>
</html>
