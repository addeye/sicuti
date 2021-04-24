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
$jumlah        = $_POST['jumlah'];
$jenis_cuti    = $_POST['jenis_cuti'];
$ket           = $_POST['ket'];
$tahun         = date('Y');
$set_n         = 0;
$set_n1         = 0;
$set_n2         = 0;

$sql = mysqli_query($koneksi, "SELECT jatah_cuti.*, jenis_cuti.sub FROM jatah_cuti LEFT JOIN jenis_cuti ON jatah_cuti.jenis_cuti=jenis_cuti.id_cuti WHERE jatah_cuti.nik='$nik' AND jatah_cuti.jenis_cuti='$jenis_cuti'")or die(mysqli_error($koneksi));
if(mysqli_num_rows($sql) == 0){
  echo "<script>alert('jatah cuti belum di set!'); window.location = 'index.php?page=cuti'</script>";
}else{
  $row = mysqli_fetch_assoc($sql);
}

$jumlah_n = $row['jumlah_n'];
$jumlah_n1 = $row['jumlah_n1'];
$jumlah_n2 = $row['jumlah_n2'];

$totalJatahCuti = $jumlah_n2 + $jumlah_n1 + $jumlah_n;

if($totalJatahCuti == 0){
  echo "<script>alert('jatah cuti sudah habis, tidak bisa membuat cuti!'); window.location = 'index.php?page=input-cuti'</script>";
}

if($totalJatahCuti < $jumlah){
  echo "<script>alert('jatah cuti tidak cukup, tidak bisa membuat cuti!'); window.location = 'index.php?page=input-cuti'</script>";
}

$jumlah_n = $row['jumlah_n'];
$jumlah_n1 = $row['jumlah_n1'];
$jumlah_n2 = $row['jumlah_n2'];
$jumlah_minta_cuti = $jumlah;

if($jumlah_n2 > 0 && $jumlah_minta_cuti > 0){
  if($jumlah_minta_cuti <= $jumlah_n2){
    $jumlah_n2 = $jumlah_n2 - $jumlah_minta_cuti;
    $jumlah_minta_cuti = 0;
  }else{
    $jumlah_minta_cuti = $jumlah_minta_cuti - $jumlah_n2;
    $jumlah_n2 = 0;
  }
  $set_n2 = 1;
}

if($jumlah_n1 > 0 && $jumlah_minta_cuti > 0){
  if($jumlah_minta_cuti <= $jumlah_n1){
    $jumlah_n1 = $jumlah_n1 - $jumlah_minta_cuti;
    $jumlah_minta_cuti = 0;
  }else{
    $jumlah_minta_cuti = $jumlah_minta_cuti - $jumlah_n1;
    $jumlah_n1 = 0;
  }
  $set_n1 = 1;
}

if($jumlah_n > 0 && $jumlah_minta_cuti > 0){
  if($jumlah_minta_cuti <= $jumlah_n){
    $jumlah_n = $jumlah_n - $jumlah_minta_cuti;
    $jumlah_minta_cuti = 0;
  }else{
    $jumlah_minta_cuti = $jumlah_minta_cuti - $jumlah_n;
    $jumlah_n = 0;
  }
  $set_n = 1;
}

$query = mysqli_query($koneksi, "INSERT INTO cuti (kode, nik, tanggal_awal, tanggal_akhir, jumlah, jenis_cuti, ket, set_n, set_n1, set_n2, tahun) VALUES ('$kode', '$nik', '$tanggal_awal', '$tanggal_akhir', '$jumlah', '$jenis_cuti', '$ket', '$set_n', '$set_n1', '$set_n2','$tahun')")or die(mysqli_error($koneksi));

$qu	   = mysqli_query($koneksi, "UPDATE jatah_cuti SET jumlah_n='$jumlah_n', jumlah_n1='$jumlah_n1', jumlah_n2='$jumlah_n2' WHERE id='$row[id]'")or die(mysqli_error($koneksi));

if($_SESSION['level']==3){
  mysqli_query($koneksi, "UPDATE cuti SET status_kepala='Approved' WHERE kode='$kode'")or die(mysqli_error($koneksi));
}elseif($_SESSION['level']==2){
  mysqli_query($koneksi, "UPDATE cuti SET status_sekertaris='Approved', status_kepala='Approved' WHERE kode='$kode'")or die(mysqli_error($koneksi));
}

if ($query&&$qu){
  echo "<script>alert('cuti $nama berhasil di buat!'); window.location = 'index.php?page=cuti'</script>";
//echo '<div class="alert alert-info alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Data berhasil disimpan.</div>';
}else{
  echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Data gagal disimpan, silahkan coba lagi.</div>';
}

}
$sqlKarayawan="select nik,nama from karyawan where level!=1";
$hasilKaryawan=mysqli_query($koneksi,$sqlKarayawan)or die(mysqli_error($koneksi));

