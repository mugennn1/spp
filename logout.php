<?php
// memulai session
session_start();

// menghapus session
session_destroy();

header("location:login.php");