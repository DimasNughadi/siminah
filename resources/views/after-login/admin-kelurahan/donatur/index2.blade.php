<html><body>
<a href="{{route('donatur.create')}}">tambah</a>
<table>
  <tr>
    <th>id</th>
    <th>no hp</th>
    <th>nama donatur</th>
    <th>alamat donatur</th>
    <th>kelurahan</th>
    <th>photo</th>
    <th>password</th>
    <th>aksi</th>
  </tr>
  @forelse ($donatur as $dn)
  <tr>
    <td>{{$dn->id_donatur}}</td>
    <td>{{$dn->no_hp}}</td>
    <td>{{$dn->nama_donatur}}</td>
    <td>{{$dn->alamat_donatur}}</td>
    <td>{{$dn->kelurahan}}</td>
    <td>{{$dn->photo}}</td>
    <td>{{$dn->password}}</td>
    <td><a href="{{route('donatur.edit',$dn->id_donatur)}}">edit</a> 
    <form method="POST" action="{{route('donatur.destroy',$dn->id_donatur)}}">@csrf @method('DELETE')<button type="submit">hapus</button></form>
  </td>
</tr>
@empty
<h1>datakosong</h1>
@endforelse
</table>
</body>
</html>
