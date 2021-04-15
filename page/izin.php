
<?php
if(isset($_GET['aksi']) == 'delete'){
    $id = $_GET['id'];

    $delete = mysqli_query($koneksi, "DELETE FROM izin WHERE kode='$id'");

    $qu	   = mysqli_query($koneksi, "UPDATE karyawan SET jumlah_cuti=(jumlah_cuti+'$jumlah') WHERE nik='$nik'");
    if($delete&&$qu){
        echo '<div class="alert alert-primary alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> Data berhasil dihapus.</div>';
    }else{
        echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> Data gagal dihapus.</div>';
    }
}
$query1="SELECT izin.*, karyawan.nama as nama_karyawan from izin left join karyawan on izin.nik=karyawan.nik";
$tampil=mysqli_query($koneksi, $query1) or die(mysqli_error($koneksi));
?>
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Izin
    <small>PEGAWAI</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="index.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li class="active">Izin</li>
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
          <h3 class="box-title">Data Izin Pegawai</h3>
          <div class="box-tools pull-right">
          </div>
        </div><!-- /.box-header -->
        <div class="box-body">
          <a href="izin_exportxls.php" class="btn btn-sm btn-success"><i class="fa fa-file"></i> Export Excel</a><br /><br />
          <table id="lookup" class="table table-bordered table-hover">
            <thead bgcolor="eeeeee" align="center">
              <tr>
                <th>Kode</th>
                <th>NIP</th>
                <th>Nama</th>
                <th>Tanggal Awal</th>
                <th>Tanggal Akhir</th>
                <th>Keterangan</th>
                <th>Status</th>
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
                <td><?=$data['ket']?></td>
                <td><?=$data['status']?></td>
                <td>
                  <a href="index.php?page=detail-izin&id=<?=$data['kode']?>"  data-toggle="tooltip" title="View Detail" class="btn btn-sm btn-success"> <i class="glyphicon glyphicon-search"></i> </a>
                  <?php if($_SESSION['level']=='admin'): ?>
                  <a href="index.php?page=izin&aksi=delete&id=<?=$data['kode']?>"  data-toggle="tooltip" title="Delete" onclick="return confirm(\'Anda yakin akan menghapus data?\')" class="btn btn-sm btn-danger"> <i class="glyphicon glyphicon-trash"> </i> </a>
                  <?php endif; ?>
                </td>
              </tr>
            <?php } ?>
            </tbody>
          </table>
        </div><!-- /.box-body -->
        <div class="box-footer clearfix no-border <?=$_SESSION['level']==1?'hidden':''?> ">
          <a href="index.php?page=input-izin" class="btn btn-sm btn-default pull-right"><i class="fa fa-plus"></i> Buat Cuti</a>
        </div>
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
