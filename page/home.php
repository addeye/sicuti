<?php
  $tampil=mysqli_query($koneksi, "select * from karyawan order by nik desc");
  $total=mysqli_num_rows($tampil);

  $tampil3=mysqli_query($koneksi, "select * from cuti order by kode desc");
  $total3=mysqli_num_rows($tampil3);

  $tampil1=mysqli_query($koneksi, "select * from jabatan order by id_jabatan desc");
  $total1=mysqli_num_rows($tampil1);

  $tampil2=mysqli_query($koneksi, "select * from departemen order by id_dept desc");
  $total2=mysqli_num_rows($tampil2);

  if($_SESSION['level']==3){
    $queryKaryawan="SELECT * FROM karyawan WHERE departemen='$_SESSION[departemen]' AND nik!='$_SESSION[nik]'";
  }elseif($_SESSION['level']==2){
    $queryKaryawan="SELECT * FROM karyawan WHERE nik!='$_SESSION[nik]' AND level!=1";
  }elseif($_SESSION['level']==1){
    $queryKaryawan="SELECT * FROM karyawan WHERE nik!='$_SESSION[nik]'";
  }elseif($_SESSION['level']==4){
    $queryKaryawan="SELECT * FROM karyawan WHERE nik='$_SESSION[nik]'";
  }else{
    $queryKaryawan="select * from karyawan";
  }
  $tampilKaryawan=mysqli_query($koneksi, $queryKaryawan) or die(mysqli_error($koneksi));

  $queryIzin = "SELECT izin.*, karyawan.nama as nama_karyawan from izin left join karyawan on izin.nik=karyawan.nik";
  $tampilIzin=mysqli_query($koneksi, $queryIzin) or die(mysqli_error($koneksi));

  $tgl = date("Y-m-d");
  $queryCuti="select karyawan.*, cuti.* from karyawan, cuti where karyawan.nik=cuti.nik  and cuti.tanggal_awal='$tgl'";
  $tampilCuti=mysqli_query($koneksi, $queryCuti) or die(mysqli_error($koneksi));

?>
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Dashboard
    <small>Control panel</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Dashboard</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <!-- Small boxes (Stat box) -->
  <div class="row">

    <div class="col-lg-3 col-xs-6">
      <!-- small box -->
      <div class="small-box bg-aqua">
        <div class="inner">
          <h3><?php echo $total; ?></h3>
          <p>Pegawai</p>
        </div>
        <div class="icon">
          <i class="fa fa-user"></i>
        </div>
        <a href="karyawan.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div><!-- ./col -->

    <div class="col-lg-3 col-xs-6">
      <!-- small box -->
      <div class="small-box bg-green">
        <div class="inner">
          <h3><?php echo $total1; ?><!--<sup style="font-size: 20px">%</sup>--></h3>
          <p>Jabatan</p>
        </div>
        <div class="icon">
          <i class="fa fa-cubes"></i>
        </div>
        <a href="jabatan.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div><!-- ./col -->


    <div class="col-lg-3 col-xs-6">
      <!-- small box -->
      <div class="small-box bg-yellow">
        <div class="inner">
          <h3><?php echo $total2; ?></h3>
          <p>Satua Kerja</p>
        </div>
        <div class="icon">
          <i class="fa fa-cube"></i>
        </div>
        <a href="departemen.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div><!-- ./col -->

    <div class="col-lg-3 col-xs-6">
      <!-- small box -->
      <div class="small-box bg-red">
        <div class="inner">
          <h3><?php echo $total3; ?></h3>
          <p>Cuti</p>
        </div>
        <div class="icon">
          <i class="fa fa-spin fa-refresh"></i>
        </div>
        <a href="cuti.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div><!-- ./col -->

  </div><!-- /.row -->
  <!-- Main row -->
  <div class="row">
    <!-- Left col -->
    <section class="col-lg-6 connectedSortable">
      <!-- Custom tabs (Charts with tabs)-->
        <!-- TO DO List -->
      <div class="box box-primary">
        <div class="box-header">
          <i class="ion ion-clipboard"></i>
          <h3 class="box-title">Cuti Pegawai Yang Habis / Kurang</h3>
          <div class="box-tools pull-right">
          </div>
        </div><!-- /.box-header -->
        <div class="scroller box-body">
          <table id="example" class="table table-responsive table-hover table-bordered">
            <thead>
                <tr>
                  <th><center>NIP </center></th>
                  <th><center>Nama</center></th>
                  <th><center>Sisa Cuti </center></th>
                </tr>
            </thead>
            <tbody>
            <?php while($data=mysqli_fetch_array($tampilKaryawan)) { ?>
            <tr>
              <td><center><?php echo $data['nik'];?></center></td>
              <td><center><?php echo $data['nama'];?></center></td>
              <td><center><?php echo $data['jumlah_cuti'];?> Hari</center></td>
            </tr>
            <?php } ?>
            </tbody>
          </table>
        </div><!-- /.box-body -->
      </div><!-- /.box -->

      <div class="box box-primary">
        <div class="box-header">
          <i class="ion ion-clipboard"></i>
          <h3 class="box-title">Izin Pegawai</h3>
          <div class="box-tools pull-right">
          </div>
        </div><!-- /.box-header -->
        <div class="scroller box-body">
          <table id="example" class="table table-responsive table-hover table-bordered">
            <thead>
                <tr>
                  <th><center>Kode </center></th>
                  <th><center>NIP</center></th>
                  <th><center>Nama</center></th>
                  <th><center>Status </center></th>
                </tr>
            </thead>
            <tbody>
            <?php while($data=mysqli_fetch_array($tampilIzin)) { ?>
            <tr>
              <td><center><?php echo $data['kode'];?></center></td>
              <td><center><?php echo $data['nik'];?></center></td>
              <td><center><?php echo $data['nama_karyawan'];?></center></td>
              <td><center><?php echo $data['status'];?></center></td>
            </tr>
            <?php } ?>
            </tbody>
          </table>
        </div><!-- /.box-body -->
      </div><!-- /.box -->

    </section><!-- /.Left col -->
    <!-- right col (We are only adding the ID to make the widgets sortable)-->
    <section class="col-lg-6 connectedSortable">

    <div class="box box-primary">
        <div class="box-header">
          <i class="ion ion-clipboard"></i>
          <h3 class="box-title">Cuti Hari Ini</h3>
          <div class="box-tools pull-right">
          </div>
        </div><!-- /.box-header -->
        <div class="box-body">
          <table id="example" class="table table-responsive table-hover table-bordered">
          <thead>
              <tr>
                <th><center>NIP</center></th>
                <th><center>Nama</center></th>
                <th><center>Jumlah Cuti </center></th>
                <th><center>Keterangan </center></th>
              </tr>
          </thead>
          <tbody>
            <?php while($data=mysqli_fetch_array($tampilCuti)) { ?>
            <tr>
              <td><center><?php echo $data['nik'];?></center></td>
              <td><center><?php echo $data['nama'];?></center></td>
              <td><center><?php echo $data['jumlah'];?> </center></td>
              <td><center><?php echo $data['ket'];?> </center></td>
            </tr>
            <?php } ?>
          </tbody>
          </table>
        </div><!-- /.box-body -->
      </div>
    </section><!-- right col -->
  </div><!-- /.row (main row) -->

</section><!-- /.content -->