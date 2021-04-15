<?php
include ("conn.php");
date_default_timezone_set('Asia/Jakarta');

session_start();

$username = $_POST['username'];
$password = sha1($_POST['password']);

//$username = mysqli_real_escape_string($username);
//$password = mysqli_real_escape_string($password);

if (empty($username) && empty($password)) {
	header('location:index.php?error=Username dan Password Kosong!');
} else if (empty($username)) {
	header('location:index.php?error=Username Kosong!');
} else if (empty($password)) {
	header('location:index.php?error=Password Kosong!');
}

$qUser = mysqli_query($koneksi, "select * from user where username='$username' and password='$password'");
$rowUser = mysqli_fetch_array ($qUser);

$q = mysqli_query($koneksi, "select * from karyawan where username='$username' and password='$password'");
$row = mysqli_fetch_array ($q);

if(mysqli_num_rows($qUser) == 1){
    $_SESSION['nik']        = $row['username'];
    $_SESSION['username']   = $row['username'];
    $_SESSION['nama']       = $row['username'];
    $_SESSION['level']      = 'admin';
    $_SESSION['gambar']     = 'public/user.png';
    $_SESSION['departemen'] = $row['username'];
}elseif (mysqli_num_rows($q) == 1) {
    $_SESSION['nik']        = $row['nik'];
    $_SESSION['username']   = $username;
    $_SESSION['nama']       = $row['nama'];
    $_SESSION['departemen'] = $row['departemen'];
    $_SESSION['jabatan']    = $row['jabatan'];
    $_SESSION['level']      = $row['level'];
    $_SESSION['gambar']     = $row['gambar'];
} else {
	header('location:index.php?error=Anda Belum Terdaftar!');
}

header('location:index.php');

?>