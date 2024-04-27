<!DOCTYPE html>
<html lang="en">
@include('template.penggunaheader')
<style type="text/css">
    .nav-item a span {
        font-weight: bold;
        /* font-weight: 900; */
        /* border-width: 2px;
      border-style: outset;
      border-radius: 40px; */
    }

    .nav-item:hover a span {
        color: #007bff;
    }

    .modal-penilaian {
        display: none;
        /* Hidden by default */
        position: absolute;
        /* Stay in place */
        z-index: 2;
        /* Sit on top */
        padding-top: 100px;
        /* Location of the box */
        left: 0;
        top: 0;
        width: 100%;
        /* Full width */
        height: 100%;
        /* Full height */
        overflow: auto;
        /* Enable scroll if needed */
    }

    .modal-content-penilaian {
        margin-left: 30px;
        padding: 0px;
        width: 24%;
    }

    @font-face {
        font-family: 'FontPresentase';
        src: url('../public/assets/digilab/fonts/arialbd.ttf') format('truetype');
    }

    .icon-penilaian {
        width: 100px;
        height: 100px;
    }

    .table {
        width: 100%;
        max-width: 100%;
        margin-bottom: 1rem;
        background-color: transparent;
    }

    #about-section table thead tr {
        background-color: #0B8CC4 !important;
        border-bottom: 1px solid #fff;
    }

    #about-section table tbody tr:nth-child(odd) {
        background-color: #ccf0ff;
        color: #006b99;
    }

    #about-section table tbody tr:nth-child(even) {
        background-color: #fff4cc;
        color: #665000;
    }

    #about-section table th {
        padding: 5px;
        font-size: 1.11em;
        font-weight: 600;
        color: #fff;
    }

    #about-section table td {
        padding: 5px;
        font-size: 1em;
        font-weight: 550;
        /* color: black; */
    }

    #about-section table tbody td:nth-child(2) {
        width: 40%;
        text-align: left;
        border-right: 1px solid #5767c8;
        border-left: 1px solid #5767c8;
    }

    .highcharts-legend,
    .highcharts-credits {
        display: none;
    }
</style>

<body data-spy="scroll" data-target=".site-navbar-target" data-offset="300">

    @include('template.penggunanavbar')

    <section class="ftco-section bg-img" id="testimony-section">
        <div class="container">
            <!-- JUDUL APP -->
            <div class="row">
                <div class="col-md-12">
                    <br>
                    <div class="">
                        <h1 class="text-left">Pengaduan</h1>
                    </div>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-12">
                    <!-- <nav class="nav">
                        <a href="pengaduan.html" class="nav-link">Pengaduan</a>
                        <a href="login.html.html" class="nav-link">Keluar</a>
                    </nav> -->
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">KIRIM PENGADUAN</div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('save_pengaduan') }}" enctype="multipart/form-data" role="form">
                  				@csrf
                                <div class="form-group">
                                    <label for="">Nama Pengguna</label>
                                    <input name="nama_pengguna" type="text" class="form-control" required  />
                                </div>
                                <div class="form-group">
                                    <label for="">Instansi</label>
                                    <input name="nama_instansi" type="text" class="form-control" required  />
                                </div>
                                <div class="form-group">
                                    <label for="">Email</label>
                                    <input name="email" type="text" class="form-control" required  />
                                </div>
                                <div class="form-group">
                                    <label for="">No Handphone</label>
                                    <input name="no_hp" type="number" class="form-control" required  />
                                </div>
                                <div class="form-group">
                                    <label for="">Pengaduan</label>
                                    <textarea name="isi_pengaduan" id="" cols="30" rows="10" class="form-control" placeholder="Tulis isi laporan disini..." required></textarea>
                                </div>
                                <div class="form-group">
                                    <input type="file" name="upload_dokumen" accept="image/*" class="form-control" required />
                                </div>
                                <button type="submit" class="btn btn-primary">Kirim</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <script type="text/javascript">
        function lihat(pertanyaan, jawaban) {
            Swal.fire({
                title: '<h3><br><b>' + pertanyaan + '</b></h3>',
                html: '<div style="text-align:left;"><br><font size="2">' + jawaban + '</font></div><br><hr>',
                animation: true,
                width: '60%'
            })
        }
    </script>

</body>

</html>