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
    <td>ini foto</td>
    <td>{{$vs->donatur->nama_donatur}}</td>
    <td>{{$vs->berat}}</td>
    <td>foto minyak</td>
    <td>{{$vs->tanggal}}</td>
    <td>{{$vs->poin_reward}}</td>
    <td>{{$vs->status}}</td>
    <td><a href="{{route('sumbangan.edit',$vs->id_sumbangan)}}">edit</a> 
</tr>
@empty
<h1>datakosong</h1>
@endforelse
</table>
</body>
</html>
