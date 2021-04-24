<?php
  $query = mysqli_query($koneksi, "SELECT * FROM karyawan WHERE nik='$_GET[id]'");
  $data  = mysqli_fetch_array($query);

  $queryjatah="SELECT jatah_cuti.id, jenis_cuti.nama_cuti, jatah_cuti.jumlah_n, jatah_cuti.jumlah_n1, jatah_cuti.jumlah_n2 FROM jatah_cuti INNER JOIN jenis_cuti ON jatah_cuti.jenis_cuti=jenis_cuti.id_cuti WHERE jatah_cuti.nik='$_GET[id]' AND jenis_cuti.sub=0";
  $jatah=mysqli_query($koneksi, $queryjatah) or die(mysqli_error($koneksi));

  $queryjatahtahunan="SELECT jatah_cuti.id, jenis_cuti.nama_cuti, jatah_cuti.jumlah_n, jatah_cuti.jumlah_n1, jatah_cuti.jumlah_n2 FROM jatah_cuti INNER JOIN jenis_cuti ON jatah_cuti.jenis_cuti=jenis_cuti.id_cuti WHERE jatah_cuti.nik='$_GET[id]' AND jenis_cuti.sub=1";
  $jatahtahunan=mysqli_query($koneksi, $queryjatahtahunan) or die(mysqli_error($koneksi));

  if(isset($_POST['simpan-jatah'])){
    // var_dump($_POST['jatah_id']);
    foreach($_POST['jumlah'] as $key=>$value){
      $id = $_POST['jatah_id'][$key];
      $query = mysqli_query($koneksi, "UPDATE jatah_cuti SET jumlah_n='$value' WHERE id='$id' ") or die(mysqli_error($koneksi));
    }
    if ($query){
      echo "<script>alert('set jatah cuti berhasil disimpan!'); window.location = 'index.php?page=detail-karyawan&id=".$data['nik']."'</script>";
    //echo '<div class="alert alert-info alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Data berhasil disimpan.</div>';
    }else{
      echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Data gagal disimpan, silahkan coba lagi.</div>';
    }
  }

  if(isset($_POST['simpan-jatah-tahunan'])){
    // var_dump($_POST['jatah_id']);
    foreach($_POST['jumlah_n'] as $key=>$value){
      $id = $_POST['jatah_id'][$key];
      $jumlah_n = $_POST['jumlah_n'][$key];
      $jumlah_n1 = $_POST['jumlah_n1'][$key];
      $jumlah_n2 = $_POST['jumlah_n2'][$key];
      $query = mysqli_query($koneksi, "UPDATE jatah_cuti SET jumlah_n='$jumlah_n', jumlah_n1='$jumlah_n1', jumlah_n2='$jumlah_n2' WHERE id='$id' ") or die(mysqli_error($koneksi));
    }
    if ($query){
      echo "<script>alert('set jatah cuti berhasil disimpan!'); window.location = 'index.php?page=detail-karyawan&id=".$data['nik']."'</script>";
    //echo '<div class="alert alert-info alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Data berhasil disimpan.</div>';
    }else{
      echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Data gagal disimpan, silahkan coba lagi.</div>';
    }
  }