$queryJenisCuti="select * from jenis_cuti order by id_cuti";
$tampilJenisCuti=mysqli_query($koneksi, $queryJenisCuti) or die(mysqli_error($koneksi));
?>
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Cuti
    <small>|</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="index.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li class="active">Cuti</li>
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
          <h3 class="box-title">Input Data Cuti</h3>
        </div><!-- /.box-header -->

        <div class="box-body">
          <div class="form-panel">
              <form class="form-horizontal style-form" method="post" enctype="multipart/form-data" name="form1" id="form1">
                  <div class="form-group">
                      <label class="col-sm-2 col-sm-2 control-label">Kode</label>
                      <div class="col-sm-2">
                          <input name="kode" type="text" id="kode" class="form-control" placeholder="Tidak perlu di isi" value="<?php $a="CT"; $b=rand(1000,10000); $c=$a.$b; echo $c; ?>" autofocus="on" readonly="readonly" />
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
                      <label class="col-sm-2 col-sm-2 control-label">Tanggal Awal Cuti</label>
                      <div class="col-sm-4">
                      <input type='text' onchange="calculation()" class="input-group date form-control" data-date="" data-date-format="yyyy-mm-dd" name='tanggal_awal' id="tanggal_awal" placeholder='Tanggal Awal Cuti' autocomplete='off' required='required'/>
                    </div>
                  </div>

                  <div class="form-group">
                      <label class="col-sm-2 col-sm-2 control-label">Tanggal akhir Cuti</label>
                      <div class="col-sm-4">
                      <input type='text' onchange="calculation()" class="input-group date form-control" data-date="" data-date-format="yyyy-mm-dd" name='tanggal_akhir' id="tanggal_akhir" placeholder='Tanggal Akhir Cuti' autocomplete='off' required='required' />

                    </div>
                  </div>
                  <div class="form-group">
                      <label class="col-sm-2 col-sm-2 control-label">Jumlah Cuti</label>
                      <div class="col-sm-2">
                        <div class="input-group">
                          <input name="jumlah" readonly type="number" id="jumlah" class="form-control" placeholder="Jumlah" autocomplete="off" required />
                          <span class="input-group-addon" id="basic-addon1">Hari</span>
                        </div>
                      </div>
                  </div>
                  <div class="form-group">
                      <label class="col-sm-2 col-sm-2 control-label">Jenis Cuti</label>
                      <div class="col-sm-4">
                      <select name="jenis_cuti" id="jenis_cuti" class="form-control select2" required>
                        <option value=""> --- Pilih Jenis Cuti --- </option>
                        <?php while($data1=mysqli_fetch_array($tampilJenisCuti)) { ?>
                        <option value="<?php echo $data1['id_cuti'];?>"><?php echo $data1['nama_cuti'];?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="" class="col-sm-2 col-sm-2 control-label">Kurangi Dari</label>
                    <div class="col-sm-4">
                      <label class="checkbox-inline">
                        <input type="checkbox" id="inlineCheckbox1" name="set_n2" value="1"> N-2
                      </label>
                      <label class="checkbox-inline">
                        <input type="checkbox" id="inlineCheckbox2" name="set_n1" value="1"> N-1
                      </label>
                      <label class="checkbox-inline">
                        <input type="checkbox" id="inlineCheckbox3" name="set_n" value="1"> N
                      </label>
                      <p class="help-block">Pilih jika jenis cuti tahunan</p>
                    </div>
                  </div>
                  <div class="form-group">
                      <label class="col-sm-2 col-sm-2 control-label">Alasan Cuti</label>
                      <div class="col-sm-5">
                          <textarea name="ket" id="ket" class="form-control" placeholder="Keterangan" required></textarea>
                      </div>
                  </div>
                  <div class="form-group">
                      <label class="col-sm-2 col-sm-2 control-label"></label>
                      <div class="col-sm-10">
                          <input type="submit" name="simpan" value="Simpan" class="btn btn-sm btn-primary" />;
                          <a href="index.php?page=cuti" class="btn btn-sm btn-danger">Batal </a>
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
function parseDate(str) {
    var mdy = str.split('-');
    return new Date(mdy[2], mdy[0]-1, mdy[1]);
}

function datediff(first, second) {
    // Take the difference between the dates and divide by milliseconds per day.
    // Round to nearest whole number to deal with DST.
    return Math.round((second-first)/(1000*60*60*24));
}

function calculation(){
  const date1 = new Date($('#tanggal_awal').val());
  const date2 = new Date($('#tanggal_akhir').val());
  const diffTime = Math.abs(date2 - date1);
  const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
  // console.log(diffTime + " milliseconds");
  // console.log(diffDays + " days");
  $('#jumlah').val(diffDays+1);
  // alert(diffDays);
}

</script>
