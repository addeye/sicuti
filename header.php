<header class="main-header">
        <!-- Logo -->
        <a href="index.php" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b> S.I</b> CUTI ONLINE</span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><img src="public/logo2.png" widget="30PX" height="50px"><b> S.I</b> CUTI ONLINE</span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <img src="<?php echo $_SESSION['gambar']; ?>" class="user-image" style="border: 1px solid white;" alt="User Image">
                  <span class="hidden-xs"><?php echo $_SESSION['nama']; ?></span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                    <img src="<?php echo $_SESSION['gambar']; ?>" class="img-circle" alt="User Image">
                    <p>
                    <?php echo $_SESSION['nama']; ?>

                    </p>
                  </li>
                  <!-- Menu Body -->
                  <li class="user-body">
                    <div class="col-xs-4 text-center">
                      <a href="karyawan.php"><?=$nama_level?></a>
                    </div>
                    <div class="col-xs-4 text-center">
                      <a href="departemen.php">INSTANSI PMERINTAH</a>
                    </div>
                    <div class="col-xs-4 text-center <?=$_SESSION['level']=='admin'?'hidden':''?>">
                      <a href="index.php?page=cuti">Cuti</a>
                    </div>
                  </li>
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <?php if($_SESSION['level']!='admin'): ?>
                    <div class="pull-left">
                      <a href="index.php?page=detail-karyawan&hal=edit&id=<?php echo $_SESSION['nik'];?>" class="btn btn-default btn-flat">Profile</a>
                    </div>
                    <?php endif; ?>
                    <div class="pull-right">
                    <a href="logout.php" class="btn btn-default btn-flat" onclick="return confirm ('Apakah Anda Akan Keluar.?');"> Keluar </a>
                    </div>
                  </li>
                </ul>
              </li>
              <!-- Control Sidebar Toggle Button -->
              <li>
                <a href="#" data-toggle="control-sidebar"><i class="fa fa-spin fa-gear"></i></a>
              </li>
            </ul>
          </div>
        </nav>
      </header>