
<?php
if(isset($_GET['aksi']) == 'delete'){
$id = $_GET['id'];

$sql = mysqli_query($koneksi, "SELECT * FROM cuti WHERE kode='$id'");
if(mysqli_num_rows($sql) == 0){
  //header("Location: cuti.php");
  echo '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> Data tidak ditemukan.</div>';
}else{
  $row = mysqli_fetch_assoc($sql);
}
$jumlah= $row['jumlah'];
$cek = mysqli_query($koneksi, "SELECT * FROM cuti WHERE kode='$id'");
if(mysqli_num_rows($cek) == 0){
  echo '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> Data tidak ditemukan.</div>';
}else{

  $delete = mysqli_query($koneksi, "DELETE FROM cuti WHERE kode='$id'");

  $qu	   = mysqli_query($koneksi, "UPDATE karyawan SET jumlah_cuti=(jumlah_cuti+'$jumlah') WHERE nik='$nik'");
  if($delete&&$qu){
    echo '<div class="alert alert-primary alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> Data berhasil dihapus.</div>';
  }else{
    echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> Data gagal dihapus.</div>';
  }
}
}
$query1="SELECT cuti.*, jenis_cuti.nama_cuti, karyawan.nama as nama_karyawan from cuti left join karyawan on cuti.nik=karyawan.nik inner join jenis_cuti on cuti.jenis_cuti=jenis_cuti.id_cuti";
$tampil=mysqli_query($koneksi, $query1) or die(mysqli_error($koneksi));
?>
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Cuti
    <small>PEGAWAI</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="index.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li class="active">Cuti</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <!-- Main row -->
  <div class="row">
    <!-- Left col -->
    <section class="col-lg-12 connectedSortable">

      <!-- TO DO List -->
      <div class="box box-primary">
        <div class="box-header">
          <i class="ion ion-clipboard"></i>
          <h3 class="box-title">Data Cuti Pegawai</h3>
          <div class="box-tools pull-right">
            <a href="index.php?page=input-cuti" class="btn btn-sm btn-primary <?=$_SESSION['level'] == 1?'hidden':''?>"><i class="fa fa-plus"></i> Buat Cuti</a>
          </div>
        </div><!-- /.box-header -->
        <div class="box-body">
          <!-- <a href="cuti_exportxls.php" class="btn btn-sm btn-success"><i class="fa fa-file"></i> Export Excel</a><br /><br /> -->
          <table id="lookup" class="table table-bordered table-hover">
            <thead bgcolor="eeeeee" align="center">
              <tr>
                <th>Kode</th>
                <th>NIP</th>
                <th>Nama</th>
                <th>Tanggal Awal</th>
                <th>Tanggal Akhir</th>
                <th>Jumlah</th>
                <th>Jenis Cuti</th>
                <th>Status Kepala</th>
                <th>Status Sekertaris </th>
                <th>Status Ketua</th>
                <th class="text-center"> Action </th>
              </tr>
            </thead>
            <tbody>
            <?php $no=0; while($data=mysqli_fetch_array($tampil)) { $no++; ?>
              <tr>
                <td><?=$data['kode']?></td>
                <td><?=$data['nik']?></td>
                <td><?=$data['nama_karyawan']?></td>
                <td><?=$data['tanggal_awal']?></td>
                <td><?=$data['tanggal_akhir']?></td>
                <td><?=$data['jumlah']?></td>
                <td><?=$data['nama_cuti']?></td>
                <td><?=$data['status_kepala']?></td>
                <td><?=$data['status_sekertaris']?></td>
                <td><?=$data['status_ketua']?></td>
                <td>
                  <a href="index.php?page=detail-cuti&id=<?=$data['kode']?>"  data-toggle="tooltip" title="View Detail" class="btn btn-sm btn-success"> <i class="glyphicon glyphicon-search"></i> </a>
                  <?php if($_SESSION['level']=='admin'): ?>
                  <a href="index.php?page=cuti&aksi=delete&id=<?=$data['kode']?>"  data-toggle="tooltip" title="Delete" onclick="return confirm(\'Anda yakin akan menghapus data?\')" class="btn btn-sm btn-danger"> <i class="glyphicon glyphicon-trash"> </i> </a>
                  <?php endif; ?>
                </td>
              </tr>
            <?php } ?>
            </tbody>
          </table>
        </div><!-- /.box-body -->
      </div><!-- /.box -->

    </section><!-- /.Left col -->
  </div><!-- /.row (main row) -->

</section><!-- /.content -->
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables/dataTables.bootstrap.min.js"></script>
 <script>
$(document).ready(function() {
  var dataTable = $('#lookup').DataTable();
} );
</script>
