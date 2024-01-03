<?php
$id_tagihan=$_GET['id_tagihan'];
$sql="SELECT tagihan.*,siswa.nis,siswa.nama,biaya.deskripsi_biaya,biaya.jumlah_biaya,biaya.tanggal_jatuh_tempo,periode.periode FROM tagihan,siswa,biaya, periode WHERE tagihan.dihapus_pada IS NULL AND tagihan.id_siswa=siswa.id_siswa AND tagihan.id_biaya=biaya.id_biaya AND biaya.id_periode=periode.id_periode AND tagihan.id_tagihan=$id_tagihan";
$query=mysqli_query($koneksi,$sql);
$tagihan=mysqli_fetch_array($query);
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Informasi Riwayat Transaksi Tagihan</h1>
                </div>
                <!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="#">Transaksi</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="index.php?p=bayar">Tagihan</a>
                        </li>
                        <li class="breadcrumb-item active">Informasi Riwayat</li>
                    </ol>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">

            <div class="card">
                <div class="card-header">
                    <h5>Informasi Tagihan</h5>
                </div>
                <div class="card-body">
                    <label for="siswa">Nama Siswa</label>
                    <input
                        type="text"
                        class="form-control"
                        readonly="readonly"
                        value="<?= $tagihan['nama'];?>">
                    <label for="siswa">Kelas</label>
                    <input
                        type="text"
                        class="form-control"
                        readonly="readonly"
                        value="<?= $tagihan['kelas'];?>">
                    <label for="siswa">Deskripsi Tagihan</label>
                    <input
                        type="text"
                        class="form-control"
                        readonly="readonly"
                        value="<?= $tagihan['deskripsi_biaya'];?>">
                    <label for="siswa">Tanggal Jatuh tempo</label>
                    <input
                        type="text"
                        class="form-control"
                        readonly="readonly"
                        value="<?= $tagihan['tanggal_jatuh_tempo'];?>">

                    <div class="row">
                        <div class="col-md-4">
                            <label for="siswa">Total Tagihan</label>
                            <input
                                type="text"
                                class="form-control text-right"
                                readonly="readonly"
                                value="<?= number_format($tagihan['jumlah_biaya']);?>">
                        </div>
                        <div class="col-md-4">
                            <label for="siswa">Terbayar</label>
                            <input
                                type="text"
                                class="form-control text-right"
                                readonly="readonly"
                                value="<?= number_format($tagihan['total_terbayar']);?>">
                        </div>
                        <div class="col-md-4">
                            <label for="siswa">Sisa Tagihan</label>
                            <input
                                type="text"
                                class="form-control text-right"
                                readonly="readonly"
                                value="<?= number_format($tagihan['jumlah_biaya']-$tagihan['total_terbayar']);?>">
                        </div>
                    </div>
                </div>
            </div>



        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
