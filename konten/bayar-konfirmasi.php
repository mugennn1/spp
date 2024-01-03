<?php 
$id_bayar=$_GET['id_bayar'];
$sql="SELECT bayar.*,siswa.nama,siswa.kelas FROM bayar,siswa WHERE id_bayar=$id_bayar AND bayar.id_siswa=siswa.id_siswa";
$query=mysqli_query($koneksi,$sql);
$bayar=mysqli_fetch_array($query);
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Konfirmasi Pembayaran</h1>
                </div>
                <!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="#">Transaksi</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="index.php?p=bayar">Pembayaran</a>
                        </li>
                        <li class="breadcrumb-item active">Konfirmasi Pembayaran</li>
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
                    <h5>Konfirmasi Pembayaran</h5>
                </div>
                <div class="card-body">
                    <form action="aksi/bayar.php" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="aksi" value="konfirmasi-bayar">

                        <label for="id_bayar">No Pembayaran</label>
                        <input type="text" name="id_bayar" class="form-control" readonly value="<?= $bayar['id_bayar']; ?>">

                        <input type="hidden" name="id_siswa" value="<?= $bayar['id_siswa']; ?>">
                        
                        <label for="nama">Siswa</label>
                        <input type="text" name="nama" class="form-control" readonly value="<?= $bayar['nama']," [".$bayar['kelas']."]"; ?>">

                        <label for="id_bayar_metode">Metode Pembayaran</label>
                        <select name="id_bayar_metode" class="form-control" readonly>
                            <?php
                            $id_bayar_metode=$bayar['id_bayar_metode'];
                                $sql_metode="SELECT * FROM bayar_metode WHERE dihapus_pada IS NULL AND id_bayar_metode=$id_bayar_metode";
                                $query_metode=mysqli_query($koneksi,$sql_metode);
                                while($bayar_metode=mysqli_fetch_array($query_metode)){
                                    echo "<option value='$bayar_metode[id_bayar_metode]'>$bayar_metode[metode]($bayar_metode[nomor_rekening])
                                    </option>";
                                }
                            ?>
                        </select>

                        <label for="keterangan">Keteranagn Pembayaran</label>
                        <textarea
                            name="keterangan"
                            class="form-control"
                            rows="3"
                            placeholder="Isi dengan keterangan pembayaran seperti nama bank,nama pengirim,dll" readonly><?=$bayar['keterangan'];?> </textarea>
                        <label for="tanggal_bayar">Tanggal Pembayaran</label>
                        <input
                            type="date"
                            name="tanggal_bayar"
                            class="form-control" readonly value="<?= $bayar['tanggal_bayar']; ?>">
                        <label for="nominal_pembayaran">Nominal Pembayaran</label>
                        <input
                            type="text"
                            name="nominal_bayar"
                            class="form-control text-right" value="<?= number_format($bayar['nominal_bayar']); ?>" readonly>
                        <label for="bukti">Bukti Pembayaran</label>
                        <img src="file/buktibayar/<?= $bayar['bukti']; ?>" width="100%">

                        <button type="submit" class="btn btn-info btn-block mt-2" onclick="return confirm('Apakah anda yakin semua data sudah benar?')">
                            <i class="fas fa-save"></i>Konfirmasi Pembayaran</button>
                    </form>
                </div>
            </div>

        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->