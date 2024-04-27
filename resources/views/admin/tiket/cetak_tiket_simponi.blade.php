<html>

<head>
    <meta name="google" content="notranslate">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style type="text/css">
    @page {
        margin: 20px;
    }

    body {
        margin: 0px;
        color:black;
        padding: 30px;
    }

    table.background {}

    * {
        font-family: "Times New Roman", Times, serif;
    }

    a {
        color: #fff;
        text-decoration: none;
    }

    table {
        font-size: x-small;
    }

    tfoot tr td {
        font-weight: bold;
        font-size: x-small;
    }

    body img {
        vertical-align: middle;
        /* opacity: 0.5; */
    }

    .invoice table {
        margin: 15px;
    }

    .invoice h3 {
        margin-left: 15px;
    }

    .information {
        background-color: #fff;
        padding-bottom: 10px;
    }

    .information .logo {}

    .information table {
        padding: 0px;
    }

    #watermark {
        position: fixed;
        top: 45%;
        width: 100%;
        text-align: center;
        opacity: .6;
        z-index: -1000;
        font-size: 5em;

    }
    </style>

</head>
<body>
    <div class="information">
        <table width="100%">
            <tbody>
                <tr>
                    <td align="right" style="width:10%">
                        <img src="{{ asset('assets/logo.gif') }}" alt="" class="logo" height="80" width="80">
                    </td>
                    <td>
                        <h3>Kementerian Keuangan RI<br>
                            Direktorat Jenderal Anggaran<br>
                            SISTEM INFORMASI PNBP ONLINE (SIMPONI)</h3>
                    </td>
                    <td align="left" style="width:10%">
                        <img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->merge('assets/logo.gif', 0.4, true)->size(500)->errorCorrection('H')->generate('Brayen Prayoga')) !!} "
                            style="width: 2cm;">
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td align="center" style="width: inherit;">
                        <center>
                            <h3>BUKTI PEMBUATAN TAGIHAN<br>PENERIMAAN NEGARA BUKAN PAJAK (PNBP)</h3>
                        </center>
                    </td>
                    <td></td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="information">
        <!-- SECTION A -->
        <table width="100%">
            <tbody>
                <tr>
                    <td colspan="4">
                        <span>Data Pembayaran Tagihan :</span>
                    </td>
                </tr>
                <tr>
                    <td style="width: 2%;"></td>
                    <td style="width: 25%;">Kode Billing</td>
                    <td style="width: 6%;">:</td>
                    <td style="width: 50%;"></td>
                </tr>
                <tr>
                    <td style="width: 2%;"></td>
                    <td style="width: 25%;">Tanggal Billing</td>
                    <td style="width: 6%;">:</td>
                    <td style="width: 50%;"></td>
                </tr>
                <tr>
                    <td style="width: 2%;"></td>
                    <td style="width: 25%;">Tanggal Kedaluwarsa</td>
                    <td style="width: 6%;">:</td>
                    <td style="width: 50%;"></td>
                </tr>
                <tr>
                    <td style="width: 2%;"></td>
                    <td style="width: 25%;">Tanggal Bayar</td>
                    <td style="width: 6%;">:</td>
                    <td style="width: 50%;"></td>
                </tr>
                <tr>
                    <td style="width: 2%;"></td>
                    <td style="width: 25%;">Bank/Pos/Fintech Bayar</td>
                    <td style="width: 6%;">:</td>
                    <td style="width: 50%;"></td>
                </tr>
                <tr>
                    <td style="width: 2%;"></td>
                    <td style="width: 25%;">Channel Bayar</td>
                    <td style="width: 6%;">:</td>
                    <td style="width: 50%;"></td>
                </tr>
                <tr>
                    <td style="width: 2%;"></td>
                    <td style="width: 25%;">Nama Wajib Setor/Wajib Bayar</td>
                    <td style="width: 6%;">:</td>
                    <td style="width: 50%;"></td>
                </tr>
                <tr>
                    <td style="width: 2%;"></td>
                    <td style="width: 25%;">Kementerian/Lembaga</td>
                    <td style="width: 6%;">:</td>
                    <td style="width: 50%;"></td>
                </tr>
                <tr>
                    <td style="width: 2%;"></td>
                    <td style="width: 25%;">Unit Eselon I</td>
                    <td style="width: 6%;">:</td>
                    <td style="width: 50%;"></td>
                </tr>
                <tr>
                    <td style="width: 2%;"></td>
                    <td style="width: 25%;">Satuan Kerja</td>
                    <td style="width: 6%;">:</td>
                    <td style="width: 50%;"></td>
                </tr>
                <tr>
                    <td style="width: 2%;"></td>
                    <td style="width: 25%;">Total Disetor</td>
                    <td style="width: 6%;">:</td>
                    <td style="width: 50%;"></td>
                </tr>
                <tr>
                    <td style="width: 2%;"></td>
                    <td style="width: 25%;">Terbilang</td>
                    <td style="width: 6%;">:</td>
                    <td style="width: 50%;"></td>
                </tr>
                <tr>
                    <td style="width: 2%;"></td>
                    <td style="width: 25%;">Status</td>
                    <td style="width: 6%;">:</td>
                    <td style="width: 50%;"></td>
                </tr>
                <tr>
                    <td style="width: 2%;"></td>
                    <td style="width: 25%;"><b>NTB</b></td>
                    <td style="width: 6%;">:</td>
                    <td style="width: 50%;"></td>
                </tr>
                <tr>
                    <td style="width: 2%;"></td>
                    <td style="width: 25%;"><b>NTPN</b></td>
                    <td style="width: 6%;">:</td>
                    <td style="width: 50%;"></td>
                </tr>
            </tbody>
        </table>
    </div>
    
    <div class="information">
        <!-- SECTION A -->
        <table width="100%">
            <tbody>
                <tr>
                    <td colspan="4">
                        <span>Detail Pembayaran Tagihan :</span>
                    </td>
                </tr>
                <tr>
                    <td style="width: 2%;"></td>
                    <td style="width: 25%;">Jenis Setoran</td>
                    <td style="width: 6%;">:</td>
                    <td style="width: 50%;"></td>
                </tr>
                <tr>
                    <td style="width: 2%;"></td>
                    <td style="width: 25%;">Kode Akun</td>
                    <td style="width: 6%;">:</td>
                    <td style="width: 50%;"></td>
                </tr>
                <tr>
                    <td style="width: 2%;"></td>
                    <td style="width: 25%;">Jumlah Setoran</td>
                    <td style="width: 6%;">:</td>
                    <td style="width: 50%;"></td>
                </tr>
                <tr>
                    <td style="width: 2%;"></td>
                    <td style="width: 25%;">Keterangan</td>
                    <td style="width: 6%;">:</td>
                    <td style="width: 50%;"></td>
                </tr>
            </tbody>
        </table>
    </div>
    
    <div class="information">
        <!-- SECTION A -->
        <table width="100%">
            <tbody>
                <tr>
                    <td colspan="4">
                        <span>Ketentuan pembayaran tagihan :</span>
                    </td>
                </tr>
                <tr>
                    <td colspan="4">
                        <ol>
                            <li>Pembayaran hanya dapat dilakukan sebelum tanggal kedaluwarsa. Jika tanggal kedaluwarsa telah tercapai, billing
                                receipt ini tidak berlaku lagi, dan Anda diminta mengakses SIMPONI untuk melakukan pengisian data pembayaran
                                kembali.</li>
                            <li>Cara pembayaran dapat melalui berbagai macam payment channel seperti Over The Counter bank/pos persepsi, ATM,
                                Internet Banking, EDC (sesuai dengan fasilitas yang dimiliki oleh bank/pos persepsi), dan Dompet Elektronik fintech.</li>
                            <li>Bawalah Bukti Pembuatan Tagihan (Billing Receipt) ini ke tempat-tempat yang telah disebutkan di atas. Kode
                                referensi untuk pembayaran adalah kode billing sesuai yang tertera di dokumen ini.</li>
                            <li>Pastikan dokumen ini atau hasil cetakannya dibawa apabila Anda akan melakukan pembayaran</li>
                            <li>Pastikan bahwa data detail pembayaran dalam dokumen ini sama dengan data yang tertera/tercantum ketika Anda
                                akan melakukan pembayaran. Apabila terjadi ketidakcocokan data, teliti apakah kode billing yang Anda masukkan
                                sudah sesuai.</li>
                            <li>Apabila pembayaran berhasil, Anda akan menerima Tanda Bukti Setor atau struk dari Bank atau payment channel.
                                Anda juga akan menerima Bukti Penerimaan Negara (BPN) yang akan dikirim ke akun SIMPONI dan email anda.</li>
                            <li>Simpanlah Tanda Bukti Setor/struk/BPN untuk dipergunakan sebagaimana mestinya.</li>
                            <li>Tata cara pembayaran dapat diakses pada website https://penerimaan-negara.info dan http://bit.ly/infobayarMPNG2</li>
                            <li>Untuk pertanyaan yang berkaitan dengan pembayaran dan status billing dapat menghubungi HAI DJPb di 14090 atau
                                KPPN Khusus Penerimaan di (021) 3840516</li>
                            <li>Apabila mengalami gangguan pada Aplikasi SIMPONI atau membutuhkan bantuan, hubungi call center Ditjen
                                Anggaran di nomor 14090 Ext. 2 atau melalui email ke sapa.anggaran@kemenkeu.go.id (Billing DJA).</li>
                        </ol>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="information" style="position:absolute; bottom:0;padding-right:30px;">
        <table width="100%">
            <tbody>
                <?php date_default_timezone_set("Asia/Bangkok"); ?>
                <tr>
                    <td colspan="4" style="width: inherit; border-bottom:1px solid #000; border-top:1px solid #000;">
                        <center></center>
                    </td>
                </tr>
                <tr>
                    <td align="left" style="width: 40%;">
                        <b><i>Tanggal Cetak : {{ date("d/m/Y H:i:s", time()) }} WIB</i></b>
                    </td>
                    <td style="width: 20%;">
                        <center><b><i>1/1</i></b></center>
                    </td>
                    <td align="right" style="width: 40%;"><b><i>SIGESIT</i></b></td>
                </tr>
                <tr>
                    <td align="center" style="width: 100%;" colspan="4">
                        Tanda Bukti Setor/Bukti Penerimaan Negara (BPN) yang di dalamnya tercantum Nomor Transaksi Penerimaan Negara (NTPN) adalah dokumen
                        sah yang merupakan bukti bahwa Anda telah melakukan pembayaran ke Kas Negara
                        Terima kasih atas kepercayaan anda menggunakan SIMPONI
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</body>

</html>