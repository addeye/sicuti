<!-- Content Header (Page header) -->
<section class="content-header">
          <h1>
            Karyawan
            <small>HRMS</small>
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
                  <h3 class="box-title">Import Data Karyawan</h3>
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
                <div class="alert alert-warning alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Pastikan file excel yang akan di import merupakan excel 2003 (.xls) untuk format import excel anda bisa download <a href="format_import/karyawan.xls"> di sini </a></div>
                                        <?php
//koneksi ke database, username,password  dan namadatabase menyesuaikan
//mysql_connect('localhost', 'username', 'password');
//mysql_select_db('namadatabase');

//memanggil file excel_reader
require "excel_reader.php";

//jika tombol import ditekan
if(isset($_POST['submit'])){

    $target = basename($_FILES['filepegawaiall']['name']) ;
    move_uploaded_file($_FILES['filepegawaiall']['tmp_name'], $target);

    $data = new Spreadsheet_Excel_Reader($_FILES['filepegawaiall']['name'],false);

//    menghitung jumlah baris file xls
    $baris = $data->rowcount($sheet_index=0);

//    jika kosongkan data dicentang jalankan kode berikut
    $drop = isset( $_POST["drop"] ) ? $_POST["drop"] : 0 ;
    if($drop == 1){
//             kosongkan tabel pegawai
             $truncate ="TRUNCATE TABLE karyawan";
             mysqli_query($koneksi, $truncate);
    };

//    import data excel mulai baris ke-2 (karena tabel xls ada header pada baris 1)
    for ($i=2; $i<=$baris; $i++)
    {
//       membaca data (kolom ke-1 sd terakhir)
      $nik           = $data->val($i, 1);
      $nama          = $data->val($i, 2);
      $tanggal_masuk = $data->val($i, 3);
      $departemen    = $data->val($i, 4);
      $jabatan       = $data->val($i, 5);
      $status        = $data->val($i, 6);
      $jumlah_cuti   = $data->val($i, 7);
      $username      = $data->val($i, 8);
      $password      = $data->val($i, 9);
      $level         = $data->val($i, 10);

//      setelah data dibaca, masukkan ke tabel pegawai sql
      $query = "INSERT INTO karyawan (nik, nama, tanggal_masuk, departemen, jabatan, status, jumlah_cuti, username, password, level) VALUES
                      ('$nik', '$nama', '$tanggal_masuk', '$departemen', '$jabatan', '$status', '$jumlah_cuti', '$username', '$password', '$level')";
      $hasil = mysqli_query($koneksi, $query);
    }

    if(!$hasil){
//          jika import gagal
          die(mysqli_error($koneksi));
      }else{
//          jika impor berhasil
          echo '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Data berhasil di import</div>';
    }

//    hapus file xls yang udah dibaca
    unlink($_FILES['filepegawaiall']['name']);
}

?>

<form name="myForm" id="myForm" onSubmit="return validateForm()" action="karyawan_importxls.php" method="post" enctype="multipart/form-data">
    <input type="file" id="filepegawaiall" class="form-control" name="filepegawaiall" required /><br />
    <input type="submit" name="submit" class="brn btn-sm btn-success" value="Import" /><br/>
    <label><input type="checkbox" name="drop" value="1" /> <u>Kosongkan tabel sql terlebih dahulu.</u> </label>
</form>

<script type="text/javascript">
//    validasi form (hanya file .xls yang diijinkan)
    function validateForm()
    {
        function hasExtension(inputID, exts) {
            var fileName = document.getElementById(inputID).value;
            return (new RegExp('(' + exts.join('|').replace(/\./g, '\\.') + ')$')).test(fileName);
        }

        if(!hasExtension('filepegawaiall', ['.xls'])){
            alert("Hanya file XLS (Excel 2003) yang diijinkan.");
            return false;
        }
    }
</script>
                </div><!-- /.box-body -->
              </div><!-- /.box -->

            </section><!-- /.Left col -->
          </div><!-- /.row (main row) -->

        </section><!-- /.content -->