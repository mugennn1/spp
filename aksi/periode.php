<?php
session_start();
include "../koneksi.php";
include "../function.php";

if ($_POST) {
    if ($_POST['aksi'] == 'tambah') {
        $periode = $_POST['periode'];
        $tanggal_awal = $_POST['tanggal_awal'];
        $tanggal_akhir = $_POST['tanggal_akhir'];

        $sql = "INSERT INTO periode (id_periode,periode,tanggal_awal,tanggal_akhir,dibuat_pada,diubah_pada,dihapus_pada) VALUES(DEFAULT,'$periode','$tanggal_awal','$tanggal_akhir',DEFAULT,DEFAULT,DEFAULT)";
        // echo $sql; // Cek Perintah
        mysqli_query($koneksi, $sql);
        notifikasi($koneksi);

        header('location:../index.php?p=periode');
    } else if ($_POST['aksi'] == 'ubah') {
        $id_periode = $_POST['id_periode'];
        $periode = $_POST['periode'];
        $tanggal_awal = $_POST['tanggal_awal'];
        $tanggal_akhir = $_POST['tanggal_akhir'];

        $sql = "UPDATE periode SET periode='$periode', tanggal_awal='$tanggal_awal', tanggal_akhir='$tanggal_akhir' WHERE id_periode=$id_periode";
        // echo $sql; // Cek Perintah
        mysqli_query($koneksi, $sql);
        notifikasi($koneksi);

        header('location:../index.php?p=periode');
    }
}

if ($_GET) {
    if ($_GET['aksi'] == 'hapus') {
        $id_periode = $_GET['id_periode'];
        // $sql="DELETE FROM periode WHERE id_periode=$id_periode"; // Hard Delete
        $sql = "UPDATE periode SET dihapus_pada=now() WHERE id_periode=$id_periode"; // Soft Delete

        mysqli_query($koneksi, $sql);
        notifikasi($koneksi);
        header('location:../index.php?p=periode');
    } else if ($_GET['aksi'] == 'restore') {
        $id_periode = $_GET['id_periode'];
        $sql = "UPDATE periode SET dihapus_pada=NULL WHERE id_periode=$id_periode";
        mysqli_query($koneksi, $sql);
        notifikasi($koneksi);
        header('location:../index.php?p=periode');
    } else if ($_GET['aksi'] == 'hapus-permanen') {
        $id_periode = $_GET['id_periode'];
        $sql = "DELETE FROM periode WHERE id_periode=$id_periode";

        mysqli_query($koneksi, $sql);
        notifikasi($koneksi);
        header('location:../index.php?p=periode');
    }
}
