<?php
$kd = $_GET['kd'];
$sql = mysqli_query($koneksi, "SELECT * FROM jabatan WHERE id_jabatan='$kd'");
if(mysqli_num_rows($sql) == 0){
  header("Location: index.php?page=jabatan");
}else{
  $row = mysqli_fetch_assoc($sql);
}
if(isset($_POST['update'])){
  $id_jabatan  = $_POST['id_jabatan'];
          $jabatan     = $_POST['jabatan'];
          $tunjangan   = $_POST['tunjangan'];

  $update = mysqli_query($koneksi, "UPDATE jabatan SET jabatan='$jabatan', tunjangan='$tunjangan' WHERE id_jabatan='$kd'") or die(mysqli_error($koneksi));
  if($update){
    echo '<div class="alert alert-info alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Data berhasil disimpan.</div>';
  }else{
    echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Data gagal disimpan, silahkan coba lagi.</div>';
  }
}

//if(isset($_GET['pesan']) == 'sukses'){
//	echo '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Data berhasil disimpan.</div>';
//}
?>
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Jabatan
    <small>Human Resource Management System</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="index.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li class="active">Jabatan</li>
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
          <h3 class="box-title">Edit Data Jabatan</h3>
          <div class="box-tools pull-right">
          <!-- <form action='admin.php' method="POST">
            <div class="input-group" style="width: 230px;">
              <input type="text" name="qcari" class="form-control input-sm pull-right" placeholder="Cari Usename Atau Nama">
              <div class="input-group-btn">
                <button type="submit" class="btn btn-sm btn-default tooltips" data-placement="bottom" data-toggle="tooltip" title="Cari Data"><i class="fa fa-search"></i></button>
                <a href="admin.php" class="btn btn-sm btn-success tooltips" data-placement="bottom" data-toggle="tooltip" title="Refresh"><i class="fa fa-refresh"></i></a>
              </div>
            </div>
            </form> -->
          </div>
        </div><!-- /.box-header -->

        <div class="box-body">
        <form class="form-horizontal style-form" action="" method="post" enctype="multipart/form-data" name="form1" id="form1">
        <div class="form-group">
                      <label class="col-sm-2 col-sm-2 control-label">Id Jabatan</label>
                      <div class="col-sm-8">
                          <input name="id_jabatan" type="text" id="id_jabatan" class="form-control" placeholder="Tidak perlu di isi" value="<?php echo $row['id_jabatan']; ?>" autofocus="on" readonly="readonly" />
                      </div>
                  </div>
                  <div class="form-group">
                      <label class="col-sm-2 col-sm-2 control-label">Jabatan</label>
                      <div class="col-sm-8">
                          <input name="jabatan" type="text" id="jabatan" class="form-control" placeholder="Jabatan" value="<?php echo $row['jabatan']; ?>" autocomplete="off" required />
                          <!--<span class="help-block">A block of help text that breaks onto a new line and may extend beyond one line.</span>-->
                      </div>
                  </div>
                  <div class="form-group">
                      <label class="col-sm-2 col-sm-2 control-label">Tunjangan</label>
                      <div class="col-sm-8">
                          <input name="tunjangan" type="text" id="tunjungan" class="form-control" value="<?php echo $row['tunjangan']; ?>" placeholder="Tunjangan" autocomplete="off" required />
                          <!--<span class="help-block">A block of help text that breaks onto a new line and may extend beyond one line.</span>-->
                      </div>
                  </div>
                  <div class="form-group">
                      <label class="col-sm-2 col-sm-2 control-label"></label>
                      <div class="col-sm-10">
                          <input type="submit" name="update" value="Simpan" class="btn btn-sm btn-primary" />&nbsp;
                        <a href="index.php?page=jabatan" class="btn btn-sm btn-danger">Batal </a>
                      </div>
                  </div>
              </form>
        </div><!-- /.box-body -->
      </div><!-- /.box -->

    </section><!-- /.Left col -->
  </div><!-- /.row (main row) -->

</section><!-- /.content -->