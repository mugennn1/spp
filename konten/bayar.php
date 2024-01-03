<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Pembayaran</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Transaksi</a></li>
                        <li class="breadcrumb-item active">Pembayaran</li>
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
                    <h5>Data Pembayaran</h5>
                </div>
                <div class="card-body">
                    <button class="btn bg-purple mb-2" data-toggle="modal" data-target="#modalRecycleBin"> <i class="fas fa-recycle"></i> Recycle Bin </button>
                    <table id="example1" class="table table-hover table-sm">
                        <thead class="bg-purple">
                            <th>ID</th>
                            <th>Siswa</th>
                            <th>Metode Pembayaran</th>
                            <th>Bukti</th>
                            <th>Tanggal Bayar</th>
                            <th>Nominal Pembayaran</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </thead>
                        <?php
                        $sql = "SELECT bayar.*,siswa.nis,siswa.nama,siswa.kelas,bayar_metode.metode FROM bayar,siswa,bayar_metode WHERE bayar.dihapus_pada IS NULL AND bayar.id_siswa=siswa.id_siswa AND bayar.id_bayar_metode=bayar_metode.id_bayar_metode";
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

                                
                                <td> <!-- 05 September 2023 --> 
                                    <!--info alokasi-->
                                    <a href="index.php?p=bayar-alokasi&id_bayar=<?= $kolom['id_bayar']; ?>" title="Informasi Alokasi Pembayaran"><i class="fas fa-search"></i></a>&nbsp;
                                    <!-- Tombol Konfirmasi     -->
                                    <?php if($kolom['status_verifikasi']=='Belum verifikasi'){ ?>
                                    <a onclick="return confirm('yakin akan mengonfirmasi pembayaran ini?')"href="index.php?p=bayar-konfirmasi&id_bayar=<?=$kolom['id_bayar']; ?>" title="konfirmasi pembayaran"><i class="fas fa-check"></i></a>
                                    <?php } ?>
                                    &nbsp;
                                    <!-- Tombol Hapus  -->
                                    <a onclick="return confirm('Yakin akan menghapus data ini?')" href="aksi/bayar.php?aksi=hapus&id_bayar=<?= $kolom['id_bayar']; ?>" title="Hapus Pembayaran"><i class="fas fa-trash"></i></a>
                                </td>
                            </tr>
<!-- Modal Ubah Biaya -->
<div class="modal fade" id="modalUbah<?= $kolom['id_biaya']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ubah Biaya</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="aksi/biaya.php" method="post">
                    <input type="hidden" name="aksi" value="ubah">
                    <input type="hidden" name="id_biaya" value="<?= $kolom['id_biaya']; ?>">

                    <label for="id_periode">Periode</label>
                    <select name="id_periode" class="form-control" required>
                        <option value="">-- Pilih Periode --</option>
                        <?php
                            $sql_periode="SELECT * FROM periode WHERE id_periode IS NOT NULL";
                            $query_periode=mysqli_query($koneksi,$sql_periode);
                            while($periode=mysqli_fetch_array($query_periode)){
                                if($kolom['id_periode']==$periode['id_periode']){
                                    echo "<option value='$periode[id_periode]' selected>$periode[periode]</option>";
                                } else {
                                    echo "<option value='$periode[id_periode]'>$periode[periode]</option>";     
                                }
                                
                            }
                        ?>
                    </select>

                    <label for="tingkat">Tingkat</label>
                    <input type="number" name="tingkat" class="form-control" value="<?= $kolom['tingkat']; ?>" required>

                    <label for="jurusan">Jurusan</label>
                    <input type="text" name="jurusan" class="form-control" value="<?= $kolom['jurusan']; ?>" required>

                    <label for="deskripsi_biaya">Deskripsi Biaya</label>
                    <input type="text" name="deskripsi_biaya" class="form-control" value="<?= $kolom['deskripsi_biaya']; ?>" required>

                    <label for="jumlah_biaya">Jumlah Biaya</label>
                    <input type="number" name="jumlah_biaya" class="form-control" value="<?= $kolom['jumlah_biaya']; ?>" required>

                    <label for="tanggal_jatuh_tempo">Tanggal Jatuh Tempo</label>
                    <input type="date" name="tanggal_jatuh_tempo" class="form-control" value="<?= $kolom['tanggal_jatuh_tempo']; ?>" required>  

                    <button type="submit" class="btn btn-block bg-purple mt-3"> <i class="fas fa-save"></i> Simpan</button>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

            </div>
        </div>
    </div>
</div>                            
                        <?php
                        } // Akhir While
                        ?>
                    </table>

                    <a href="index.php?p=bayar-tambah"><button type="button" class="btn bg-purple btn-block mt-3" > <i class="fas fa-plus"></i> Tambah Biaya Baru </button></a>
                </div>
            </div>

        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->



<!-- Modal Recycle Bin -->
<div class="modal fade" id="modalRecycleBin" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Data Penghapusan Sementara</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-hover">
                    <thead class="bg-warning">
                        <th>ID</th>
                        <th>Deskripsi Biaya</th>
                        <th>Dihapus Pada</th>
                        <th>Aksi</th>
                    </thead>
                    <?php
                    $sql = "SELECT * FROM biaya WHERE dihapus_pada IS NOT NULL";
                    $query = mysqli_query($koneksi, $sql);
                    while ($kolom = mysqli_fetch_array($query)) {
                    ?>
                        <tr>
                            <td><?= $kolom['id_biaya']; ?></td>
                            <td><?= $kolom['deskripsi_biaya']; ?></td>
                            <td><?= $kolom['dihapus_pada']; ?></td>
                            <td>
                                <a onclick="return confirm('Yakin akan mengembalikan data ini?')" href="aksi/biaya.php?aksi=restore&id_biaya=<?= $kolom['id_biaya']; ?>"><i class="fas fa-trash-restore"></i></a>
                                &nbsp;
                                <a onclick="return confirm('Yakin akan menghapus data ini secara permanen?')" href="aksi/biaya.php?aksi=hapus-permanen&id_biaya=<?= $kolom['id_biaya']; ?>"><i class="fas fa-eraser"></i></a>
                            </td>
                        </tr>
                    <?php
                    } // Akhir While
                    ?>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

            </div>
        </div>
    </div>
</div>