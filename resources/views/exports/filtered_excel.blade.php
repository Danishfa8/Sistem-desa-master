<tr><td colspan="8"><strong>Data Terfilter {{ $categoryName }}</strong></td></tr>
<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Kecamatan</th>
            <th>Desa</th>
            <th>RT</th>
            <th>RW</th>
            <th>Jenis</th>
            @if(isset($data[0]->nama_kelompok_olahraga))
                <th>Nama Kelompok</th>
            @endif
            <th>Tahun</th>
        </tr>
    </thead>
    <tbody>
        @foreach($data as $i => $item)
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
