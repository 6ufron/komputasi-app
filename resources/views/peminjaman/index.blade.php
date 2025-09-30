<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nama Pengguna</th>
            <th>Tanggal Pinjam</th>
            <th>Tanggal Kembali</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($peminjaman as $item)
            <tr>
                <td>{{ $item->id_peminjaman }}</td>
                <td>{{ $item->user->name }}</td>
                <td>{{ $item->tanggal_pinjam }}</td>
                <td>{{ $item->tanggal_kembali ?? 'Belum dikembalikan' }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
