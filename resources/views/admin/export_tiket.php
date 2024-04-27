<?php
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Rekap_Tiket.xls");
?>
<style>
    table {
        border-collapse: collapse;
    }

    table,
    th,
    td {
        border: 1px solid black;
    }
</style>

<table>
    <thead>
        <tr>
            <th>Kategori</th>
            <th>User Pengguna</th>
            <th>Jenis Instansi</th>
            <th>Instansi</th>
            <th>No. Tiket</th>
            <th>Tanggal</th>
        </tr>
    </thead>
    <tbody>
        @forelse($rekap_tiket as $rt)
        <tr>
            <td>{{$rt->kategori}}</td>
            <td>{{$rt->nama}}</td>
            <td>{{!empty($rt->jenis_instansi)?$rt->jenis_instansi: '-'}}</td>
            <td>{{!empty($rt->instansi)?$rt->instansi: '-'}}</td>
            <td>{{$rt->no_tiket}}</td>
            <td>{{$rt->tanggal}}</td>
        </tr>
        @empty
        <tr>
            <td colspan="4" style="text-align:center;">Belum ada Transaksi</td>
        </tr>
        @endforelse
    </tbody>
</table>