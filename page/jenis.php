<?php
if(isset($_GET['aksi']) == 'hapus'){
$id = $_GET['kd'];
$cek = mysqli_query($koneksi, "SELECT * FROM jenis_cuti WHERE id_cuti='$id'");
if(mysqli_num_rows($cek) == 0){
  echo '<div class="alert alert-warning alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> Data tidak ditemukan.</div>';
}else{
  $delete = mysqli_query($koneksi, "DELETE FROM jenis_cuti WHERE id_cuti='$id'");
  if($delete){
    echo '<div class="alert alert-primary alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> Data berhasil dihapus.</div>';
  }else{
    echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> Data gagal dihapus.</div>';
  }
}
}

$query1="select * from jenis_cuti";

if(isset($_POST['qcari'])){
  $qcari=$_POST['qcari'];
  $query1="SELECT * FROM  jenis_cuti
  where id_cuti like '%$qcari%'
  or nama_cuti like '%$qcari%'  ";
}
$tampil=mysqli_query($koneksi, $query1) or die(mysqli_error($koneksi));
?>
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Variabel Cuti
    <small>Human Resource Management System</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="index.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li class="active">Variabel Cuti</li>
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
          <h3 class="box-title">Data Variabel Cuti</h3>
          <div class="box-tools pull-right">
          <form action='departemen.php' method="POST">
            <div class="input-group" style="width: 230px;">
              <input type="text" name="qcari" class="form-control input-sm pull-right" placeholder="Cari Jabatan">
              <div class="input-group-btn">
                <button type="submit" class="btn btn-sm btn-default tooltips" data-placement="bottom" data-toggle="tooltip" title="Cari Data"><i class="fa fa-search"></i></button>
                <a href="departemen.php" class="btn btn-sm btn-success tooltips" data-placement="bottom" data-toggle="tooltip" title="Refresh"><i class="fa fa-refresh"></i></a>
              </div>
            </div>
            </form>
          </div>
        </div><!-- /.box-header -->

        <div class="box-body">
        <!-- <form action='admin.php' method="POST">

  <input type='text' class="form-control" style="margin-bottom: 4px;" name='qcari' placeholder='Cari berdasarkan User ID dan Username' required />
    <input type='submit' value='Cari Data' class="btn btn-sm btn-primary" /> <a href='admin.php' class="btn btn-sm btn-success" >Refresh</i></a>
    </div>
    </form>-->



          <table id="example" class="table table-responsive table-hover table-bordered">
          <thead>
              <tr>
                <th><center>No </center></th>
                <th><center>Id Cuti </center></th>
                <th><center>Variabel Cuti </center></th>
              </tr>
          </thead>
              <?php
              $no=0;
              while($data=mysqli_fetch_array($tampil))
            { $no++; ?>
            <tbody>
            <tr>
            <td><center><?php echo $no; ?></center></td>
            <td><center><?php echo $data['id_cuti'];?></center></td>
            <td><center><?php echo $data['nama_cuti'];?></center></td>
            <td><center><div id="thanks"><a class="btn btn-sm btn-primary" data-placement="bottom" data-toggle="tooltip" title="Edit Jabatan" href="index.php?page=edit-jenis&aksi=edit&kd=<?php echo $data['id_cuti'];?>"><span class="glyphicon glyphicon-edit"></span></a>
                <a onclick="return confirm ('Yakin hapus <?php echo $data['nama_cuti'];?>.?');" class="btn btn-sm btn-danger tooltips" data-placement="bottom" data-toggle="tooltip" title="Hapus Jabatan" href="index.php?page=jenis&aksi=hapus&kd=<?php echo $data['id_cuti'];?>"><span class="glyphicon glyphicon-trash"></a></center></td></tr></div>
          <?php
      }
      ?>
            </tbody>
            </table>
        </div><!-- /.box-body -->
        <div class="box-footer clearfix no-border">
          <a href="index.php?page=input-jenis" class="btn btn-sm btn-default pull-right"><i class="fa fa-plus"></i> Tambah Variabel</a>
          </div>
      </div><!-- /.box -->

    </section><!-- /.Left col -->
  </div><!-- /.row (main row) -->

</section><!-- /.content -->