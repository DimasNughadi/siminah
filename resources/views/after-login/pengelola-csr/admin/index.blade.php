<html><body>
<a href="{{route('admin.create')}}">tambah</a>
<table>
  <tr>
    <th>id admin</th>
    <th>nama</th>
    <th>lokasi</th>
    <th>alamat</th>
    <th>no hp</th>
    <th>username</th>
    <th>password</th>
    <th>aksi</th>
  </tr>
  @forelse ($user as $u)
  <tr>
    <td>{{$u->id_admin_kelurahan}}</td>
    <td>{{$u->name}}</td>
    <td>{{$u->nama_kelurahan}}</td>
    <td>{{$u->alamat_rumah}}</td>
    <td>{{$u->no_hp}}</td>
    <td>{{$u->username}}</td>
    <td>{{$u->password}}</td>
    <td><a href="{{route('admin.edit',$u->id_admin_kelurahan)}}">edit</a> 
    <form method="POST" action="{{route('admin.destroy',$u->id_admin_kelurahan)}}">@csrf @method('DELETE')<button type="submit">hapus</button></form>
  </td>
</tr>
@empty
<h1>datakosong</h1>
@endforelse
</table>
</body>
</html>
