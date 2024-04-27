<?php
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Tiket.xls");
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
            <th>No Tiket</th>
            <th>Tanggal</th>
            <th>Waktu</th>
            <th>Kategori</th>
            <th>Sub Kategori</th>
            <th>Nama Pengguna</th>
            <th>Kuesioner</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        @forelse($data as $rt)
        <tr>
            <td>{{$rt->no_tiket}}</td>
            <td>{{$rt->tanggal}}</td>
            <td>{{$rt->mulai}}</td>
            <td>{{$rt->kategori}}</td>
            <td>
                @if($rt->kategori == 'jasa')
                   {{$rt->nama_layanan_jasa}} 
                @elseif($rt->kategori == 'produk')
                'Peta'
                @elseif($rt->kategori == 'pasut')
                'Pasang Surut'
                @endif
            </td>
            <td>{{!empty($rt->nama)?$rt->nama: '-'}}</td>
            <td>
                @if($rt->kuesioner == null)
                Belum Mengisi
                @else
                Sudah Mengisi
                @endif
            </td>
            <td>
                @if($rt->status == 1)
                   Open
                @elseif($rt->status == 2)
                Closed
                @elseif($rt->status == 3)
                Menunggu Verifikasi
                @elseif($rt->status == 4)
                Di Tolak
                @endif
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="6" style="text-align:center;">Belum ada Transaksi</td>
        </tr>
        @endforelse
    </tbody>
</table>