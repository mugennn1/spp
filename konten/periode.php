<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Periode</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Data Utama</a></li>
                        <li class="breadcrumb-item active">Periode</li>
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
                    <h5>Data Periode Pendidikan</h5>
                </div>
                <div class="card-body">
                    <button class="btn bg-purple mb-2" data-toggle="modal" data-target="#modalRecycleBin"> <i class="fas fa-recycle"></i> Recycle Bin </button>
                    <table id="example1" class="table table-hover">
                        <thead class="bg-purple">
                            <th>ID</th>
                            <th>Periode</th>
                            <th>Tanggal Awal</th>
                            <th>Tanggal Akhir</th>
                            <th>Aksi</th>
                        </thead>
                        <?php
                        $sql = "SELECT * FROM periode WHERE dihapus_pada IS NULL";
                        $query = mysqli_query($koneksi, $sql);
                        while ($kolom = mysqli_fetch_array($query)) {
                        ?>
                            <tr>
                                <td><?= $kolom['id_periode']; ?></td>
                                <td><?= $kolom['periode']; ?></td>
                                <td><?= $kolom['tanggal_awal']; ?></td>
                                <td><?= $kolom['tanggal_akhir']; ?></td>
                                <td> 
                                    <!-- Tombol Edit     -->
                                    <a href="#" data-toggle="modal" data-target="#modalUbah<?= $kolom['id_periode']; ?>"><i class="fas fa-edit"></i></a>
                                    &nbsp;
                                    <!-- Tombol Hapus  -->
                                    <a onclick="return confirm('Yakin akan menghapus data ini?')" href="aksi/periode.php?aksi=hapus&id_periode=<?= $kolom['id_periode']; ?>"><i class="fas fa-trash"></i></a>
                                </td>
                            </tr>
<!-- Modal Ubah Periode -->
<div class="modal fade" id="modalUbah<?= $kolom['id_periode']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ubah Periode</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="aksi/periode.php" method="post">
                    <input type="hidden" name="aksi" value="ubah">
                    <input type="hidden" name="id_periode" value="<?= $kolom['id_periode']; ?>">

                    <label for="periode">Periode</label>
                    <input type="text" name="periode" value="<?= $kolom['periode']; ?>" class="form-control" required>

                    <label for="tanggal_awal">Tanggal Awal Periode</label>
                    <input type="date" name="tanggal_awal" value="<?= $kolom['tanggal_awal']; ?>" class="form-control" required>

                    <label for="tanggal_akhir">Tanggal Akhir Periode</label>
                    <input type="date" name="tanggal_akhir" value="<?= $kolom['tanggal_akhir']; ?>" class="form-control" required>

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

                    <button type="button" class="btn bg-purple btn-block mt-3" data-toggle="modal" data-target="#modalTambah"> <i class="fas fa-plus"></i> Tambah Periode Baru </button>
                </div>
            </div>

        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- Modal Tambah Periode -->
<div class="modal fade" id="modalTambah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Periode</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="aksi/periode.php" method="post">
                    <input type="hidden" name="aksi" value="tambah">

                    <label for="periode">Periode</label>
                    <input type="text" name="periode" class="form-control" required>

                    <label for="tanggal_awal">Tanggal Awal Periode</label>
                    <input type="date" name="tanggal_awal" class="form-control" required>

                    <label for="tanggal_akhir">Tanggal Akhir Periode</label>
                    <input type="date" name="tanggal_akhir" class="form-control" required>

                    <button type="submit" class="btn btn-block bg-purple mt-3"> <i class="fas fa-save"></i> Simpan</button>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

            </div>
        </div>
    </div>
</div>

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
                        <th>Periode</th>
                        <th>Dihapus Pada</th>
                        <th>Aksi</th>
                    </thead>
                    <?php
                    $sql = "SELECT * FROM periode WHERE dihapus_pada IS NOT NULL";
                    $query = mysqli_query($koneksi, $sql);
                    while ($kolom = mysqli_fetch_array($query)) {
                    ?>
                        <tr>
                            <td><?= $kolom['id_periode']; ?></td>
                            <td><?= $kolom['periode']; ?></td>
                            <td><?= $kolom['dihapus_pada']; ?></td>
                            <td>
                                <a onclick="return confirm('Yakin akan mengembalikan data ini?')" href="aksi/periode.php?aksi=restore&id_periode=<?= $kolom['id_periode']; ?>"><i class="fas fa-trash-restore"></i></a>
                                &nbsp;
                                <a onclick="return confirm('Yakin akan menghapus data ini secara permanen?')" href="aksi/periode.php?aksi=hapus-permanen&id_periode=<?= $kolom['id_periode']; ?>"><i class="fas fa-eraser"></i></a>
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