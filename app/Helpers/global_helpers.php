<?php

use Illuminate\Support\Facades\Auth;


if (!function_exists('tgl_indo')) {
    function tgl_indo($tanggal)
    {
        $bulan = array (
            1 =>   'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember'
        );
	$pecahkan = explode('-', $tanggal);
 
	return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
    }
}

if (!function_exists('hari_indo')) {
    function hari_indo($tanggal)
    {
        $hari = array (
            1 =>   'Senin',
            'Selasa',
            'Rabu',
            'Kamis',
            'Jumat',
            'Sabtu',
            'Minggu'
        );
	$pecahkan = explode('-', $tanggal);
 
	return $hari[2];
    }
}

if (!function_exists('MasterJawaban')) {
    function MasterJawaban($id_master_pertanyaan)
    {
        return DB::table('master_jawaban')->where('id_pertanyaan', $id_master_pertanyaan)->orderBy('id', 'ASC')->get();
    }
}

if (!function_exists('KuesionerInput')) {
    function KuesionerInput($id_master_pertanyaan)
    {
        return DB::table('kuesioner')->where('id_master_pertanyaan', $id_master_pertanyaan)->whereNotNull('input_jawaban')->get();
    }
}

if (!function_exists('PresentasePilih')) {
    function PresentasePilih($id_master_pertanyaan, $id_master_jawaban)
    {

        $jawaban = DB::table('kuesioner')->where('id_master_pertanyaan', $id_master_pertanyaan)->where('id_master_jawaban', $id_master_jawaban)->count();

        $total = DB::table('kuesioner')->where('id_master_pertanyaan', $id_master_pertanyaan)->count();

        return round(($jawaban / $total) * 100, 2) . " %";
    }
}

if (!function_exists('checkKuesionerIsFilled')) {

    function checkKuesionerIsFilled($layanan)
    {
        if (Auth::guard('pengguna')->user() != null) {
            return DB::table('tiket')
                // ->where('status', 2)
                // ->where('kategori', $layanan)
                ->where('id_pengguna', Auth::guard('pengguna')->user()->id)
                ->whereNull('kuesioner')
                ->orderBy('tanggal', 'DESC')
                ->first();
        } 
        
        
    }
}

if (!function_exists('checkKuesionerTiketIsFilled')) {

    function checkKuesionerTiketIsFilled()
    {
        return DB::table('tiket')
                ->where('status', 2)
                ->where('id_pengguna', Auth::guard('pengguna')->user()->id)
                ->whereNull('kuesioner')
                ->orderBy('tanggal', 'DESC')
                ->first();
    }
}

if (!function_exists('getNamaPengguna')) {

    function getNamaPengguna($id_user)
    {
        $data = DB::table('users_pengguna')->where('id', $id_user)->first();
        
        if ($data) {
            return $data->nama;
        } else {
            return '';
        }
    }
}

if (!function_exists('getNoTiket')) {

    function getNoTiket($id_tiket)
    {
        $data = DB::table('tiket')->where('id', $id_tiket)->first();

        if ($data) {
            return $data->no_tiket;
        } else {
            return '';
        }
    }
}

if (!function_exists('CountAduan')) {

    function CountAduan()
    {
        $data = DB::table('pengaduan')
            ->where('status', 0)
            ->count();
        if ($data) {
            return $data;
        } else {
            return '';
        }
    }
}

if(! function_exists('getServiceLoginPengguna')){

    function getServiceLoginPengguna($email, $password){
        $url = env('API_SIGESIT_URL').'/api/login';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POSTFIELDS,"email=".$email."&password=".$password."");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $res = curl_exec($ch);
        curl_close ($ch);
        $result = json_decode($res);

        return isset($result->access_token) ? $result->access_token : NULL;
    }
}

if(! function_exists('getServiceLoginInternal')){

    function getServiceLoginInternal($email, $password){
        $url = env('API_SIGESIT_URL').'/api/login';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$url);
        curl_setopt($ch, CURLOPT_POSTFIELDS,"email=".$email."&password=".$password."");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $res = curl_exec($ch);
        curl_close ($ch);
        $result = json_decode($res);

        return isset($result->data) ? $result->data : NULL;
    }
}

if(! function_exists('sendEmailApi')){
    function sendEmailApi($email, $subject, $content){
        $postData = [
            'receiver'  => $email,
            'subject'   => $subject,
            'content'   => $content
        ];
        $username = env('NO_REPLY_USERNAME');
        $password = env('NO_REPLY_PASSWORD');
        $url = env('NO_REPLY_URL');
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, 1);
        curl_setopt($ch, CURLOPT_USERPWD, $username . ":" . $password);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postData));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
        $result = curl_exec($ch);
        curl_close($ch);
    }
}


if(! function_exists('getDiklatFromSimdiklat')){
    function getDiklatFromSimdiklat($id_diklat){
        $url = env('API_SIMPLE_URL')."get-kelas-diklat-by-id?id=".$id_diklat."";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Authorization: Bearer '.env('API_SIMPLE_AUTH').'',
            'Content-Type: application/json'
        ]);
        $data = json_decode(curl_exec($ch));
        $result = $data->content;
        curl_close($ch);

        return $result;
    }
}
