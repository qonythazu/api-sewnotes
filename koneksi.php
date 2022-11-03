<?php
$hostname = "localhost";
$database = "sewnotes";
$username = "root";
$password = "";

$mysqli = mysqli_connect($hostname, $username, $password, $database);

// script cek koneksi   
if (!$mysqli) {
    die("Koneksi Tidak Berhasil: " . mysqli_connect_error());
}

?>