<?php
if(isset($_POST['simpan'])){
$id  = $_POST['id'];
$departemen = $_POST['departemen'];

$query = mysqli_query($koneksi, "INSERT INTO departemen (id_dept, nama_dept) VALUES ('$id', '$departemen')");
if ($query){
	echo "<script>alert('Data Berhasil dimasukan!'); window.location = 'index.php?page=departemen'</script>";
} else {
	echo "<script>alert('Data Gagal dimasukan!'); window.location = 'index.php?page=departemen'</script>";
}
}

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
          <h3 class="box-title">Input Data Departemen</h3>
        </div><!-- /.box-header -->

        <div class="box-body">
          <div class="form-panel">
              <form class="form-horizontal style-form" method="post" enctype="multipart/form-data" name="form1" id="form1">
                  <div class="form-group">
                      <label class="col-sm-2 col-sm-2 control-label">Id Departemen</label>
                      <div class="col-sm-8">
                          <input name="id" type="text" id="id" class="form-control" placeholder="Tidak perlu di isi" value="<?php $a="D"; $b=rand(1000,10000); $c=$a.$b; echo $c; ?>" autofocus="on" readonly="readonly" />
                      </div>
                  </div>
                  <div class="form-group">
                      <label class="col-sm-2 col-sm-2 control-label">Departemen</label>
                      <div class="col-sm-8">
                          <input name="departemen" type="text" id="departemen" class="form-control" placeholder="Departemen" autocomplete="off" required />
                          <!--<span class="help-block">A block of help text that breaks onto a new line and may extend beyond one line.</span>-->
                      </div>
                  </div>
                  <div class="form-group">
                      <label class="col-sm-2 col-sm-2 control-label"></label>
                      <div class="col-sm-10">
                          <input type="submit" name="simpan" value="Simpan" class="btn btn-sm btn-primary" />&nbsp;
                          <a href="index.php?page=input-departemen" class="btn btn-sm btn-danger">Batal </a>
                      </div>
                  </div>
              </form>
          </div>
        </div><!-- /.box-body -->
        <!-- <div class="box-footer clearfix no-border">
          <a href="#" class="btn btn-default pull-right"><i class="fa fa-plus"></i> Tambah Admin</a>
        </div> -->
      </div><!-- /.box -->

    </section><!-- /.Left col -->
  </div><!-- /.row (main row) -->

</section><!-- /.content -->