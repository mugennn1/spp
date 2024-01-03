<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Restore</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Maintence</a></li>
                        <li class="breadcrumb-item active">Restore</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
               <div class="card-header">
                <h5>Pilih File Restore (ekstensi)</h5>
               </div> 
               <div class="card-body">
               <form action="" enctype="multipart/form-data" method="post">
                <label for="file">File Backup</label>
                <input type="file" name="file" class="form-control" required>

                <button type="submit" class="btn btn-info btn-block mt-3" name="restore" onclick="return confirm('Perhatian !!!, proses restore akan merubah total seluruh data yang ada berdasarkan file yang dipilih, sebelum restore sangat disarankan untuk melakukan proses backup terlebih dahulu, Apakah anda sudah yakin akan melanjutkan proses ini?')"><i class="fas fa-cog"></i>Mulai Restore</button>

               </form>    
               <?php
if (isset($_POST['restore'])) {

    $nama_file = $_FILES['file']['name'];
    $ukuran = $_FILES['file']['size'];


    if ($nama_file == "") {
        echo "Error";
    } else {
        $uploaddir = 'maintenance/restore/';
        $alamatfile = $uploaddir . $nama_file;

        if (move_uploaded_file($_FILES['file']['tmp_name'], $alamatfile)) {

            $filename = 'maintenance/restore/' . $nama_file . '';

            $templine = '';
            $lines = file($filename);
            $sukses_query=0;
            
            foreach ($lines as $line) {
                if (substr($line, 0, 2) == '--' || $line == '')
                    continue;

                $templine .= $line;
                if (substr(trim($line), -1, 1) == ';') {
                    mysqli_report(MYSQLI_REPORT_STRICT);
                    mysqli_query($koneksi, $templine) or print('<span class="badge badge-danger">Gagal memproses query :' . substr($templine, 0, 50) . '...' . '\': ' . mysqli_error($koneksi) . '</span><br />');

                    if(mysqli_affected_rows($koneksi)>=1){
                        $sukses_query++;                        
                        print('<span class="badge badge-success">Berhasil memproses query :' . substr(trim($templine), 0, 100). '...</span><br />');
                    }
                    $templine = '';
                }
            }
            if($sukses_query>=1){
            echo "<span class='badge badge-success'>Berhasil Restore Database Sebanyak $sukses_query Query.</badge>";
            }
        } else {
            echo "<p>Proses upload gagal, kode error = " . $_FILES['location']['error'] . "</p>";
        }
    }
    // Perintah Set Null
    $sql_null = "SHOW TABLES";
    $query_null = mysqli_query($koneksi, $sql_null);
    while ($table = mysqli_fetch_array($query_null)) {
        
        $tbl = $table[0];
        $sql_null = "UPDATE $tbl SET dihapus_pada=NULL WHERE dihapus_pada='0000-00-00 00:00:00'";
        mysqli_query($koneksi, $sql_null);
    }
} else {
    unset($_POST['restore']);
}
?>             
               </div> 
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->