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

Notifikasi
<table>
@forelse ($notifikasi as $n)
<tr>
<td>Kontainer utama {{$n['status']}}</td></tr>
@empty
@endforelse
</table>

Permintaan
<table>
  <thead><td>waktu permintaan</td><td>status</td></thead>
@forelse ($permintaan as $p)
<tr>
<td>{{$p->created_at}}</td>
<td>{{$p->status_permintaan}}</td>
<td>
  <form method="POST" action="{{route('kontainer.storePermintaan',$id_kontainer)}}">@csrf<button type="submit">ajukan</button></form>
</td>
</tr>

@empty
@endforelse
</table>
</body>
</html>
