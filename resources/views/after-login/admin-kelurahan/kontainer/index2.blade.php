<html><body>
<a href="{{route('kontainer.create')}}">tambah</a>
<table>
  <tr>
    <th>id kontainer</th>
    <th>nama_kelurahan</th>
    <th>kapasitas saat ini</th>
    <th>kapasitas</th>
    <th>keterangan</th>
    <th>aksi</th>
  </tr>
  @forelse ($kontainer as $kn)
  <tr>
    <td>{{$kn->id_kontainer}}</td>
    <td>{{$kn->lokasi->nama_kelurahan}}</td>
    <td>{{$kn->sumbangan_sum_berat}}</td>
    <td>{{$kn->kapasitas}}</td>
    <td>{{$kn->keterangan}}</td>
    <td><a href="{{route('kontainer.edit',$kn->id_kontainer)}}">edit</a> 
    <form method="POST" action="{{route('kontainer.destroy',$kn->id_kontainer)}}">@csrf @method('DELETE')<button type="submit">hapus</button></form>
  </td>
</tr>
@empty
<h1>datakosong</h1>
@endforelse
</table>
</body>
</html>
