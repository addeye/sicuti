
<?php
  $tampilCuti=mysqli_query($koneksi, "select * from cuti order by kode desc");
  $totalCuti=mysqli_num_rows($tampilCuti);

  $tampilIzin=mysqli_query($koneksi, "select * from izin order by kode desc");
  $totalIzin=mysqli_num_rows($tampilIzin);
?>
<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
      <div class="pull-left image">
        <img src="<?php echo $_SESSION['gambar']; ?>" height="200" width="200" style="border: 2px solid white;" class="img-circle" alt="User Image">
      </div>
      <div class="pull-left info">
        <p><?php echo $_SESSION['nama']; ?></p>
        <a href="index.php"><i class="fa fa-circle text-success"></i> <?php echo $nama_departemen; ?></a>
      </div>
    </div><br />
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu">
      <li class="header">SI CUTI PEGAWAI</li>
      <li class="active treeview">
        <a href="index.php">
          <i class="fa fa-dashboard"></i> <span>Dashboard</span>
        </a>
      </li>
      <?php if($_SESSION['level'] == 'admin'): ?>
        <?php include 'menu/admin.php' ?>
      <?php elseif($_SESSION['level'] == 1): ?>
        <?php include 'menu/ketua.php' ?>
      <?php elseif($_SESSION['level'] == 2): ?>
        <?php include 'menu/sekertaris.php' ?>
      <?php elseif($_SESSION['level'] == 3): ?>
        <?php include 'menu/kepala.php' ?>
      <?php elseif($_SESSION['level'] == 4): ?>
        <?php include 'menu/pegawai.php' ?>
      <?php endif; ?>
  </section>
  <!-- /.sidebar -->
</aside>