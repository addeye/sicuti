<?php
if(isset($_POST['simpan'])){
    $kode          = $_POST['kode'];

    if($_SESSION['level']!='admin'){
    $nik = $_SESSION['nik'];
    }else{
    $nik = $_POST['nik'];
    }

    $tanggal_awal  = $_POST['tanggal_awal'];
    $tanggal_akhir = $_POST['tanggal_akhir'];
    $ket           = $_POST['ket'];

    $query = mysqli_query($koneksi, "INSERT INTO izin (kode, nik, tanggal_awal, tanggal_akhir, ket) VALUES ('$kode', '$nik', '$tanggal_awal', '$tanggal_akhir', '$ket')");

    if ($query){
    echo "<script>alert('izin berhasil di buat!'); window.location = 'index.php?page=izin'</script>";
    //echo '<div class="alert alert-info alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Data berhasil disimpan.</div>';
    }else{
    echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Data gagal disimpan, silahkan coba lagi.</div>';
    }
}
$sqlKarayawan="select nik,nama from karyawan where level!=1";
$hasilKaryawan=mysqli_query($koneksi,$sqlKarayawan);
?>
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Izin
    <small>|</small>
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
          <h3 class="box-title">Input Data Izin</h3>
        </div><!-- /.box-header -->

        <div class="box-body">
          <div class="form-panel">
              <form class="form-horizontal style-form" method="post" enctype="multipart/form-data" name="form1" id="form1">
                  <div class="form-group">
                      <label class="col-sm-2 col-sm-2 control-label">Kode</label>
                      <div class="col-sm-2">
                          <input name="kode" type="text" id="kode" class="form-control" placeholder="Tidak perlu di isi" value="<?php $a="IZ"; $b=rand(1000,10000); $c=$a.$b; echo $c; ?>" autofocus="on" readonly="readonly" />
                      </div>
                  </div>
                  <?php if($_SESSION['level']=='admin'): ?>
                    <div class="form-group">
                      <label class="col-sm-2 col-sm-2 control-label">Pegawai</label>
                      <div class="col-sm-4">
                      <select name="nik" id="nik" class="form-control select2" required>
                      <option value=""> --- Pilih NIP --- </option>
                      <?php $no=0; while ($data3 = mysqli_fetch_array($hasilKaryawan)) { $no++; ?>
                      <option value="<?php echo $data3['nik'];?>"><?php echo $data3['nik'];?> - <?php echo $data3['nama'];?></option>
                      <?php } ?>
                      </select>
                    </div>
                  </div>
                  <?php endif; ?>

                  <div class="form-group">
                      <label class="col-sm-2 col-sm-2 control-label">Tanggal Awal Izin</label>
                      <div class="col-sm-4">
                      <input type='text' class="input-group date form-control" data-date="" data-date-format="yyyy-mm-dd" name='tanggal_awal' id="tanggal_awal" placeholder='Tanggal Awal Cuti' autocomplete='off' required='required'/>

                    </div>
                  </div>

                  <div class="form-group">
                      <label class="col-sm-2 col-sm-2 control-label">Tanggal Akhir Izin</label>
                      <div class="col-sm-4">
                      <input type='text' class="input-group date form-control" data-date="" data-date-format="yyyy-mm-dd" name='tanggal_akhir' id="tanggal_akhir" placeholder='Tanggal Akhir Cuti' autocomplete='off' required='required' />

                    </div>
                  </div>
                  <div class="form-group">
                      <label class="col-sm-2 col-sm-2 control-label">Keterangan</label>
                      <div class="col-sm-5">
                          <textarea name="ket" id="ket" class="form-control" placeholder="Keterangan" required></textarea>
                      </div>
                  </div>
                  <div class="form-group">
                      <label class="col-sm-2 col-sm-2 control-label"></label>
                      <div class="col-sm-10">
                          <input type="submit" name="simpan" value="Simpan" class="btn btn-sm btn-primary" />
                          <a href="index.php?page=izin" class="btn btn-sm btn-danger">Batal </a>
                      </div>
                  </div>
              </form>
          </div>
        </div><!-- /.box-body -->
      </div><!-- /.box -->

    </section><!-- /.Left col -->
  </div><!-- /.row (main row) -->

</section><!-- /.content -->

<script src="plugins/datepicker/bootstrap-datepicker.js"></script>

<script src="plugins/select2/select2.full.min.js"></script>

<script>
//options method for call datepicker
$(".input-group.date").datepicker({ autoclose: true, todayHighlight: true });

</script>

<script>
  $(function () {
$(".select2").select2();
});
</script>
