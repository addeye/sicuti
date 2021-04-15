<?php
$kd = $_GET['kd'];
$sql = mysqli_query($koneksi, "SELECT * FROM departemen WHERE id_dept='$kd'");
if(mysqli_num_rows($sql) == 0){
  header("Location: departemen.php");
}else{
  $row = mysqli_fetch_assoc($sql);
}
if(isset($_POST['update'])){
  $id_dept   = $_POST['id_dept'];
  $nama_dept = $_POST['nama_dept'];

  $update = mysqli_query($koneksi, "UPDATE departemen SET nama_dept='$nama_dept' WHERE id_dept='$kd'") or die(mysqli_error($koneksi));
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
    Departemen
    <small>Human Resource Management System</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="index.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li class="active">Departemen</li>
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
          <h3 class="box-title">Edit Data Departemen</h3>
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
                      <label class="col-sm-2 col-sm-2 control-label">Id Departemen</label>
                      <div class="col-sm-4">
                          <input name="id_dept" type="text" id="id_dept" class="form-control" value="<?php echo $row['id_dept']; ?>" placeholder="Auto Number" autocomplete="off" autofocus="on" readonly="readonly" />
                      </div>
                  </div>
                  <div class="form-group">
                      <label class="col-sm-2 col-sm-2 control-label">Nama Departemen</label>
                      <div class="col-sm-4">
                    <input name="nama_dept" type="text" id="nama_dept" class="form-control" value="<?php echo $row['nama_dept']; ?>" placeholder="Nama Customer" autocomplete="off" required />

                    </div>
                  </div>
                  <div class="form-group">
                      <label class="col-sm-2 col-sm-2 control-label"></label>
                      <div class="col-sm-10">
                          <input type="submit" name="update" value="Simpan" class="btn btn-sm btn-primary" />&nbsp;
                          <a href="index.php?page=departemen" class="btn btn-sm btn-danger">Batal </a>
                      </div>
                  </div>
              </form>
        </div><!-- /.box-body -->
      </div><!-- /.box -->

    </section><!-- /.Left col -->
  </div><!-- /.row (main row) -->

</section><!-- /.content -->