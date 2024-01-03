<?php
session_start();
include "../koneksi.php";
include "../function.php";

if($_POST){
    if($_POST['aksi']=='tambah'){
        $nis=$_POST['nis'];
        $nama=$_POST['nama'];
        $tingkat=$_POST['tingkat'];
        $kelas=$_POST['kelas'];
        $id_jurusan=$_POST['id_jurusan'];
        $alamat=$_POST['alamat'];
        $no_hp=$_POST['no_hp'];
        $email=$_POST['email'];        

        $sql="INSERT INTO siswa (id_siswa, nis, nama, tingkat, kelas, id_jurusan, alamat, no_hp, email, dibuat_pada, diubah_pada, dihapus_pada) VALUES(DEFAULT, '$nis', '$nama', $tingkat, '$kelas', $id_jurusan, '$alamat', '$no_hp', '$email',DEFAULT,DEFAULT,DEFAULT)";
        // echo $sql;
        mysqli_query($koneksi,$sql);
        notifikasi($koneksi);

        header('location:../index.php?p=siswa');
    }
    else if($_POST['aksi']=='ubah'){        
        $id_siswa=$_POST['id_siswa'];
        $nis=$_POST['nis'];
        $nama=$_POST['nama'];
        $tingkat=$_POST['tingkat'];
        $kelas=$_POST['kelas'];
        $id_jurusan=$_POST['id_jurusan'];
        $alamat=$_POST['alamat'];
        $no_hp=$_POST['no_hp'];
        $email=$_POST['email'];

        $sql="UPDATE siswa SET nis='$nis',nama='$nama',tingkat=$tingkat, kelas='$kelas', id_jurusan=$id_jurusan, alamat='$alamat', no_hp='$no_hp', email='$email' WHERE id_siswa=$id_siswa";
        // echo $sql; // Cek Perintah
        mysqli_query($koneksi,$sql);
        notifikasi($koneksi);
        header('location:../index.php?p=siswa');
    }
    else if($_POST['aksi']=='login'){
        $nis=$_POST['nis'];
        $email=$_POST['email'];

        $sql="SELECT * FROM siswa WHERE nis='$nis' AND email='$email'";
        $query=mysqli_query($koneksi,$sql);
        $ketemu=mysqli_num_rows($query);
        if($ketemu>=1){
            $siswa=mysqli_fetch_array($query);
            $_SESSION['user']=$siswa['nis'];
            $_SESSION['nama']=$siswa['nama'];
            $_SESSION['id']=$siswa['id_siswa'];
            $_SESSION['akses']=0;
            $_SESSION['menu']="SISWA";
            $_SESSION['status_proses']='';
            // echo "Login Siswa ".$_SESSION['nama']."Berhasil"; 
            header("location:../index.php");
        } else {
           header("location:../login.php?msg=err");
           //echo "Login siswa gagal";
        }
    }

}

if($_GET){
    if($_GET['aksi']=='hapus'){
        $id_siswa=$_GET['id_siswa'];        
        $sql="UPDATE siswa SET dihapus_pada=now() WHERE id_siswa=$id_siswa"; // Soft Delete

        mysqli_query($koneksi,$sql);
        notifikasi($koneksi);
        header('location:../index.php?p=siswa');
    }
    else if ($_GET['aksi']=='restore'){
        $id_siswa=$_GET['id_siswa'];
        $sql="UPDATE siswa SET dihapus_pada=NULL WHERE id_siswa=$id_siswa";
        mysqli_query($koneksi,$sql);
        notifikasi($koneksi);
        header('location:../index.php?p=siswa');
    }
    else if ($_GET['aksi']=='hapus-permanen'){
        $id_siswa=$_GET['id_siswa'];
        $sql="DELETE FROM siswa WHERE id_siswa=$id_siswa";
        
        mysqli_query($koneksi,$sql);
        notifikasi($koneksi);
        header('location:../index.php?p=siswa');
    }
}