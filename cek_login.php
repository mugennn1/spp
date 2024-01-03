<?php
// mengaktifkan session 
session_start();

//  koneksi ke database
include "koneksi.php";

// mengambil nilai dri form
$user = $_POST['user'];
$pass = $_POST['pass'];


// ngambil data di database
$query = "SELECT * FROM user WHERE username = '$user' AND password = '$pass'";

$sql = mysqli_query($koneksi, $query);


// ngecek data
$cek = mysqli_num_rows($sql);


if ($cek>0){
    // register data user
    $row = mysqli_fetch_array($sql);
    $_SESSION['user'] = $row['username'];
    $_SESSION['pass'] = $row['password'];
    $_SESSION['akses'] = true;

    header("location:index.php");
} else {
    header("location:login.php");
}