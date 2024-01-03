<?php
    $id_siswa=$_SESSION['id'];
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Input Pembayaran</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        
                        <li class="breadcrumb-item active">Input Pembayaran</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">

            <div class="card">
                <div class="card-header">
                    <h5>Input Pembayaran</h5>
                </div>
                <div class="card-body">
                    <form action="aksi/bayar.php" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="aksi" value="tambah-siswa">
                        <label for="id_siswa">Siswa</label><select name="id_siswa" class="form-control select2bs4">
                        <?php
                          $sql_siswa="SELECT * FROM siswa WHERE dihapus_pada IS NULL AND id_siswa=$id_siswa ORDER BY nama ASC";
                          $query_siswa=mysqli_query($koneksi,$sql_siswa);
                          while($siswa=mysqli_fetch_array($query_siswa)){
                            echo"<option value='$siswa[id_siswa]'>$siswa[nis]-$siswa[nama]($siswa[kelas])</option>";
                          }
                        ?>
                    </select>
                <label for="metode_bayar">Metode Pembayaran</label>
                <select name="id_bayar_metode" class="form-control">
                    <option value="">--- Pilih Metode Pembayaran ---</option>
                    <?php
                    $sql_metode="SELECT * FROM bayar_metode WHERE dihapus_pada IS NULL";
                    $query_metode=mysqli_query($koneksi,$sql_metode);
                    while($bayar_metode=mysqli_fetch_array($query_metode)){
                        echo"<option value='$bayar_metode[id_bayar_metode]'
                        >$bayar_metode[metode]($bayar_metode[nomor_rekening])</option>";
                    }
                    ?>
                </select>
                <label for="keterangan">Keterangan Pembayaran</label>
                <textarea name="keterangan" class="form-control" rows="3" placeholder="Isi dengan keterangan pembayaran seperti nama bank, nama pengirim. dll"></textarea>
                
                <label for="tanggal_bayar">Tanggal Pembayaran</label>
                <input type="date" name="tanggal_bayar" class="form-control" required>
                <label for="nominal_bayar">Nominal Pembayaran</label>
                <input type="number" name="nominal_bayar" class="form-control" required>
                <label for="bukti">Upload Bukti</label>
                <input type="file" name="bukti" class="form-control" required>
                <button type="submit" class="btn btn-info btn-block mt-2"><i class="fas fa-save"></i> Simpan Pembayaran </button>
            </form>
                    
                </div>
            </div>

        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->