?>
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Karyawan
    <small>Human Resource Management System</small>
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
          <h3 class="box-title">Detail Data Karyawan</h3>
          <div class="box-tools pull-right">

          </div>
        </div><!-- /.box-header -->
        <div class="box-body">
          <div class="form-panel">
          <table id="example" class="table table-hover table-bordered">
              <tr>
              <td>Nik</td>
              <td><?php echo $data['nik']; ?></td>
              <td rowspan="8"><img src="<?php echo $data['gambar'] ?>" class="img-rounded" height="300" width="225" style="border: 2px solid #666666;" /></td>
              </tr>
              <tr>
              <td width="250">Nama</td>
              <td width="700" colspan="1"><?php echo $data['nama']; ?></td>
              </tr>
              <tr>
              <td width="250">No Telp</td>
              <td width="700" colspan="1"><?php echo $data['telp']; ?></td>
              </tr>
              <tr>
              <td width="250">Alamat</td>
              <td width="700" colspan="1"><?php echo $data['alamat']; ?></td>
              </tr>
              <tr>
              <td>Tanggal Masuk</td>
              <td><?php echo $data['tanggal_masuk']; ?></td>
              </tr>
              <tr>
              <td>Departemen</td>
              <td><?php echo $data['departemen']; ?></td>
              </tr>
              <tr>
              <td>Jabatan</td></td>
              <td><?php echo $data['jabatan']; ?></td>
              </tr>
              <tr>
              <td>Status</td>
              <td><?php echo $data['status']; ?></td>
              </tr>
              <tr>
              <td>Jumlah Cuti</td></td>
              <td><?php echo $data['jumlah_cuti']; ?></td>
              </tr>
              <tr>
              <td>Username</td></td>
              <td><?php echo $data['username']; ?></td>
              </tr>
              <tr>
              <td>Password</td></td>
              <td><?php echo $data['password']; ?></td>
              </tr>
              <tr>
              <td>Level</td></td>
              <td><?php echo $data['level']; ?></td>
              </tr>
          </table>
          <div class="text-right">
            <a href="index.php?page=karyawan" class="btn btn-sm btn-warning">Kembali <i class="fa fa-arrow-circle-right"></i></a>
          </div>
          </div>
        </div><!-- /.box-body -->
      </div><!-- /.box -->

      <div class="box box-primary">
        <div class="box-header">
          <i class="ion ion-clipboard"></i>
          <h3 class="box-title">Jatah Cuti Pegawai</h3>
        </div><!-- /.box-header -->
        <div class="box-body">
          <?php if(mysqli_num_rows($jatah) > 0) :  ?>
            <form method="POST" class="form-panel">
          <table class="table table-hover table-bordered">
            <input type="hidden" name="simpan-jatah-tahunan">
            <input type="hidden" name="nik" value="<?=$data['nik']?>">
            <tr>
              <th>Jenis Cuti</th>
              <th>N</th>
              <th>N-1</th>
              <th>N-2</th>
              <th></th>
            </tr>
            <?php while($data=mysqli_fetch_array($jatahtahunan)) {?>
              <input type="hidden" name="jatah_id[]" value="<?=$data['id']?>">
            <tr>
              <td><?=$data['nama_cuti']?></td>
              <td><input type="number" name="jumlah_n[]" value="<?=$data['jumlah_n']?>"></td>
              <td><input type="number" name="jumlah_n1[]" value="<?=$data['jumlah_n1']?>"></td>
              <td><input type="number" name="jumlah_n2[]" value="<?=$data['jumlah_n2']?>"></td>
              <td>
                <button type="submit" class="btn btn-primary">Simpan</button>
              </td>
            </tr>
            <?php } ?>
          </table>
          </form>
          <hr>
          <form method="POST" class="form-panel">
          <table class="table table-hover table-bordered">
            <input type="hidden" name="simpan-jatah">
            <input type="hidden" name="nik" value="<?=$data['nik']?>">
            <tr>
              <th>Jenis Cuti</th>
              <th>Jumlah</th>
            </tr>
            <?php while($data=mysqli_fetch_array($jatah)) {?>
              <input type="hidden" name="jatah_id[]" value="<?=$data['id']?>">
            <tr>
              <td><?=$data['nama_cuti']?></td>
              <td><input type="number" name="jumlah[]" value="<?=$data['jumlah_n']?>"></td>
            </tr>
            <?php } ?>
            <tr>
              <td></td>
              <td><button type="submit" class="btn btn-primary">Simpan</button></td>
            </tr>
          </table>
          </form>
          <?php else: ?>
            <a href="/set-jatah.php?nik=<?=$data['nik']?>" class="btn btn-primary">Set Jatah Cuti</a>
          <?php endif; ?>
        </div><!-- /.box-body -->
      </div><!-- /.box -->

    </section><!-- /.Left col -->
  </div><!-- /.row (main row) -->

</section><!-- /.content -->