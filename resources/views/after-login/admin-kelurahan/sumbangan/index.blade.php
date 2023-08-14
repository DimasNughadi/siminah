<html><body>
<table>
  <tr>
    <th>photo donatur</th>
    <th>nama donatur</th>
    <th>yang mau disumbang</th>
    <th>photo sumbangan</th>
    <th>tanggal</th>
    <th>poin reward</th>
    <th>status</th>
    <th>aksi</th>
  </tr>
  @forelse ($verifikasiStatus as $vs)
  <tr>
    <td>{{$vs->donatur->photo}}</td>
    <td>{{$vs->donatur->nama_donatur}}</td>
    <td>{{$vs->berat}}</td>
    <td>{{$vs->photo}}</td>
    <td>{{$vs->tanggal}}</td>
    <td>{{$vs->poin_reward}}</td>
    <td>{{$vs->status}}</td>
    <td><a href="{{ route('sumbangan.edit', ['id' => $vs->id_donatur, 'created_at' => $vs->created_at]) }}">edit</a></td> <!-- harusnya id_sumbangan -->
</tr>
@empty
<h1>datakosong</h1>
@endforelse
</table>
Persentase telah diverifikasi : {{$persentase}}
</body>
</html>
