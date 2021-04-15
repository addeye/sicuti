<?php
if(isset($_POST['simpan'])){
  $id_jabatan  = $_POST['id_jabatan'];
  $jabatan     = $_POST['jabatan'];
  $tunjangan   = $_POST['tunjangan'];

  $query = mysqli_query($koneksi, "INSERT INTO jabatan (id_jabatan, jabatan, tunjangan) VALUES ('$id_jabatan', '$jabatan', '$tunjangan')");
  if ($query){
    echo '<div class="alert alert-info alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Data berhasil disimpan.</div>';
  }else{
    echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Data gagal disimpan, silahkan coba lagi.</div>';
  }
}

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
          <h3 class="box-title">Input Data Jabatan</h3>
        </div><!-- /.box-header -->

        <div class="box-body">
          <div class="form-panel">
              <form class="form-horizontal style-form" action="input-jabatan.php" method="post" enctype="multipart/form-data" name="form1" id="form1">
                  <div class="form-group">
                      <label class="col-sm-2 col-sm-2 control-label">Id Jabatan</label>
                      <div class="col-sm-8">
                          <input name="id_jabatan" type="text" id="id_jabatan" class="form-control" placeholder="Tidak perlu di isi" value="<?php $a="J"; $b=rand(1000,10000); $c=$a.$b; echo $c; ?>" autofocus="on" readonly="readonly" />
                      </div>
                  </div>
                  <div class="form-group">
                      <label class="col-sm-2 col-sm-2 control-label">Jabatan</label>
                      <div class="col-sm-8">
                          <input name="jabatan" type="text" id="jabatan" class="form-control" placeholder="Jabatan" autocomplete="off" required />
                          <!--<span class="help-block">A block of help text that breaks onto a new line and may extend beyond one line.</span>-->
                      </div>
                  </div>
                  <div class="form-group">
                      <label class="col-sm-2 col-sm-2 control-label">Tunjangan</label>
                      <div class="col-sm-8">
                          <input name="tunjangan" type="text" id="tunjungan" class="form-control" placeholder="Tunjangan" autocomplete="off" required />
                          <!--<span class="help-block">A block of help text that breaks onto a new line and may extend beyond one line.</span>-->
                      </div>
                  </div>
                  <div class="form-group">
                      <label class="col-sm-2 col-sm-2 control-label"></label>
                      <div class="col-sm-10">
                          <input type="submit" name="simpan" value="Simpan" class="btn btn-sm btn-primary" />&nbsp;
                        <a href="index.php?page=jabatan" class="btn btn-sm btn-danger">Batal </a>
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
  </div>
</section>