<?php
include 'conn.php';
include 'function.php';

$sqlketua = mysqli_query($koneksi, "SELECT * FROM karyawan WHERE level ='1' ");
$ketua = mysqli_fetch_array($sqlketua);

$sqlsekertaris = mysqli_query($koneksi, "SELECT * FROM karyawan WHERE level ='2' ");
$sekertaris = mysqli_fetch_array($sqlsekertaris);

$query = mysqli_query($koneksi, "SELECT cuti.*, jenis_cuti.nama_cuti, jenis_cuti.sub, karyawan.nama as nama_karyawan, karyawan.telp, karyawan.alamat, karyawan.gambar, karyawan.tanggal_masuk, jabatan.jabatan as nama_jabatan from cuti left join karyawan on cuti.nik=karyawan.nik inner join jenis_cuti on cuti.jenis_cuti=jenis_cuti.id_cuti inner join jabatan on karyawan.jabatan=jabatan.id_jabatan WHERE cuti.kode='$_SESSION[id_data]'");
$data = mysqli_fetch_array($query);

$queryjatah="SELECT jatah_cuti.id, jenis_cuti.nama_cuti, jatah_cuti.jumlah_n, jatah_cuti.jumlah_n1, jatah_cuti.jumlah_n2, jatah_cuti.jenis_cuti FROM jatah_cuti INNER JOIN jenis_cuti ON jatah_cuti.jenis_cuti=jenis_cuti.id_cuti WHERE jatah_cuti.nik='$data[nik]' AND jatah_cuti.jenis_cuti='$data[jenis_cuti]'";
$jatah=mysqli_query($koneksi, $queryjatah) or die(mysqli_error($koneksi));
$jatah = mysqli_fetch_array($jatah);

$queryJenisCuti = mysqli_query($koneksi, "SELECT * FROM jenis_cuti");
$dataJenisCuti = [];
$dataJenisCutiCatatan = [];

while ($dataJenisC = mysqli_fetch_array($queryJenisCuti)){
    $dataJenisCuti[] = $dataJenisC;
    if($dataJenisC['sub']==0){
        $dataJenisCutiCatatan [] = $dataJenisC;
    }
}

$dataJCuti = [];

