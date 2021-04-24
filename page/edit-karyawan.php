<?php
$kd = $_GET['id'];
$sql = mysqli_query($koneksi, "SELECT * FROM karyawan WHERE nik='$kd'");
if(mysqli_num_rows($sql) == 0){
  header("Location: index.php?page=karyawan");
}else{
  $row = mysqli_fetch_assoc($sql);
}
if(isset($_POST['update'])){

  $namafolder="uploads/profile/"; //tempat menyimpan file

  $nik           = $_POST['nik'];
  $nama          = $_POST['nama'];
  $telp          = $_POST['telp'];
  $alamat          = $_POST['alamat'];
  $tanggal_masuk = $_POST['tanggal_masuk'];
  $departemen    = $_POST['departemen'];
  $jabatan       = $_POST['jabatan'];
  $jumlah_cuti   = $_POST['jumlah_cuti'];
  $username      = $_POST['username'];

  $level         = $_POST['level'];
  $status        = $_POST['status'];
  $gambar        = $row['gambar'];

  if($_POST['password'] != ''){
    $password      = sha1($_POST['password']);
  }else{
    $password      = $row['password'];
  }

  if (!empty($_FILES["nama_file"]["tmp_name"])){
    $jenis_gambar=$_FILES['nama_file']['type'];

    if($jenis_gambar=="image/jpeg" || $jenis_gambar=="image/jpg" || $jenis_gambar=="image/gif" || $jenis_gambar=="image/x-png"){
      $gambar = $namafolder . basename($_FILES['nama_file']['name']);
      move_uploaded_file($_FILES['nama_file']['tmp_name'], $gambar);
    } else {
      echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Jenis gambar yang anda kirim salah. Harus .jpg .gif .png</div>';
      return false;
    }
  }

  $sql="UPDATE karyawan SET nama='$nama', tanggal_masuk='$tanggal_masuk', departemen='$departemen', jabatan='$jabatan', status='$status', jumlah_cuti='$jumlah_cuti',  username='$username',  password='$password',  level='$level', gambar='$gambar', telp='$telp', alamat='$alamat' WHERE nik='$kd'";
  $res=mysqli_query($koneksi, $sql) or die (mysqli_error($koneksi));
  if($res){
    echo "<script>alert('Data berhasil dimasukan!'); window.location = 'index.php?page=edit-karyawan&id=".$row['nik']."'</script>";
  }else{
    echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Data gagal disimpan, silahkan coba lagi.</div>';
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
          <h3 class="box-title">Edit Data Karyawan</h3>
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
        <form class="form-horizontal style-form" method="post" enctype="multipart/form-data" name="form1" id="form1">
        <div class="form-group">
                      <label class="col-sm-2 col-sm-2 control-label">NIK</label>
                      <div class="col-sm-4">
                          <input name="nik" type="text" id="nik" class="form-control" placeholder="NIK" value="<?php echo $row['nik']; ?>" autocomplete="off" autofocus="on" required="required" />
                      </div>
                  </div>
                  <div class="form-group">
                      <label class="col-sm-2 col-sm-2 control-label">Nama Karyawan</label>
                      <div class="col-sm-4">
                    <input name="nama" type="text" id="nama" class="form-control" value="<?php echo $row['nama']; ?>" placeholder="Nama Karyawan" autocomplete="off" required />

                    </div>
                  </div>
                  <div class="form-group">
                      <label class="col-sm-2 col-sm-2 control-label">No Telp</label>
                      <div class="col-sm-4">
                        <input name="telp" type="number" id="telp" class="form-control" placeholder="Nomor Telp" value="<?=$row['telp']?>" autocomplete="off" required />
                      </div>
                  </div>
                  <div class="form-group">
                      <label class="col-sm-2 col-sm-2 control-label">Alamat</label>
                      <div class="col-sm-4">
                        <textarea name="alamat" id="alamat" class="form-control" placeholder="Masukkan alamat..." required><?=$row['alamat']?></textarea>
                      </div>
                  </div>
                  <div class="form-group">
                      <label class="col-sm-2 col-sm-2 control-label">Tanggal Masuk</label>
                      <div class="col-sm-4">
                      <input type='text' class="input-group date form-control" value="<?php echo $row['tanggal_masuk']; ?>" data-date="" data-date-format="yyyy-mm-dd" name='tanggal_masuk' id="tanggal_masuk" placeholder='Tanggal Masuk' required />

                    </div>
                  </div>
                  <div class="form-group">
                      <label class="col-sm-2 col-sm-2 control-label">Departemen</label>
                      <div class="col-sm-4">
                      <select name="departemen" id="departemen" class="form-control select2">
                      <option value=""> --- Pilih Departemen --- </option>
                        <?php while($data1=mysqli_fetch_array($tampilDep)) { ?>
                        <option value="<?php echo $data1['id_dept'];?>" <?=$row['departemen']==$data1['id_dept']?'selected':''?>><?php echo $data1['id_dept'];?> - <?php echo $data1['nama_dept'];?></option>
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
                        <option value="<?php echo $data1['id_jabatan'];?>" <?=$row['jabatan']==$data1['id_jabatan']?'selected':''?> ><?php echo $data1['id_jabatan'];?> - <?php echo $data1['jabatan'];?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>

                  <div class="form-group">
                      <label class="col-sm-2 col-sm-2 control-label">Status</label>
                      <div class="col-sm-4">
                    <select name="status" id="status" class="form-control" required="required">
                    <option value="">----- Pilih Status -----</option>
                    <?php $statuskerja = $row['status']; ?>
                    <option <?=($statuskerja=='TETAP')?'selected="selected"':''?>>TETAP</option>
                    <option <?=($statuskerja=='PKWT')?'selected="selected"':''?>>PKWT</option>
                    <option <?=($statuskerja=='PKWTT')?'selected="selected"':''?>>PKWTT</option>
                    </select>
                    </div>
                  </div>

                    <div class="form-group">
                      <label class="col-sm-2 col-sm-2 control-label">Jumlah Cuti</label>
                      <div class="col-sm-4">
                    <input name="jumlah_cuti" type="text" id="jumlah_cuti" class="form-control" value="<?php echo $row['jumlah_cuti']; ?>" placeholder="Username" autocomplete="off" required />

                    </div>
                  </div>

                  <div class="form-group">
                      <label class="col-sm-2 col-sm-2 control-label">Username</label>
                      <div class="col-sm-4">
                    <input name="username" type="text" id="username" class="form-control" value="<?php echo $row['username']; ?>" placeholder="Username" autocomplete="off" required />

                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">password</label>
                    <div class="col-sm-4">
                      <input name="password" type="password" id="password" class="form-control" value=""  placeholder="Password" autocomplete="off" />
                      <p class="help-block">Kosongi password jika tidak dirubah</p>
                    </div>
                  </div>
                  <div class="form-group">
                      <label class="col-sm-2 col-sm-2 control-label">Level</label>
                      <div class="col-sm-4">
                    <select name="level" id="level" class="form-control" required="required">
                    <option value="">----- Pilih Status -----</option>
                    <?php while($data1=mysqli_fetch_array($tampilLevel)) { ?>
                        <option value="<?php echo $data1['id'];?>" <?=$row['level']==$data1['id']?'selected':''?> ><?php echo $data1['nama'];?></option>
                    <?php } ?>
                    </select>
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Gambar</label>
                    <div class="col-sm-4">
                      <?php if($row['gambar']){ ?>
                      <img src="<?=$row['gambar']?>" width="100" alt="">
                      <br><br>
                      <?php } ?>
                      <input name="nama_file" type="file" id="nama_file" class="form-control" placeholder="Password" autocomplete="off"/>
                      <p class="help-block">Kosongi gambar jika tidak dirubah</p>
                    </div>
                  </div>
                  <div class="form-group">
                      <label class="col-sm-2 col-sm-2 control-label"></label>
                      <div class="col-sm-10">
                          <input type="submit" name="update" value="Simpan" class="btn btn-sm btn-primary" />&nbsp;
                        <a href="index.php?page=karyawan" class="btn btn-sm btn-danger">Batal </a>
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
