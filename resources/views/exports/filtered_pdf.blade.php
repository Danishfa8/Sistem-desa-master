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
<h2>Data Terfilter {{ $categoryName }}</h2>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Kecamatan</th>
                <th>Desa</th>
                <th>RT</th>
                <th>RW</th>
                <th>Jenis Data</th>
                @if(isset($data[0]->nama_kelompok_olahraga))
                    <th>Nama Kelompok</th>
                @endif
                <th>Tahun</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $i => $item)
            <tr>
                <td>{{ $i + 1 }}</td>
                <td>{{ $item->nama_kecamatan }}</td>
                <td>{{ $item->nama_desa }}</td>
                <td>{{ $item->rt }}</td>
                <td>{{ $item->rw }}</td>
                <td>{{ $item->jenis }}</td>
                @if(isset($item->nama_kelompok_olahraga))
                    <td>{{ $item->nama_kelompok_olahraga }}</td>
                @endif
                <td>{{ $item->tahun }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