$total = count($dataJenisCuti) / 2;
$start = 0;
for ($i=0; $i < $total; $i++) {
    for ($j=$start; $j < ($start + 2); $j++) {
        $dataJCuti[$i][] = $dataJenisCuti[$j];
    }
    $start= $j;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Surat Cuti</title>
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

        table.content {
            border-collapse: collapse;
            width: 100%;
            margin-bottom: 20px;
        }

        table.content td, th {
            border: 1px solid #999;
            padding: 0.5rem;
            text-align: left;
        }

        table.contentCatatan {
            border-collapse: collapse;
            width: 100%;
            margin-bottom: 20px;
        }

        table.contentCatatan td, th {
            border: 1px solid #999;
            padding: 0.5rem;
            height: 80px;
            text-align: left;
        }

        table.subcontent {
            border-collapse: collapse;
            width: 100%;
            margin-bottom: 20px;
        }

        table.footer{
            width: 100%;
        }
        table.footer td {
            border: 0px solid black;
            border-collapse: collapse;
            text-align: center;
        }
        table.footer th, td {
            padding: 0px;
        }
    </style>
</head>
<body>
    <table style="width: 100%;">
        <tr>
            <td></td>
            <td style="width: 40%; font-size: 10px; text-align: justify;"><p >LAMPIRAN II:  SURAT EDARAN SEKRETARIS MAHKAMAH AGUNG REPUBLIK INDONESIA NOMOR 13  TAHUN 2019 TENTANG PELAKSANAAN CUTI BAGI HAKIM DAN APARATUR DI LINGKUNGAN MAHKAMAH AGUNG DAN BADAN PERADILAN DIBAWAHNYA</p></td>
        </tr>
        <tr>
            <td colspan="2"><br></td>
        </tr>
        <tr>
            <td></td>
            <td style="width: 40%;">
            Pacitan, <?=tanggal_indo(date('Y-m-d'))?>
            </td>
        </tr>
        <tr>
            <td colspan="2"><br></td>
        </tr>
        <tr>
            <td></td>
            <td style="width: 40%;">
            Kepada :
            </td>
        </tr>
        <tr>
            <td></td>
            <td style="width: 40%;">
                <span align="center">Yth.  Bpk Ketua Pengadilan Negeri Pacitan Kelas II</span>
            </td>
        </tr>
        <tr>
            <td></td>
            <td style="width: 40%;">
                <span style="text-align: center;">Di</span>
            </td>
        </tr>
        <tr>
            <td></td>
            <td style="width: 30%;">
                <div class="undeline center"><strong><u>P A C I T A N</u></strong></div>
            </td>
        </tr>
    </table>
    <br>
    <p class="center">FORMULIR PERMINTAAN DAN PEMBERIAN CUTI</p>
    <table class="content">
        <tr>
            <td colspan="4">I. DATA PEGAWAI</td>
        </tr>
        <tr>
            <td>Nama</td>
            <td><?=$data['nama_karyawan']?></td>
            <td>NIP</td>
            <td><?=$data['nik']?></td>
        </tr>
        <tr>
            <td>Jabatan</td>
            <td><?=$data['nama_jabatan']?></td>
            <td>Masa Kerja</td>
            <td><?=masakerja($data['tanggal_masuk'])?></td>
        </tr>
        <tr>
            <td>Unit Kerja</td>
            <td>Pengadilan Negeri Pacitan Kelas II</td>
            <td></td>
            <td></td>
        </tr>
    </table>
    <table class="content">
        <tr>
            <td colspan="4">II. JENIS CUTI YANG DIAMBIL **</td>
        </tr>
        <?php foreach($dataJCuti as $rowCuti): ?>
            <tr>
                <?php foreach($rowCuti as $row): ?>
                <td><?=$row['nama_cuti']?></td>
                <td align="center"><?=$row['id_cuti']==$data['jenis_cuti']?'<strong>&#8730</strong>':''?></td>
                <?php endforeach; ?>
            </tr>
        <?php endforeach; ?>
    </table>
    <table class="content">
        <tr>
            <td>III. ALASAN CUTI</td>
        </tr>
        <tr>
            <td><?=$data['ket']?></td>
        </tr>
    </table>
    <table class="content">
        <tr>
            <td colspan="4">IV. LAMANYA CUTI</td>
        </tr>
        <tr>
            <td>Selama</td>
            <td align="center"><?=$data['jumlah']?>  (hari/<del>bulan</del>/<del>tahun</del>)*</td>
            <td>Tanggal</td>
            <td>
                <?php if($data['jumlah'] == 1): ?>
                <?=tanggal_indo($data['tanggal_awal'])?>
                <?php else: ?>
                <?=tanggal_indo($data['tanggal_awal'])?> - <?=tanggal_indo($data['tanggal_akhir'])?>
                <?php endif; ?>
            </td>
        </tr>
    </table>
    <table class="subcontent">
        <tr>
            <td style="padding: 0.5rem; border: 1px solid #999;" colspan="2">V. CATATAN CUTI ***</td>
        </tr>
        <tr>
            <td style="width: 50%;">
                <table class="contentCatatan">
                    <tr>
                        <td colspan="3">1. CUTI TAHUNAN</td>
                        <td style="width: 20%;" valign="top" align="center" rowspan="5">PARAF PETUGAS CUTI</td>
                    </tr>
                    <tr>
                        <td>Tahun</td>
                        <td>Sisa</td>
                        <td>Keterangan</td>
                    </tr>
                    <tr>
                        <td>N-2</td>
                        <td align="center">
                            <?php if($data['sub']==1 AND $data['set_n2']==1): ?>
                                <?=$jatah['jumlah_n2']?>
                            <?php endif ?>
                        </td>
                        <td valign="top">
                            <?php if($data['sub']==1 AND $data['set_n2']==1): ?>
                                Yang bersangkutan mengambil sisa Cuti Tahunan untuk Tahun <?=($data['tahun']-2)?>
                            <?php endif ?>
                        </td>
                    </tr>
                    <tr>
                        <td>N-1</td>
                        <td align="center">
                            <?php if($data['sub']==1 AND $data['set_n1']==1): ?>
                                <?=$jatah['jumlah_n1']?>
                            <?php endif ?>
                        </td>
                        <td>
                            <?php if($data['sub']==1 AND $data['set_n1']==1): ?>
                                Yang bersangkutan mengambil sisa Cuti Tahunan untuk Tahun <?=($data['tahun']-1)?>
                            <?php endif ?>
                        </td>
                    </tr>
                    <tr>
                        <td>N</td>
                        <td>
                            <?php if($data['sub']==1 AND $data['set_n']==1): ?>
                                <?=$jatah['jumlah_n']?>
                            <?php endif ?>
                        </td>
                        <td>
                            <?php if($data['sub']==1 AND $data['set_n']==1): ?>
                                Yang bersangkutan mengambil sisa Cuti Tahunan untuk Tahun <?=($data['tahun'])?>
                            <?php endif ?>
                        </td>
                    </tr>
                </table>
            </td>
            <td valign="top" style="width: 50%;">
                <table class="contentCatatan">
                    <?php $no=2; foreach ($dataJenisCutiCatatan as $key => $value):?>
                    <tr>
                        <td><?=$no?>. <?=$value['nama_cuti']?></td>
                        <td align="center">
                            <?php if($data['sub']==0 AND $data['set_n']==1 AND $value['id_cuti']==$jatah['jenis_cuti']): ?>
                                <?=$jatah['jumlah_n']?>
                            <?php endif ?>
                        </td>
                    </tr>
                    <?php $no++; endforeach; ?>
                </table>
            </td>
        </tr>
    </table>
    <table class="content">
        <tr>
            <td colspan="4">VI. ALAMAT SELAMA MENJALANAKAN CUTI</td>
        </tr>
        <tr>
            <td></td>
            <td>TELP/HP</td>
            <td><?=$data['telp']?></td>
        </tr>
        <tr>
            <td valign="top">
                <?=$data['alamat']?>
            </td>
            <td align="center" colspan="2">
                <span>Hormat saya,</span>
                <br>
                <img width="100" src="https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=<?=$data['nik']?>&choe=UTF-8" title="NIP Ketua" />
                <br>
                <span class="underline bold"><?=$data['nama_karyawan']?></span><br><?=$data['nik']?>
            </td>
        </tr>
    </table>
    <table class="content">
        <tr>
            <td colspan="4">VII. PERTIMBANGAN ATASAN LANGSUNG**</td>
        </tr>
        <tr>
            <td>DISETUJUI</td>
            <td>PERUBAHAN****</td>
            <td>DITANGGUHKAN****</td>
            <td>TIDAK DISETUJUI****</td>
        </tr>
        <tr>
            <td align="center"><?=$data['status_sekertaris']=='Approved'?'<strong>&#8730</strong>':''?></td>
            <td align="center"></td>
            <td align="center"><?=$data['status_sekertaris']=='Pending'?'<strong>&#8730</strong>':''?></td>
            <td align="center"><?=$data['status_sekertaris']=='Rejected'?'<strong>&#8730</strong>':''?></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td colspan="2" align="right">
                <table class="footer">
                    <tr>
                        <td>Pengadilan Negeri Pacitan Kelas II</td>
                    </tr>
                    <tr>
                        <td>Sekretaris,</td>
                    </tr>
                    <tr>
                        <td>
                            <img width="100" src="https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=<?=$sekertaris['nik']?>&choe=UTF-8" title="NIP Ketua" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <span class="bold underline"><?=$sekertaris['nama']?></span><br>
                            <span><?=$sekertaris['nik']?></span>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    <table class="content">
        <tr>
            <td colspan="4">VIII. KEPUTUSAN PEJABAT YANG BERWENANG MEMBERIKAN CUTI**</td>
        </tr>
        <tr>
            <td>DISETUJUI</td>
            <td>PERUBAHAN****</td>
            <td>DITANGGUHKAN****</td>
            <td>TIDAK DISETUJUI****</td>
        </tr>
        <tr>
            <td align="center"><?=$data['status_ketua']=='Approved'?'<strong>&#8730</strong>':''?></td>
            <td align="center"></td>
            <td align="center"><?=$data['status_ketua']=='Pending'?'<strong>&#8730</strong>':''?></td>
            <td align="center"><?=$data['status_ketua']=='Rejected'?'<strong>&#8730</strong>':''?></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td colspan="2" align="right">
                <table class="footer">
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
                        <td>
                        <span class="bold underline"><?=$ketua['nama']?></span><br>
                        <span><?=$ketua['nik']?></span>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    <table>
        <tr>
            <td colspan="2"><strong class="underline">Catatan:</strong></td>
        </tr>
        <tr>
            <td>*</td>
            <td>Coret yang tidak perlu</td>
        </tr>
        <tr>
            <td>**</td>
            <td>Pilih salah satu dengan memberi tanda centang</td>
        </tr>
        <tr>
            <td>***</td>
            <td>Diisi oleh pejabat yang menangani bidang kepegawaian sebelum PNS mengajukan cuti</td>
        </tr>
        <tr>
            <td>****</td>
            <td>Diberi tanda centang dan alasannya</td>
        </tr>
        <tr>
            <td>N</td>
            <td> = Cuti tahun berjalan</td>
        </tr>
        <tr>
            <td>N-1</td>
            <td> = Sisa cuti 1 tahun sebelumnya</td>
        </tr>
        <tr>
            <td>N-2</td>
            <td> = Sisa cuti 2 tahun sebelumnya</td>
        </tr>
    </table>
    <page_break>
    <table style="width: 100%;">
        <tr>
            <td></td>
            <td style="width: 40%; text-align: right;">
            Pacitan, <?=tanggal_indo(date('Y-m-d'))?>
            </td>
        </tr>
    </table>
    <br>
    <br>
    <div style="text-align: center;">
        <span><strong><u>IZIN PELAKSANAAN CUTI TAHUNAN</u></strong></span><br>
        <span>NOMOR : W14-U23 / &nbsp;&nbsp;&nbsp;&nbsp; / KP.05.2 / 11 / 2020</span>
    </div>
    <div style="text-align: left;">
        <ol>
            <li>
                Diberikan izin untuk melaksanakan Cuti Tahunan kepada Pegawai Negeri Sipil :
                <table style="width: 100%;">
                    <tr>
                        <td>Nama</td>
                        <td> : <?=$data['nama_karyawan']?></td>
                    </tr>
                    <tr>
                        <td>NIP</td>
                        <td> : <?=$data['nik']?></td>
                    </tr>
                    <tr>
                        <td>Pangkat/ golongan ruang</td>
                        <td> : </td>
                    </tr>
                    <tr>
                        <td>Jabatan</td>
                        <td> : <?=$data['nama_jabatan']?></td>
                    </tr>
                    <tr>
                        <td>Unit Kerja</td>
                        <td> : Pengadilan Negeri Pacitan Kelas II</td>
                    </tr>
                </table>
                <br>
                <p>Selama 1 ( satu  ) hari, tanggal 06 November 2020, dengan ketentuan sebagai berikut :</p>
                <ol type="I">
                    <li>Sebelum menjalankan Cuti Tahunan, wajib menyerahkan pekerjaannya kepada atasan langsungnya atau pejabat lain yang ditunjuk.</li>
                    <li>Setelah selesai menjalankan Cuti Tahunan, wajib melaporkan diri kepada atasan langsungnya dan bekerja kembali sebagaimana biasa.</li>
                </ol>
            </li>
            <li>
            Demikian izin untuk melaksanakan Cuti Tahunan ini dibuat untuk dapat digunakan sebagaimana mestinya.
            </li>
        </ol>
    </div>
    <br>
    <table style="width: 100%;">
        <tr>
            <td></td>
            <td style="width: 40%;">
                <table class="footer">
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
                        <td>
                        <span class="bold underline"><?=$ketua['nama']?></span><br>
                        <span><?=$ketua['nik']?></span>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    <div>
        <span><u>TEMBUSAN</u></span>
        <ol>
            <li>
                Yth. Sekretaris Mahkamah Agung Republik Indonesia <br>Di- Jakarta
            </li>
            <li>Yth. Ketua Pengadilan Tinggi Surabaya <br>Di- Surabaya</li>
            <li>Pertinggal</li>
        </ol>
    </div>
</body>
</html>