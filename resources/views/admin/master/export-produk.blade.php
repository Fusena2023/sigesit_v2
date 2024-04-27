<?php
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Produk.xls");
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
            <th>Nama Produk</th>
            <th>Satuan</th>
            <th>Tarif</th>
            <th>Stok Awal</th>
            <th>Stok Baik</th>
            <th>Stok Rusak</th>
        </tr>
    </thead>
    <tbody>
        @foreach($data as $val)
        <tr>
            <td>{{ $val->nama_produk }}</td>
            <td>{{ $val->nama }}</td>
            <td>{{ $val->tarif }}</td>
            <td>{{ $val->stok_awal }}</td>
            <td>{{ $val->stok_baik }}</td>
            <td>{{ $val->stok_rusak }}</td>
        </tr>
        @endforeach
    </tbody>
</table>