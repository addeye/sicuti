<?php
if(isset($_POST['input'])){
  $namafolder="uploads/profile/"; //tempat menyimpan file

  if (!empty($_FILES["nama_file"]["tmp_name"])){
    $jenis_gambar=$_FILES['nama_file']['type'];
    $nik           = $_POST['nik'];
    $nama          = $_POST['nama'];
    $tanggal_masuk = $_POST['tanggal_masuk'];
    $departemen    = $_POST['departemen'];
    $jabatan       = $_POST['jabatan'];
    $status       = $_POST['status'];
    $jumlah_cuti   = $_POST['jumlah_cuti'];
    $username      = $_POST['username'];
    $password1      = $_POST['password'];
    $password      = sha1("$password1");
    $level         = $_POST['level'];

    if($jenis_gambar=="image/jpeg" || $jenis_gambar=="image/jpg" || $jenis_gambar=="image/gif" || $jenis_gambar=="image/png"){
      $gambar = $namafolder . basename($_FILES['nama_file']['name']);
      if (move_uploaded_file($_FILES['nama_file']['tmp_name'], $gambar)) {
        $sql="INSERT INTO karyawan (nik,nama,tanggal_masuk,departemen,jabatan,status,jumlah_cuti,username,password,level,gambar) VALUES
              ('$nik','$nama','$tanggal_masuk','$departemen','$jabatan','$status','$jumlah_cuti','$username','$password','$level','$gambar')";
        $res=mysqli_query($koneksi, $sql) or die (mysqli_error($koneksi));
        //echo "Gambar berhasil dikirim ke direktori".$gambar;
              echo "<script>alert('Data berhasil dimasukan!'); window.location = 'index.php?page=karyawan'</script>";
      } else {
        echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><p>Gambar gagal dikirim</p></div>';
      }
    } else {
      echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Jenis gambar yang anda kirim salah. Harus .jpg .gif .png</div>';
    }
  } else {
    echo '<div class="alert alert-warning alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Anda Belum Memilih Gambar</div>';
  }
}

$queryDep="select * from departemen order by id_dept";
$tampilDep=mysqli_query($koneksi, $queryDep) or die(mysqli_error($koneksi));

$queryJab="select * from jabatan order by id_jabatan";
$tampilJab=mysqli_query($koneksi, $queryJab) or die(mysqli_error($koneksi));

$queryLevel="select * from level";
$tampilLevel=mysqli_query($koneksi, $queryLevel) or die(mysqli_error($koneksi));
?>
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Pegawai
    <small>Pengadilan Negeri Pacitan</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="index.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li class="active">Pegawai</li>
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
          <h3 class="box-title">Input Data Pegawai</h3>
          <div class="box-tools pull-right">
          </div>
        </div><!-- /.box-header -->

        <div class="box-body">
        <form class="form-horizontal style-form" method="post" enctype="multipart/form-data" name="form1" id="form1">
                  <div class="form-group">
                      <label class="col-sm-2 col-sm-2 control-label">NIP</label>
                      <div class="col-sm-4">
                          <input name="nik" type="text" id="nik" class="form-control" placeholder="NIP" autocomplete="off" autofocus="on" required="required" />
                      </div>
                  </div>
                  <div class="form-group">
                      <label class="col-sm-2 col-sm-2 control-label">Nama Pegawai</label>
                      <div class="col-sm-4">
                    <input name="nama" type="text" id="nama" class="form-control" placeholder="Nama Pegawai" autocomplete="off" required />

                    </div>
                  </div>
                  <div class="form-group">
                      <label class="col-sm-2 col-sm-2 control-label">Tanggal Masuk</label>
                      <div class="col-sm-4">
                      <input type='text' class="input-group date form-control" data-date="" data-date-format="yyyy-mm-dd" name='tanggal_masuk' id="tanggal_masuk" placeholder='Tanggal Masuk' autocomplete='off' required='required' />

                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Departemen</label>
                    <div class="col-sm-4">
                      <select name="departemen" id="departemen" class="form-control select2" required>
                        <option value=""> --- Pilih Departemen --- </option>
                        <?php while($data1=mysqli_fetch_array($tampilDep)) { ?>
                        <option value="<?php echo $data1['id_dept'];?>"><?php echo $data1['id_dept'];?> - <?php echo $data1['nama_dept'];?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Jabatan</label>
                    <div class="col-sm-4">
                      <select name="jabatan" id="jabatan" class="form-control select2" required>
                        <option value=""> --- Pilih Jabatan --- </option>
                        <?php while($data1=mysqli_fetch_array($tampilJab)) { ?>
                        <option value="<?php echo $data1['id_jabatan'];?>"><?php echo $data1['id_jabatan'];?> - <?php echo $data1['jabatan'];?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>

                  <div class="form-group">
                      <label class="col-sm-2 col-sm-2 control-label">Jumlah Cuti</label>
                      <div class="col-sm-4">
                    <input type="text" name="jumlah_cuti" id="jumlah_cuti" class="form-control" required="required">
                    </div>
                  </div>

                  <div class="form-group">
                      <label class="col-sm-2 col-sm-2 control-label">Status</label>
                      <div class="col-sm-4">
                    <select name="status" id="status" class="form-control" required="required">
                    <option value="">----- Pilih Status -----</option>
                    <option value="TETAP">PNS</option>
                    <option value="PKWT">PPPK</option>
                    <option value="PKWTT">HONORER</option>
                    </select>
                    </div>
                  </div>

                  <div class="form-group">
                      <label class="col-sm-2 col-sm-2 control-label">Username</label>
                      <div class="col-sm-4">
                    <input name="username" type="text" id="username" class="form-control" placeholder="Username" autocomplete="off" required />

                    </div>
                  </div>
                  <div class="form-group">
                      <label class="col-sm-2 col-sm-2 control-label">password</label>
                      <div class="col-sm-4">
                    <input name="password" type="text" id="password" class="form-control" placeholder="Password" autocomplete="off" required />

                    </div>
                  </div>
                  <div class="form-group">
                      <label class="col-sm-2 col-sm-2 control-label">Level</label>
                      <div class="col-sm-4">
                    <select name="level" id="level" class="form-control" required="required">
                    <option value="">----- Pilih Level -----</option>
                    <?php while($data1=mysqli_fetch_array($tampilLevel)) { ?>
                        <option value="<?php echo $data1['id'];?>"><?php echo $data1['nama'];?></option>
                        <?php } ?>
                    </select>
                    </div>
                  </div>

                  <div class="form-group">
                      <label class="col-sm-2 col-sm-2 control-label">Gambar</label>
                      <div class="col-sm-4">
                    <input name="nama_file" type="file" id="nama_file" class="form-control" placeholder="Password" autocomplete="off" required />

                    </div>
                  </div>
                  <div class="form-group">
                      <label class="col-sm-2 col-sm-2 control-label"></label>
                      <div class="col-sm-10">
                          <input type="submit" name="input" value="Simpan" class="btn btn-sm btn-primary" />&nbsp;
                        <a href="karyawan.php" class="btn btn-sm btn-danger">Batal </a>
                      </div>
                  </div>
              </form>
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
