<html>
    <body>
        <form enctype="multipart/form-data" method="POST" action="{{route('admin.store')}}">
            @csrf
            <input type='text' name='name'> <!--harus pake select-->
            <input type='text' name='id_lokasi'>
            <input type='text' name='alamat_rumah'>
            <input type='text' name='no_hp'>
            <input type='text' name='username'>
            <input type='text' name='password'>
            <button type="submit">submit</button>
        </form>
    </body>
</html>
