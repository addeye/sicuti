<?php
if(isset($_POST['simpan'])){
$id_cuti     = $_POST['id_cuti'];
$nama_cuti   = $_POST['nama_cuti'];

$query = mysqli_query($koneksi, "INSERT INTO jenis_cuti (id_cuti, nama_cuti) VALUES ('$id_cuti', '$nama_cuti')");
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
          <h3 class="box-title">Input Data Variabel</h3>
        </div><!-- /.box-header -->

        <div class="box-body">
          <div class="form-panel">
              <form class="form-horizontal style-form" action="input-jenis.php" method="post" enctype="multipart/form-data" name="form1" id="form1">
                  <div class="form-group">
                      <label class="col-sm-2 col-sm-2 control-label">Id Cuti</label>
                      <div class="col-sm-8">
                          <input name="id_cuti" type="text" id="id_cuti" class="form-control" placeholder="Tidak perlu di isi" value="<?php $a="VC"; $b=rand(1000,10000); $c=$a.$b; echo $c; ?>" autofocus="on" readonly="readonly" />
                      </div>
                  </div>
                  <div class="form-group">
                      <label class="col-sm-2 col-sm-2 control-label">Jenis Cuti</label>
                      <div class="col-sm-8">
                          <input name="nama_cuti" type="text" id="nama_cuti" class="form-control" placeholder="Jabatan" autocomplete="off" required />
                          <!--<span class="help-block">A block of help text that breaks onto a new line and may extend beyond one line.</span>-->
                      </div>
                  </div>

                  <div class="form-group">
                      <label class="col-sm-2 col-sm-2 control-label"></label>
                      <div class="col-sm-10">
                          <input type="submit" name="simpan" value="Simpan" class="btn btn-sm btn-primary" />&nbsp;
                        <a href="index.php?page=input-jenis" class="btn btn-sm btn-danger">Batal </a>
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