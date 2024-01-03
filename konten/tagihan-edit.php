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
                    <h1 class="m-0">Ubah Data Tagihan</h1>
                </div>
                <!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="#">Transaksi</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="index.php?p=tagihan">Tagihan</a>
                        </li>
                        <li class="breadcrumb-item active">Ubah Data</li>
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
                    <h5>Form Ubah Tagihan</h5>
                </div>
                <div class="card-body">
                <form action="aksi/tagihan.php" method="post">
                        <input type="hidden" name="aksi" value="ubah">
                        <label for="id_tagihan">ID Tagihan</label>
                        <input type="text" class="form-control" name="id_biaya" readonly value="<?= $tagihan ['id_biaya'];?>">
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
                    <input type="date" name="tanggal_jatuh_tempo"
                        class="form-control"  <?php if($tagihan['total_terbayar']>0){ ?> readonly <?php } ?> value="<?= $tagihan ['tanggal_jatuh_tempo']; ?>">
                    <div class="row">
                        <div class="col-md-4">
                            <label for="siswa">Total Tagihan</label>
                            <input
                                type="number" name="jumlah_biaya"
                                class="form-control text-right"
                                <?php if($tagihan['total_terbayar']>0){ ?> readonly <?php } ?>
                                value="<?= $tagihan['jumlah_biaya'];?>">
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
                        <?php
                          if($tagihan['total_terbayar']>0){

                        ?>
                            <div class="alert alert-warning mt-3 text-center" role="alert">
                              Perhatian!!
                             <br> Data Tagihan yang Bisa diubah hanya tagihan yang belum memiliki riwayat pembayaran, bila ingin merubah data tersebut harap menghapus pembayaran terlebih dahulu
                            </div>
                    <?php
                    } else {
                        echo"<button type='submit' class='btn btn-info btn-block mt-3'><i class='fas fa-save'></i> Simpan Perubahan</button>";
                    }
                    
                    ?>
                    </form>
                    </div>
                </div>
            </div>

            
                   
             

        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->