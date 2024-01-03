<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">User</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Data Utama</a></li>
                        <li class="breadcrumb-item active">User</li>
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
                    <h5>Data User</h5>
                </div>
                <div class="card-body">
                    <button class="btn bg-purple mb-2" data-toggle="modal" data-target="#modalRecycleBin"> <i class="fas fa-recycle"></i> Recycle Bin </button>
                    <table id="example1" class="table table-hover">
                        <thead class="bg-purple">
                            <th>ID</th>
                            <th>Nama</th>
                            <th>Username</th>
                            <th>Password</th>
                            <th>Hak Akses</th>
                            <th>Aksi</th>
                        </thead>
                        <?php
                        $sql = "SELECT * FROM user WHERE dihapus_pada IS NULL";
                        $query = mysqli_query($koneksi, $sql);
                        while ($kolom = mysqli_fetch_array($query)) {
                        ?>
                            <tr>
                                <td><?= $kolom['id_user']; ?></td>
                                <td><?= $kolom['nama']; ?></td>
                                <td><?= $kolom['username']; ?></td>
                                <td><?= $kolom['password']; ?></td>
                                <td><?= $kolom['hak_akses']; ?></td>
                                <td> 
                                    <!-- Tombol Edit     -->
                                    <a href="#" data-toggle="modal" data-target="#modalUbah<?= $kolom['id_user']; ?>"><i class="fas fa-edit"></i></a>
                                    &nbsp;
                                    <!-- Tombol Hapus  -->
                                    <a onclick="return confirm('Yakin akan menghapus data ini?')" href="aksi/user.php?aksi=hapus&id_user=<?= $kolom['id_user']; ?>"><i class="fas fa-trash"></i></a>
                                </td>
                            </tr>
<!-- Modal Ubah User -->
<div class="modal fade" id="modalUbah<?= $kolom['id_user']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ubah User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="aksi/user.php" method="post">
                    <input type="hidden" name="aksi" value="ubah">
                    <input type="hidden" name="id_user" value="<?= $kolom['id_user']; ?>">

                    <label for="nama">Nama</label>
                    <input type="text" name="nama" class="form-control" value="<?= $kolom['nama']; ?>" required>

                    <label for="username">Username</label>
                    <input type="text" name="username" class="form-control" value="<?= $kolom['username']; ?>" required>

                    <label for="password">Password</label>
                    <input type="password" name="password" class="form-control" value="<?= $kolom['password']; ?>" required>

                    <label for="hak_akses">Hak Akses</label>
                    <input type="number" name="hak_akses" class="form-control" value="<?= $kolom['hak_akses']; ?>" required>  

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

                    <button type="button" class="btn bg-purple btn-block mt-3" data-toggle="modal" data-target="#modalTambah"> <i class="fas fa-plus"></i> Tambah User Baru </button>
                </div>
            </div>

        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- Modal Tambah User -->
<div class="modal fade" id="modalTambah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="aksi/user.php" method="post">
                    <input type="hidden" name="aksi" value="tambah">

                    <label for="nama">Nama</label>
                    <input type="text" name="nama" class="form-control" required>

                    <label for="username">Username</label>
                    <input type="text" name="username" class="form-control" required>

                    <label for="password">Password</label>
                    <input type="password" name="password" class="form-control" required>

                    <label for="hak_akses">Hak Akses</label>
                    <input type="number" name="hak_akses" class="form-control" required>                    

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
                        <th>Username</th>
                        <th>Dihapus Pada</th>
                        <th>Aksi</th>
                    </thead>
                    <?php
                    $sql = "SELECT * FROM user WHERE dihapus_pada IS NOT NULL";
                    $query = mysqli_query($koneksi, $sql);
                    while ($kolom = mysqli_fetch_array($query)) {
                    ?>
                        <tr>
                            <td><?= $kolom['id_user']; ?></td>
                            <td><?= $kolom['username']; ?></td>
                            <td><?= $kolom['dihapus_pada']; ?></td>
                            <td>
                                <a onclick="return confirm('Yakin akan mengembalikan data ini?')" href="aksi/user.php?aksi=restore&id_user=<?= $kolom['id_user']; ?>"><i class="fas fa-trash-restore"></i></a>
                                &nbsp;
                                <a onclick="return confirm('Yakin akan menghapus data ini secara permanen?')" href="aksi/user.php?aksi=hapus-permanen&id_user=<?= $kolom['id_user']; ?>"><i class="fas fa-eraser"></i></a>
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