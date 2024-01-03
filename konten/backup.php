<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">BackUp</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Maintence</a></li>
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
               <div class="card-header">
                <h5>Data Tabel Yang Akan Di Backup</h5>
               </div> 
               <div class="card-body">
               <table class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tabel</th>
                        <th>Jumlah Data</th>
                    </tr>
                </thead>
                <?php
                $no=0;
                $sql="SHOW TABLES";
                $query=mysqli_query($koneksi,$sql);
                while($table=mysqli_fetch_array($query)){
                    $no++;
                    $tbl=$table[0];
                    $sql_count="SELECT COUNT(*) AS jumlah_data FROM ".
                    $tbl;
                    $query_count=mysqli_query($koneksi,$sql_count);
                    $count=mysqli_fetch_array($query_count);
                    echo "
                    <tr>
                      <td>$no</td>
                      <td>$table[0]</td>
                      <td>$count[jumlah_data]</b> Data</td>
                    </tr>";
                }
                ?>
               </table>
                 <a href="aksi/backup.php">
                    <button class="btn btn-info btn-block"><i class="fas fas-cog"></i> Backup Sekarang</button>
                 </a>
               </div> 
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->