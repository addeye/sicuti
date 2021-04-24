<?php
include 'conn.php';
// include 'session.php';
include 'function.php';

$sqlketua = mysqli_query($koneksi, "SELECT * FROM karyawan WHERE level ='1' ");
$ketua = mysqli_fetch_array($sqlketua);

$query = mysqli_query($koneksi, "SELECT izin.*, karyawan.nama as nama_karyawan, karyawan.gambar from izin left join karyawan on izin.nik=karyawan.nik WHERE izin.kode='$_SESSION[id_data]'");
$data = mysqli_fetch_array($query);

?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Surat Izin</title>
    <style>
        .bold{
            font-weight: bold;
        }
        .center{
            text-align: center;
        }
        .underline{
            text-decoration: underline;
        }
        .title{
            font-size: 24px;
            font-weight: bold;
        }
        .sub-title{
            font-size: 18px;
            font-weight: bold;
        }
        table.body{
            width: 100%;
        }
        table.body td {
            border: 0px solid black;
            border-collapse: collapse;
            text-align: left;
        }
        table.body td:nth-child(1) {
            width: 40%;
        }
        table.body td:nth-child(2) {
            width: 60%;
        }
        table.footer{
            width: 50%;
        }
        table.footer, th, td {
            border: 0px solid black;
            border-collapse: collapse;
            text-align: center;
        }
        table.footer th, td {
            padding: 5px;
        }
    </style>
</head>
<body>
    <img src="public/header.png" width="100%" alt="">
    <br>
    <br>
    <br>
    <p class="underline bold center">IZIN KELUAR KANTOR</p>
    <br>
    <table class="body">
        <tr>
            <td>Yang bertandatangan dibawah ini</td>

            <td> : <?=$ketua['nama']?></td>
        </tr>
        <tr>
            <td>Selaku</td>

            <td> : Atasan Langsung</td>
        </tr>
        <tr>
            <td>Dengan ini memberikan izin kepada</td>

            <td> : <?=$data['nama_karyawan']?></td>
        </tr>
        <tr>
            <td>NIP</td>

            <td> : <?=$data['nik']?></td>
        </tr>
        <tr>
            <td>Untuk keluar kantor pada hari/tgl</td>

            <td> : <?=hari($data['tanggal'])?> / <?=dmy($data['tanggal'])?></td>
        </tr>
        <tr>
            <td>Pukul</td>

            <td> : <?=pukul($data['jam_awal'])?> s/d <?=pukul($data['jam_akhir'])?></td>
        </tr>
        <tr>
            <td>Untuk keperluan</td>

            <td> : <?=$data['ket']?></td>
        </tr>
    </table>
    <br>
    <p>Demikian izin ini diberikan kepada yang bersangkutan untuk digunakan sebagaimana mestinya.</p>
    <br>
    <table border="0" cellpadding="0" cellspacing="0" width="100%">
        <tr>
            <td></td>
            <td style="text-align: right;">
                <table class="footer">
                    <tr>
                        <td>Pacitan, <?=tanggal_indo(date('Y-m-d'))?></td>
                    </tr>
                    <tr>
                        <td>Pengadilan Negeri Pacitan Kelas II</td>
                    </tr>
                    <tr>
                        <td>Ketua,</td>
                    </tr>
                    <tr>
                        <td>
                            <img width="100" src="https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=<?=$ketua['nik']?>&choe=UTF-8" title="NIP Ketua" />
                        </td>
                    </tr>
                    <tr>
                        <td class="bold underline"><?=$ketua['nama']?></td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>