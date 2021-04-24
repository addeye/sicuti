<?php
include ("conn.php");
$nik = $_GET['nik'];

$queryjenis="select * from jenis_cuti";
$jenis=mysqli_query($koneksi, $queryjenis) or die(mysqli_error($koneksi));

while($data=mysqli_fetch_array($jenis)){
    $queryjatah="INSERT INTO jatah_cuti (id, jenis_cuti, nik, jumlah_n, jumlah_n1, jumlah_n2) VALUES (NULL, '$data[id_cuti]', '$nik', '0','0','0')";
    $jatah=mysqli_query($koneksi, $queryjatah) or die(mysqli_error($koneksi));
}

header('location:index.php?page=detail-karyawan&id='.$nik);

?>