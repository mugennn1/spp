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
                    <h1 class="m-0">Riwayat Tagihan & Pembayaran</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">Riwayat Tagihan & Pembayaran</li>
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
                    <h5>Data Tagihan</h5>
                </div>
                <div class="card-body">
                    <table id="example1" class="table table-hover table-sm">
                        <thead class="bg-purple">
                            <th>ID</th>
                            <th>Periode</th>
                            <th>NIS Siswa</th>
                            <th>Nama Siswa</th>
                            <th>Kelas</th>
                            <th>Deskripsi Biaya</th>
                            <th>Tanggal Jatuh Tempo</th>
                            <th>Jumlah Biaya</th>
                            <th>Terbayar</th>
                            <th>Aksi</th>
                        </thead>
                        <?php
                        $sql = "SELECT tagihan.*,siswa.nis,siswa.nama,biaya.deskripsi_biaya,biaya.jumlah_biaya,biaya.tanggal_jatuh_tempo,periode.periode FROM tagihan,siswa,biaya,periode WHERE tagihan.dihapus_pada IS NULL AND tagihan.id_siswa=siswa.id_siswa AND tagihan.id_biaya=biaya.id_biaya AND biaya.id_periode=periode.id_periode AND tagihan.id_siswa=$id_siswa";
                        $query = mysqli_query($koneksi, $sql);
                        while ($kolom = mysqli_fetch_array($query)) {
                            //atus warna sesuai pelunasan
                            if($kolom['total_terbayar']==$kolom['jumlah_biaya']){
                                // Lunas
                                $warna="bg-success";
                            } else if($kolom['total_terbayar']>0 && $kolom['total_terbayar']<$kolom['jumlah_biaya']){
                                // bayar sebagian
                                $warna="bg-warning";
                            } else {
                                //belum bayar sama sekali
                                $warna="bg-danger";
                            }

                        ?>
                            <tr class="<?= $warna; ?>">
                                <td><?= $kolom['id_tagihan']; ?></td>   
                                <td><?= $kolom['periode']; ?></td>                             
                                <td><?= $kolom['nis']; ?></td>                                
                                <td><?= $kolom['nama']; ?></td>
                                
                                <td><?= $kolom['kelas']; ?></td>
                                <td><?= $kolom['deskripsi_biaya']; ?></td>
                                <td><?= $kolom['tanggal_jatuh_tempo']; ?></td>
                                <td><?= number_format($kolom['jumlah_biaya']); ?></td>
                                <td><?= number_format($kolom['total_terbayar']); ?></td>
                                
                                <td>
                                    <!-- Tombol informasi     -->
                                    <a title="Informasi Riwayat tagihan" href="index.php?p=siswa-info&id_tagihan=<?= $kolom['id_tagihan']; ?>"><i class="fas fa-search"></i></a>
                                </td>
                            </tr>
                           
                        <?php
                        } // Akhir While
                        ?>
                    </table>

                </div>
                <div class="card">
                    <div class="card-header">
                        <h5>Data Pembayaran</h5>
                    </div>
                    <div class="card-body">
                    <table id="example1" class="table table-hover table-sm">
                        <thead class="bg-purple">
                            <th>ID</th>
                            <th>Siswa</th>
                            <th>Metode Pembayaran</th>
                            <th>Bukti</th>
                            <th>Tanggal Bayar</th>
                            <th>Nominal Pembayaran</th>
                            <th>Status</th>
                        </thead>
                        <?php
                        $sql = "SELECT bayar.*,siswa.nis,siswa.nama,siswa.kelas,bayar_metode.metode FROM bayar,siswa,bayar_metode WHERE bayar.dihapus_pada IS NULL AND bayar.id_siswa=siswa.id_siswa AND bayar.id_bayar_metode=bayar_metode.id_bayar_metode AND bayar.id_siswa=$id_siswa";
                        $query = mysqli_query($koneksi, $sql);
                        while ($kolom = mysqli_fetch_array($query)) {
                        ?>
                            <tr> 
                                <td><?= $kolom['id_bayar']; ?></td>   
                                <td><?= $kolom['nis']; ?>-<?= $kolom['nama']; ?>(<?= $kolom['kelas']; ?>)</td>                             
                                <td><?= $kolom['metode']; ?></td>  
                                <td><img src="file/buktibayar/<?= $kolom['bukti']; ?>" alt="<?= $kolom['bukti']; ?>" width="100"></td>                         
                                <td><?= $kolom['tanggal_bayar']; ?></td>
                                <td align="right"><?=number_format($kolom['nominal_bayar']);?></td>
                                <td>
                                    <?php
                                       if($kolom['status_verifikasi']=='Belum verifikasi'){
                                        $class="badge badge-sm badge-danger";
                                       }else{
                                        $class="badge badge-sm badge-success";
                                       }
                                    ?>
                                    <span class="<?= $class; ?>">
                                    <?= $kolom['status_verifikasi']; ?>
                                    </span>
                                </td>
                                <td> <!-- Tombol informasi     -->
                                                                        <a title="Informasi Riwayat tagihan" href="index.php?p=bayar-alokasi-siswa&id_bayar=<?= $kolom['id_bayar']; ?>"><i class="fas fa-search"></i></a></td>
                            </tr>
                        <?php } ?>
                    </tabel>
                </div>
            </div>

        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- Modal Tambah Tagihan -->
<div class="modal fade" id="modalTambah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Tagihan Per Jurusan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="aksi/tagihan.php" method="post">
                    <input type="hidden" name="aksi" value="tambah-berdasarkan-kelas">

                    <label for="id_periode">Periode</label>
                    <select name="id_periode" class="form-control" required>
                        <option value="">-- Pilih Periode --</option>
                        <?php
                            $sql="SELECT * FROM periode WHERE id_periode IS NOT NULL";
                            $query=mysqli_query($koneksi,$sql);
                            while($periode=mysqli_fetch_array($query)){
                                echo "<option value='$periode[id_periode]'>$periode[periode]</option>";
                            }
                        ?>
                    </select>
                    
                    <label for="tingkat">Tingkat</label>
                    <input type="number" name="tingkat" class="form-control" required>

                    <label for="id_jurusan">Jurusan</label>
                    <select name="id_jurusan" class="form-control" required>
                        <option value="">-- Pilih Jurusan --</option>
                        <?php
                            $sql_jurusan="SELECT * FROM jurusan WHERE dihapus_pada IS NULL ORDER BY jurusan ASC";
                            $query_jurusan=mysqli_query($koneksi,$sql_jurusan);
                            while($jurusan=mysqli_fetch_array($query_jurusan)){
                            echo "<option value='$jurusan[id_jurusan]'>$jurusan[jurusan]</option>";
                            }
                        ?>
                    </select>

                    <button type="submit" class="btn btn-block bg-purple mt-3"> <i class="fas fa-save"></i> Simpan</button>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

            </div>
        </div>
    </div>
</div>