<?php
if(isset($_GET['aksi']) == 'delete'){
  $id = $_GET['id'];
  $cek = mysqli_query($koneksi, "SELECT * FROM karyawan WHERE nik='$id'");
  if(mysqli_num_rows($cek) == 0){
    echo '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> Data tidak ditemukan.</div>';
  }else{
    $delete = mysqli_query($koneksi, "DELETE FROM karyawan WHERE nik='$id'");
    if($delete){
      echo '<div class="alert alert-primary alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> Data berhasil dihapus.</div>';
    }else{
      echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> Data gagal dihapus.</div>';
    }
  }
}

if($_SESSION['level']==3){
  $query1="SELECT karyawan.*, departemen.nama_dept, jabatan.jabatan as nama_jabt, level.nama as nama_lev from karyawan left join departemen on karyawan.departemen=departemen.id_dept inner join jabatan on karyawan.jabatan=jabatan.id_jabatan inner join level on karyawan.level=level.id WHERE karyawan.departemen='$_SESSION[departemen]' AND karyawan.nik!='$_SESSION[nik]' ";
}elseif($_SESSION['level']==2){
  $query1="SELECT karyawan.*, departemen.nama_dept, jabatan.jabatan as nama_jabt, level.nama as nama_lev from karyawan left join departemen on karyawan.departemen=departemen.id_dept inner join jabatan on karyawan.jabatan=jabatan.id_jabatan inner join level on karyawan.level=level.id WHERE karyawan.nik!='$_SESSION[nik]' AND karyawan.level!=1 ";
}elseif($_SESSION['level']==1){
  $query1="SELECT karyawan.*, departemen.nama_dept, jabatan.jabatan as nama_jabt, level.nama as nama_lev from karyawan left join departemen on karyawan.departemen=departemen.id_dept inner join jabatan on karyawan.jabatan=jabatan.id_jabatan inner join level on karyawan.level=level.id WHERE karyawan.nik!='$_SESSION[nik]' ";
}else{
  $query1="SELECT karyawan.*, departemen.nama_dept, jabatan.jabatan as nama_jabt, level.nama as nama_lev from karyawan left join departemen on karyawan.departemen=departemen.id_dept inner join jabatan on karyawan.jabatan=jabatan.id_jabatan inner join level on karyawan.level=level.id";
}

$tampil=mysqli_query($koneksi, $query1) or die(mysqli_error($koneksi));
?>
<section class="content-header">
  <h1>
    Karyawan
    <small>HRMS</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="index.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li class="active">Karyawan</li>
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
          <h3 class="box-title">Data Karyawan</h3>
          <div class="box-tools pull-right">
            <a href="index.php?page=input-karyawan" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i> Tambah Karyawan</a>
          </div>
        </div><!-- /.box-header -->

        <div class="box-body">
          <!-- <a href="karyawan_importxls.php" class="btn btn-sm btn-warning"><i class="fa fa-file"></i> Import Excel</a> <a href="karyawan_exportxls.php" class="btn btn-sm btn-success"><i class="fa fa-file"></i> Export Excel</a><br /><br /> -->
          <table id="lookup" class="table table-bordered table-hover">
            <thead bgcolor="eeeeee" align="center">
              <tr>
                <th>NIK</th>
                <th>Nama</th>
                <th>Tanggal Masuk</th>
                <th>Dept</th>
                <th>Jabatan</th>
                <th>Status</th>
                <th>Sisa Cuti</th>
                <th>Level</th>
                <th class="text-center"> Action </th>
              </tr>
            </thead>
            <tbody>
            <?php $no=0; while($data=mysqli_fetch_array($tampil)) { $no++; ?>
              <tr>
                <td><?=$data['nik']?></td>
                <td><?=$data['nama']?></td>
                <td><?=$data['tanggal_masuk']?></td>
                <td><?=$data['nama_dept']?></td>
                <td><?=$data['nama_jabt']?></td>
                <td><?=$data['status']?></td>
                <td><?=$data['jumlah_cuti']?></td>
                <td><?=$data['nama_lev']?></td>
                <td>
                  <a href="index.php?page=detail-karyawan&id=<?=$data['nik']?>"  data-toggle="tooltip" title="View Detail" class="btn btn-sm btn-success"> <i class="glyphicon glyphicon-search"></i> </a>
                  <?php if($_SESSION['level']=='admin'): ?>
                    <a href="index.php?page=edit-karyawan&id=<?=$data['nik']?>"  data-toggle="tooltip" title="Edit" class="btn btn-sm btn-primary"> <i class="glyphicon glyphicon-edit"></i> </a>
                    <a href="index.php?page=karyawan&aksi=delete&id=<?=$data['nik']?>"  data-toggle="tooltip" title="Delete" onclick="return confirm(\'Anda yakin akan menghapus data?\')" class="btn btn-sm btn-danger"> <i class="glyphicon glyphicon-trash"> </i> </a>
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
         <!-- DataTables -->
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables/dataTables.bootstrap.min.js"></script>

<script>
$(document).ready(function() {
  var dataTable = $('#lookup').DataTable();
});
</script>