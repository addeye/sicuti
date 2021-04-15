<li>
    <a href="#">
        <i class="fa fa-user"></i> <span>Pegawai</span> <i class="fa fa-angle-left pull-right"></i>
    </a>
    <ul class="treeview-menu">
        <li><a href="index.php?page=karyawan"><i class="fa fa-circle-o"></i> Pegawai</a></li>
        <li><a href="index.php?page=input-karyawan"><i class="fa fa-circle-o"></i> Input Pegawai</a></li>
        <li><a href="index.php?page=karyawan_importxls"><i class="fa fa-circle-o"></i> Import Data Excel</a></li>
    </ul>
</li>

<li>
    <a href="#">
        <i class="fa fa-building"></i> <span>Departemen</span> <i class="fa fa-angle-left pull-right"></i>
    </a>
    <ul class="treeview-menu">
        <li><a href="index.php?page=departemen"><i class="fa fa-circle-o"></i> Data Departemen</a></li>
        <li><a href="index.php?page=input-departemen"><i class="fa fa-circle-o"></i> Input Departemen</a></li>
    </ul>
</li>

<li class="treeview">
    <a href="#">
        <i class="fa fa-building"></i> <span>Jabatan</span>
        <i class="fa fa-angle-left pull-right"></i>
    </a>
    <ul class="treeview-menu">
        <li><a href="index.php?page=jabatan"><i class="fa fa-circle-o"></i> Data Jabatan</a></li>
        <li><a href="index.php?page=input-jabatan"><i class="fa fa-circle-o"></i> Input Jabatan</a></li>
    </ul>
</li>

<li class="treeview">
    <a href="#">
        <i class="fa fa-dollar"></i> <span>Variabel Cuti</span>
        <i class="fa fa-angle-left pull-right"></i>
    </a>
    <ul class="treeview-menu">
        <li><a href="index.php?page=jenis"><i class="fa fa-circle-o"></i> Data Variabel </a></li>
        <li><a href="index.php?page=input-jenis"><i class="fa fa-circle-o"></i> Input Variabel </a></li>
    </ul>
</li>
<li>
    <a href="#">
        <i class="fa fa-lock"></i> <span>Cuti</span>
        <small class="label pull-right bg-yellow"><?php echo $totalCuti; ?></small>
    </a>
        <ul class="treeview-menu">
        <li><a href="index.php?page=cuti"><i class="fa fa-circle-o"></i> Data Cuti</a></li>
        <li><a href="index.php?page=input-cuti"><i class="fa fa-circle-o"></i> Input Cuti </a></li>
    </ul>
</li>
<li>
    <a href="#">
        <i class="fa fa-lock"></i> <span>Izin</span>
        <small class="label pull-right bg-yellow"><?php echo $totalIzin; ?></small>
    </a>
        <ul class="treeview-menu">
        <li><a href="index.php?page=izin"><i class="fa fa-circle-o"></i> Data Izin</a></li>
        <li><a href="index.php?page=input-izin"><i class="fa fa-circle-o"></i> Input Izin </a></li>
    </ul>
</li>
<li>
    <a href="#">
        <i class="fa fa-file"></i> <span>Laporan</span> <i class="fa fa-angle-left pull-right"></i>
    </a>
    <ul class="treeview-menu">
        <li><a href="404.php"><i class="fa fa-circle-o"></i> Laporan Cuti</a></li>
        <li><a href="404.php"><i class="fa fa-circle-o"></i> Laporan Detail Cuti</a></li>
        <li><a href="404.php"><i class="fa fa-circle-o"></i> Laporan Balance Cuti</a></li>
        <li><a href="404.php" target="_blank"><i class="fa fa-circle-o"></i> Cetak Karyawan</a></li>
    </ul>
</li>