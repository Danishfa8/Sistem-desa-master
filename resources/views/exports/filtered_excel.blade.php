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
            <th>Dibuat Oleh</th>
        </tr>
    </thead>
    <tbody>
        @foreach($data as $i => $item)
        <tr>
            <td>{{ $i + 1 }}</td>
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
