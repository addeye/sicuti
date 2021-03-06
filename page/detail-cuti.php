<?php
    $query = mysqli_query($koneksi, "SELECT cuti.*, jenis_cuti.nama_cuti, karyawan.nama as nama_karyawan, karyawan.gambar from cuti left join karyawan on cuti.nik=karyawan.nik inner join jenis_cuti on cuti.jenis_cuti=jenis_cuti.id_cuti WHERE cuti.kode='$_GET[id]'");
    $data  = mysqli_fetch_array($query);

    if(isset($_POST['update_status']) && $_POST['update_status']){
      if($_SESSION['level']==3){
        $sql = "UPDATE cuti SET status_kepala='$_POST[status]' WHERE kode='$data[kode]'";
        $q = mysqli_query($koneksi,$sql);
      }elseif($_SESSION['level']==2){
        $sql = "UPDATE cuti SET status_sekertaris='$_POST[status]' WHERE kode='$data[kode]'";
        $q = mysqli_query($koneksi,$sql);
      }if($_SESSION['level']==1){
        $sql = "UPDATE cuti SET status_ketua='$_POST[status]' WHERE kode='$data[kode]'";
        $q = mysqli_query($koneksi,$sql);
      }
      if ($q){
        echo "<script>alert('cuti berhasil di update!'); window.location = 'index.php?page=cuti'</script>";
      //echo '<div class="alert alert-info alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Data berhasil disimpan.</div>';
      }else{
        echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Data gagal disimpan, silahkan coba lagi.</div>';
      }
    }
?>
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Detail Cuti
    <small>Human Resource Management System</small>
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
          <h3 class="box-title">Detail Data Cuti</h3>
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
              <td width="700" colspan="1"><?php echo $data['nama_karyawan']; ?></td>
              </tr>
              <tr>
              <td>Tanggal Awal</td>
              <td><?php echo $data['tanggal_awal']; ?></td>
              </tr>
              <tr>
              <td>Tanggal Akhir</td>
              <td><?php echo $data['tanggal_akhir']; ?></td>
              </tr>
              <tr>
              <td>Jumlah Cuti</td>
              <td><?php echo $data['jumlah']; ?></td>
              </tr>
              <tr>
              <td>Jenis Cuti</td>
              <td><?php echo $data['nama_cuti']; ?></td>
              </tr>
              <tr>
              <td>Keterangan</td></td>
              <td><?php echo $data['ket']; ?></td>
              </tr>
              <tr>
                <td>Status Kepala</td></td>
                <?php if($_SESSION['level']==3): ?>
                  <td>
                  <form class="form-inline" action="" method="post">
                    <input type="hidden" name="update_status" value="true">
                    <select name="status" class="form-control">
                      <?php foreach(status_cuti() as $val): ?>
                        <option value="<?=$val?>" <?=$data['status_kepala']==$val?'selected':''?>><?=$val?></option>
                      <?php endforeach; ?>
                    </select>
                    <button class="btn btn-default" type="submit">Update</button>
                  </form>
                  </td>
                <?php else: ?>
                  <td><?php echo $data['status_kepala']; ?></td>
                <?php endif;?>
              </tr>
              <tr>
                <td>Status Sekertaris</td></td>
                <?php if($_SESSION['level']==2): ?>
                  <td>
                  <form class="form-inline" action="" method="post">
                  <input type="hidden" name="update_status" value="true">
                    <select name="status" class="form-control">
                      <?php foreach(status_cuti() as $val): ?>
                        <option value="<?=$val?>" <?=$data['status_sekertaris']==$val?'selected':''?>><?=$val?></option>
                      <?php endforeach; ?>
                    </select>
                    <button class="btn btn-default" type="submit">Update</button>
                  </form>
                  </td>
                <?php else: ?>
                  <td><?php echo $data['status_sekertaris']; ?></td>
                <?php endif;?>
              </tr>
              <tr>
                <td>Status Ketua</td></td>
                <?php if($_SESSION['level']==1): ?>
                  <td>
                  <form class="form-inline" action="" method="post">
                  <input type="hidden" name="update_status" value="true">
                    <select name="status" class="form-control">
                    <?php foreach(status_cuti() as $val): ?>
                        <option value="<?=$val?>" <?=$data['status_ketua']==$val?'selected':''?>><?=$val?></option>
                      <?php endforeach; ?>
                    </select>
                    <button class="btn btn-default" type="submit">Update</button>
                  </form>
                  </td>
                <?php else: ?>
                  <td><?php echo $data['status_ketua']; ?></td>
                <?php endif;?>
              </tr>
              </table>
              <div class="text-right">
              <a href="/generate-pdf.php?file=pdf-cuti&id=<?=$data['kode']?>" class="btn btn-sm btn-primary">Print PDF <i class="fa fa-print"></i></a>
              <a href="index.php?page=cuti" class="btn btn-sm btn-warning">Kembali <i class="fa fa-arrow-circle-right"></i></a>
        </div>
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
