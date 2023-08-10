<html><body>
<a href="{{route('lokasi.create')}}">tambah</a>
<table>
  <tr>
    <th>id</th>
    <th>nama kelurahan</th>
    <th>latitude</th>
    <th>longixtude</th>
    <th>deskripsi</th>
    <th>aksi</th>
  </tr>
  @forelse ($lokasi as $ls)
  <tr>
    <td>{{$ls->id_lokasi}}</td>
    <td>{{$ls->nama_kelurahan}}</td>
    <td>{{$ls->latitude}}</td>
    <td>{{$ls->longitude}}</td>
    <td>{{$ls->deskripsi}}</td>
    <td><a href="{{route('lokasi.edit',$ls->id_lokasi)}}">edit</a> 
    <form method="POST" action="{{route('lokasi.destroy',$ls->id_lokasi)}}">@csrf @method('DELETE')<button type="submit">hapus</button></form>
  </td>
</tr>
@empty
<h1>datakosong</h1>
@endforelse
</table>
</body>
</html>
