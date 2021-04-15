<?php
session_start();
if(!isset($_SESSION['level'])){
    header('location:login.php');
}

function status_cuti(){
    return [
        'Approved',
        'Rejected',
        'Pending'
    ];
}

$nama_level = 'Admin';
$nama_departemen = 'Admin';

if($_SESSION['level']!='admin'){
    $qauth = mysqli_query($koneksi,"SELECT karyawan.*, departemen.nama_dept, jabatan.jabatan as nama_jabt, level.nama as nama_lev from karyawan left join departemen on karyawan.departemen=departemen.id_dept inner join jabatan on karyawan.jabatan=jabatan.id_jabatan inner join level on karyawan.level=level.id WHERE karyawan.nik='$_SESSION[nik]'");
    $auth = mysqli_fetch_array($qauth);

    $nama_level = $auth['nama_lev'];
    $nama_departemen = $auth['nama_dept'];
}

// if ($_SESSION['level'] == "Admin") {
// 	include "conn.php";
// } else if ($_SESSION['level'] == "Superuser") {
// 	header('location:index.php');
// } else if ($_SESSION['level'] == "User") {
// 	header('location:user/index.php');
// } else {
//     header('location:index.php');
// }
?>
