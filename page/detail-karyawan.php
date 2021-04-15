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
        <?php
    $query = mysqli_query($koneksi, "SELECT * FROM karyawan WHERE nik='$_GET[id]'");
    $data  = mysqli_fetch_array($query);
    ?>
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

    </section><!-- /.Left col -->
  </div><!-- /.row (main row) -->

</section><!-- /.content -->