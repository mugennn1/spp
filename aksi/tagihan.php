<?php
session_start();
include "../koneksi.php";
include "../function.php";

if($_POST){
    if($_POST['aksi']=='tambah-berdasarkan-kelas'){
        $id_periode=$_POST['id_periode'];
        $tingkat=$_POST['tingkat'];
        $id_jurusan=$_POST['id_jurusan'];

       // Mengecek Siswa Yang Sesuai Tingkat & Jurusan
       $sql_siswa="SELECT * FROM siswa WHERE dihapus_pada IS NULL AND tingkat=$tingkat AND id_jurusan=$id_jurusan";
    //    echo $sql_siswa;
       $query_siswa=mysqli_query($koneksi,$sql_siswa);
       $jumlah_siswa=mysqli_num_rows($query_siswa);
       echo "Ditemukan ".$jumlah_siswa." Siswa Cocok";

       // Mengecek Biaya Yang cocok
       $sql_biaya="SELECT * FROM biaya WHERE dihapus_pada IS NULL AND id_periode=$id_periode AND tingkat=$tingkat AND id_jurusan=$id_jurusan";
       $query_biaya=mysqli_query($koneksi,$sql_biaya);
       $jumlah_biaya=mysqli_num_rows($query_biaya);
       //echo "<br>Ditemukan ".$jumlah_biaya." Biaya Cocok";

       // Memproses Tagihan Bila Siswa dan Biaya Ditemukan
       if($jumlah_siswa>=1 && $jumlah_biaya>=1){
         while($siswa=mysqli_fetch_array($query_siswa)){
            $id_siswa=$siswa['id_siswa'];
            $kelas=$siswa['kelas'];
            
            $sql_biaya="SELECT * FROM biaya WHERE dihapus_pada IS NULL AND id_periode=$id_periode AND tingkat=$tingkat AND id_jurusan=$id_jurusan";
            $query_biaya=mysqli_query($koneksi,$sql_biaya);
            while($biaya=mysqli_fetch_array
            ($query_biaya)){
                $id_biaya=$biaya['id_biaya'];
               // echo "<br> ".$id_siswa." Kelas:".$kelas." Biaya-> ".$id_biaya;
               $sql="INSERT INTO tagihan(id_tagihan,id_biaya,id_siswa,kelas,keterangan,potongan,total_terbayar,dibuat_pada,diubah_pada,dihapus_pada) VALUES(DEFAULT,$id_biaya,$id_siswa,'$kelas','',0,0,DEFAULT,DEFAULT,DEFAULT)";
               //echo $sql."<br>";
               mysqli_query($koneksi,$sql);
               notifikasi($koneksi);
            }
            //echo"<br> ".$id_siswa." Kelas:".$kelas;
         }
       }
       header("location:../index.php?p=tagihan");

    }
    else if($_POST['aksi']=='ubah'){
        $id_biaya=$_POST['id_biaya'];
        $tanggal_jatuh_tempo=$_POST['tanggal_jatuh_tempo'];
        $jumlah_biaya=$_POST['jumlah_biaya'];

        $sql="UPDATE biaya SET tanggal_jatuh_tempo='$tanggal_jatuh_tempo', jumlah_biaya=$jumlah_biaya WHERE id_biaya=$id_biaya";
        //echo $sql;
        mysqli_query($koneksi,$sql);
        notifikasi($koneksi);
        header('location:../index.php?p=tagihan');
    }
    
}

if($_GET){
    if($_GET['aksi']=='hapus'){
        
    }
    else if ($_GET['aksi']=='restore'){
        
    }
    
    
}