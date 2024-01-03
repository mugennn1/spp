<?php

function notifikasi($koneksi)
{
    $sukses = mysqli_affected_rows($koneksi);
    if ($sukses >= 1) {
        $_SESSION['status_proses'] = 'berhasil';
    } else {
        $_SESSION['status_proses'] = 'gagal';
    }
}