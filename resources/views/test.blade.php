<!DOCTYPE html>
<html>
<head>
    <title>Tess</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }
        
        h1 {
            font-size: 24px;
            text-align: center;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>Testt</h1>
    <p>Date: 17 Oktober 2023</p>
    <table>
        <thead>
            <tr>
              <th>No</th>
              <th>Berat</th>
              <th>Status</th>
              <th>Keterangan</th>
              <th>poin_reward</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($sumbangan as $key => $item)
            <tr>
              <td>{{ ++$key }}</td>
              <td>{{ $item->berat }}</td>
              <td>{{ $item->status }}</td>
              <td>{{ $item->keterangan }}</td>
              <td>{{ $item->poin_reward }}</td>
          </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>