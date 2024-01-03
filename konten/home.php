<?php
    // Menghitung Peserta didik
    $sql_siswa="SELECT COUNT(id_siswa) AS jumlah_siswa FROM siswa WHERE dihapus_pada IS NULL";
    $query_siswa=mysqli_query($koneksi,$sql_siswa);
    $siswa=mysqli_fetch_array($query_siswa);
    $jumlah_siswa=$siswa['jumlah_siswa'];

    // Menghitung Jumlah Transaksi 
    if($_SESSION['menu']=='MANAJEMEN'){
        $sql_jt="SELECT COUNT(id_bayar) AS jumlah_transaksi FROM bayar WHERE dihapus_pada IS NULL";
    } else {
        $id_siswa=$_SESSION['id'];
        $sql_jt="SELECT COUNT(id_bayar) AS jumlah_transaksi FROM bayar WHERE dihapus_pada IS NULL AND id_siswa=$id_siswa";
    }
    $query_jt=mysqli_query($koneksi,$sql_jt);
    $jt=mysqli_fetch_array($query_jt);
    $jumlah_transaksi=$jt['jumlah_transaksi'];

     // Menghitung Jumlah Transaksi 
     if($_SESSION['menu']=='MANAJEMEN'){
        $sql_tt="SELECT SUM(nominal_bayar) AS total_transaksi FROM bayar WHERE dihapus_pada IS NULL";
    } else {
        $id_siswa=$_SESSION['id'];
        $sql_tt="SELECT SUM(nominal_bayar) AS total_transaksi FROM bayar WHERE dihapus_pada IS NULL AND id_siswa=$id_siswa";
    }
    $query_tt=mysqli_query($koneksi,$sql_tt);
    $tt=mysqli_fetch_array($query_tt);
    $total_transaksi=$tt['total_transaksi'];

    // Menghitung Total Tunggakan 
    $tanggal_jatuh_tempo=date('Y-m-d');
    if($_SESSION['menu']=='MANAJEMEN'){
        $sql="SELECT SUM(biaya.jumlah_biaya-tagihan.total_terbayar-tagihan.potongan) AS total_tunggakan FROM tagihan,siswa,biaya,periode WHERE tagihan.dihapus_pada IS NULL AND tagihan.id_siswa=siswa.id_siswa AND tagihan.id_biaya=biaya.id_biaya AND biaya.id_periode=periode.id_periode AND biaya.tanggal_jatuh_tempo<'$tanggal_jatuh_tempo'";
        } else {
            $id_siswa=$_SESSION['id'];
                $sql="SELECT SUM(biaya.jumlah_biaya-tagihan.total_terbayar-tagihan.potongan) AS total_tunggakan FROM tagihan,siswa,biaya,periode WHERE tagihan.dihapus_pada IS NULL AND tagihan.id_siswa=siswa.id_siswa AND tagihan.id_biaya=biaya.id_biaya AND biaya.id_periode=periode.id_periode AND biaya.tanggal_jatuh_tempo<'$tanggal_jatuh_tempo' AND tagihan.id_siswa=$id_siswa";
        }
        $query_tunggakan=mysqli_query($koneksi,$sql);
        $tunggakan=mysqli_fetch_array($query_tunggakan);
        $total_tunggakan=$tunggakan['total_tunggakan'];

?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Dashboard</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3><?= $jumlah_siswa; ?></h3>

                            <p>Peserta Didik</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-user"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3><?= $jumlah_transaksi; ?></h3>

                            <p>Jumlah Transaksi</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-exchange-alt"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-purple">
                        <div class="inner">
                            <h3>Rp. <?= number_format($total_transaksi); ?></h3>

                            <p>Total Transaksi</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-money-bill"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3>Rp. <?= number_format($total_tunggakan);?></h3>

                            <p>Total Tunggakan</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-exclamation-triangle"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
            </div>
            <!-- /.row -->            
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->