<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #000; padding: 6px; text-align: left; }
    </style>
</head>
<body>
    <h2>Data Terfilter</h2>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Kategori</th>
                <th>Desa</th>
                <th>RT/RW</th>
                <th>Jenis</th>
                <th>Status</th>
                <th>Tanggal Approve</th>
                <th>Created By</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $i => $item)
                <tr>
                    <td>{{ $i+1 }}</td>
                    <td>{{ $item->id_kategori }}</td>
                    <td>{{ $item->desa_id }}</td>
                    <td>{{ $item->rt_rw_desa_id }}</td>
                    <td>{{ $item->jenis }}</td>
                    <td>{{ $item->status }}</td>
                    <td>{{ $item->approved_at }}</td>
                    <td>{{ $item->created_by }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
