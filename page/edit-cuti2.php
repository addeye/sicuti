<?php include "session.php"; ?>
<!DOCTYPE html>
<html>
  <?php include "head.php"; ?>
  <body class="hold-transition skin-purple sidebar-mini">
    <div class="wrapper">

      <?php include "header.php"; ?>
      <!-- Left side column. contains the logo and sidebar -->
      <?php include "menu.php"; ?>

<?php include "waktu.php"; ?>
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Karyawan
            <small>Human Resource Mangement System</small>
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
                  <h3 class="box-title">EDIT DATA PEGAWAI</h3>
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


    <?php
    $kd = $_GET['id'];
$sql = mysqli_query($koneksi, " SELECT * FROM cuti WHERE kode='$kd'");
if(mysqli_num_rows($sql) == 0){
header("Location: cuti.php");
}else{
$row = mysqli_fetch_assoc($sql);
}
if(isset($_POST['update'])){
  $kode           = $_POST['kode'];
  $nik          = $_POST['nik'];
  $nama          = $_POST['nama'];
  $tanggal_awal = $_POST['tanggal_awal'];
  $tanggal_akhir    = $_POST['tanggal_akhir'];
  $jumlah       = $_POST['jumlah'];
  $jenis_cuti   = $_POST['jenis_cuti'];
  $ket      = $_POST['ket'];
  $status      = $_POST['status'];


$update = mysqli_query($koneksi, "UPDATE cuti SET nik='$nik', tanggal_awal='$tanggal_awal', tanggal_akhir='$tanggal_akhir', jumlah='$jumlah', jenis_cuti='$jenis_cuti', ket='$ket', status='$status', WHERE kode='$kd'") or die(mysqli_error($koneksi));
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
      <div class="box-body">
        <div class="form-panel">
            <form class="form-horizontal style-form" action="input-cuti.php" method="post" enctype="multipart/form-data" name="form1" id="form1">
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Kode</label>
                    <div class="col-sm-4">
                        <input name="kode" type="text" id="kode" class="form-control" placeholder="Tidak perlu di isi" value="<?php echo $row['kode']; ?>" autofocus="on" readonly="readonly" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">NIP</label>
                    <div class="col-sm-4">
                        <input name="nik" type="text" id="nik" class="form-control" placeholder="Tidak perlu di isi" value="<?php echo $row['nik']; ?>" autofocus="on" readonly="readonly" />
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Tanggal Awal Cuti</label>
                    <div class="col-sm-4">
                    <input type='text' class="input-group date form-control" data-date="" data-date-format="yyyy-mm-dd" name='tanggal_awal' id="tanggal_awal" placeholder='Tanggal Awal Cuti' value="<?php echo $row['tanggal_awal']; ?>" autocomplete='off' required='required'/>

                  </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Tanggal akhir Cuti</label>
                    <div class="col-sm-4">
                    <input type='text' class="input-group date form-control" data-date="" data-date-format="yyyy-mm-dd" name='tanggal_akhir' id="tanggal_akhir" placeholder='Tanggal Akhir Cuti' value="<?php echo $row['tanggal_akhir']; ?>" autocomplete='off' required='required' />

                  </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Jumlah Cuti</label>
                    <div class="col-sm-8">
                        <input name="jumlah" type="text" id="jumlah" class="form-control" placeholder="Jumlah" value="<?php echo $row['jumlah']; ?>" autocomplete="off" required />
                        <!--<span class="help-block">A block of help text that breaks onto a new line and may extend beyond one line.</span>-->
                    </div>
                </div>



                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Jenis Cuti</label>
                    <div class="col-sm-4">
                    <select name="jenis_cuti" id="jenis_cuti" class="form-control select2" required>
                    <option value=""> --- Pilih Jenis Cuti --- </option>

                    <?php
          $query2="select * from jenis_cuti order by id_cuti";
          $tampil=mysqli_query($koneksi, $query2) or die(mysqli_error($koneksi));
          while($data1=mysqli_fetch_array($tampil))
          {
          ?>

    <option value="<?php echo $data1['nama_cuti'];?>"><?php echo $data1['nama_cuti'];?></option>
      <?php } ?>

                    </select>
                  </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Keterangan</label>
                    <div class="col-sm-10">
                        <input name="ket" type="text" id="ket" class="form-control" placeholder="Keterangan" value="<?php echo $row['ket']; ?>" autocomplete="off" required />
                        <!--<span class="help-block">A block of help text that breaks onto a new line and may extend beyond one line.</span>-->
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Status</label>
                    <div class="col-sm-4">
                        <select name='status' id='status' class='form-control' required>
                            <option value="">-- Pilih Status --</option>
                            <option value="Approved">Approved</option>
                            <option value="Rejected">Rejected</option>
                            <option value="Pending">Pending</option>
                        </select>
                    </div>
                </div>

                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label"></label>
                              <div class="col-sm-10">
                                  <input type="submit" name="update" value="Simpan" class="btn btn-sm btn-primary" />&nbsp;
	                              <a href="cuti.php" class="btn btn-sm btn-danger">Batal </a>
                              </div>
                          </div>
                      </form>
                </div><!-- /.box-body -->
              </div><!-- /.box -->

            </section><!-- /.Left col -->
          </div><!-- /.row (main row) -->

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
      <?php include "footer.php"; ?>

      <?php include "sidecontrol.php"; ?>
      <!-- Add the sidebar's background. This div must be placed
           immediately after the control sidebar -->
      <div class="control-sidebar-bg"></div>
    </div><!-- ./wrapper -->


   <script src="../plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="../bootstrap/js/bootstrap.min.js"></script>
    <!-- DataTables -->
    <script src="../plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="../plugins/datatables/dataTables.bootstrap.min.js"></script>
    <!-- SlimScroll -->
    <script src="../plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <!-- FastClick -->
    <script src="../plugins/fastclick/fastclick.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../dist/js/app.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="../dist/js/demo.js"></script>

    <script src="../plugins/datepicker/bootstrap-datepicker.js"></script>

    <script src="../plugins/select2/select2.full.min.js"></script>

    <script>
	//options method for call datepicker
	$(".input-group.date").datepicker({ autoclose: true, todayHighlight: true });

    </script>

  <script>
     $(function () {
    $(".select2").select2();
    });
    </script>
  </body>
</html>
