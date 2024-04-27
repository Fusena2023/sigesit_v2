<?php
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Kuesioner.xls");
?>
<style>
table {
  border-collapse: collapse;
}

table, th, td {
  border: 1px solid black;
}
</style>

<table >
    <thead>
        <tr>
            <th>Timestamp</th>
            <th>Email</th>
            <th>Nama</th>
            <th>Jenis Kelamin</th>
            <th>Perwakilan</th>
            <th>Jika mewakili Instansi, mohon sebutkan Instansinya</th>
            <th>Jabatan di Instansi terkait</th>
            <th>No. HP</th>
            <th>Pendidikan Terakhir</th>
            <th>Pekerjaan</th>
            <th>Perolehan Layanan</th>
            <th>1. Pelayanan Terpadu Informasi Geospasial (PTIG)</th>
            @foreach($pusat as $pus)
            <th>{{$no++}} {{ $pus->nama_pusat }}</th>
            @endforeach
            @foreach($pertanyaan as $key => $p)
            <th>{{$key+1}}a. {{ $p->pertanyaan }}</th>
            @endforeach
            @foreach($pertanyaan as $key => $p)
            <th>{{$key+1}}b. {{ $p->pertanyaan }}</th>
            @endforeach
        </tr>
    </thead>
    <tbody>
        @if(is_countable($tiket) && count($tiket) > 0)
            @foreach($tiket as $val)
            <?php
                $kondisi = DB::table('kuesioner')->where('id_user', $val->id_pengguna)->where('id_tiket', $val->id_terkait)->first();
                if(!empty($kondisi)){
                    $tanya = DB::table('master_pertanyaan')->where('id', $kondisi->id_master_pertanyaan)->first();
                }else{
                    $tanya = array();
                }
            ?>
            {{-- @if(!empty($tanya))
                @if($tanya->kategori == $kategori) --}}
                <tr>
                    <td>{{ $val->tanggal }}</td>
                    <td>{{ $val->email }}</td>
                    <td>{{ $val->nama }}</td>
                    <td>@if($val->jenis_kelamin=='1') Laki-Laki @elseif($val->jenis_kelamin=='2') Perempuan @else Jenis Kelamin Kosong @endif</td>
                    <td>{{ ($val->instansi)? 'Instansi':'Perorangan'}}</td>
                    <td>{{ $val->instansi }}</td>
                    <td>{{ ($val->instansi)? $val->jabatan : '' }}</td>
                    <td>{{ $val->no_telp }}</td>
                    <td>{{ $val->pendidikan }}</td>
                    <td>{{ $val->pekerjaan }}</td>
                    <td>{{ $val->perolehan_pelayanan }}</td>
                    <td>{{ ($val->kategori=='produk')? 'Pembelian Peta Cetak':'' }}</td>
                    @foreach($pusat as $pus)
                        <?php $layanan_jasa = DB::table('master_layanan_jasa')->where('id_pusat', $pus->id)->where('id', $val->id_master_layananjasa)->first(); ?>
                        <td>{{ !empty($layanan_jasa->nama_layanan_jasa)? $layanan_jasa->nama_layanan_jasa : '' }}</td>
                    @endforeach
                    @foreach($pertanyaan as $pa)
                        <?php $k = DB::table('kuesioner')->where('id_user', $val->id_pengguna)->where('id_tiket', $val->id_terkait)->where('id_master_pertanyaan',$pa->id)->first(); ?>
                        <td>{{ !empty($k->tingkat_kepuasan) ? $k->tingkat_kepuasan : '-' }}</td>
                    @endforeach
                    @foreach($pertanyaan as $pb)
                        <?php $k = DB::table('kuesioner')->where('id_user', $val->id_pengguna)->where('id_tiket', $val->id_terkait)->where('id_master_pertanyaan',$pb->id)->first(); ?>
                        <td>{{ !empty($k->tingkat_kepentingan) ? $k->tingkat_kepentingan :'-' }}</td>
                    @endforeach
                </tr>
                {{-- @endif
            @else
                <tr>
                    <td colspan="13">Belum ada Transaksi</td>
                </tr>
            @endif --}}
            @endforeach
        @else
            <tr>
                <td colspan="8" style="text-align:center;">Belum ada Transaksi</td>
            </tr>
        @endif
    </tbody>
</table>