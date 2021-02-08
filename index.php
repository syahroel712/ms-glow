<?php
session_start();
// error_reporting(0);
include "inc/koneksi.php";
include "fungsi_indotgl.php";

$thn_ini = date('Y');
$kadaluarsa = mysql_fetch_assoc(mysql_query("SELECT kadaluarsa FROM tb_visi"));
$tgl = $kadaluarsa['kadaluarsa'];
$satu_bulan = date('Y-m-d', strtotime('+1 month', strtotime($tgl)));

if (isset($_POST['simpanAktivasi'])) {
  $kodeaktivasi = mysql_fetch_assoc(mysql_query("SELECT * FROM tb_kodeaktivasi WHERE kode='$_POST[kodeaktivasi]'"));
  if ($kodeaktivasi['status'] != 'N') {
    mysql_query("UPDATE tb_visi SET kadaluarsa='$satu_bulan'");
    mysql_query("UPDATE tb_kodeaktivasi SET status='N' WHERE kode='$_POST[kodeaktivasi]'");
?>
    <script>
      window.alert("Perpanjangan ditambah sampai <?= $satu_bulan ?>");
      window.location = 'index.php';
    </script>
    <?php
  } else {
    echo "<script>alert('kode aktivasi tidak tersedia')</script>";
  }
}

if (($_SESSION['admin'] || $_SESSION['pimpinan'] || $_SESSION['kasir'])) {
  if ($_SESSION['admin']) {
    $iden = mysql_fetch_array(mysql_query("SELECT * FROM tb_user where kode_user='$_SESSION[admin]'"));
    $nama =  $iden['nama_lengkap'];
    $level = 'Administrator';
    $foto = 'dist/img/avatar04.png';
  } elseif ($_SESSION['pimpinan']) {
    $iden = mysql_fetch_array(mysql_query("SELECT * FROM tb_user where kode_user='$_SESSION[pimpinan]'"));
    $nama =  $iden['nama_lengkap'];
    $level = 'Pimpinan';
    $foto = 'dist/img/avatar5.png';
  } elseif ($_SESSION['kasir']) {
    $iden = mysql_fetch_array(mysql_query("SELECT * FROM tb_user where kode_user='$_SESSION[kasir]'"));
    $nama =  $iden['nama_lengkap'];
    $level = 'Kasir';
    $foto = 'dist/img/avatar3.png';

    //cek modal
    $skr2 = date('Y-m-d');
    $mod = mysql_query("SELECT * from tb_modal where id_user='$_SESSION[kasir]' and tgl='$skr2'");
    if (mysql_num_rows($mod) < 1) {
    ?>
      <script>
        alert('Tanggal <?php echo "$skr2"; ?>');
        window.location.href = "modal.php";
      </script>
  <?php
    }
  }

  if ($_SESSION['jk'] == 'Laki-laki') {
    $gambar = 'assets/img/avatar5.png';
  } else {
    $gambar = 'assets/img/avatar2.png';
  }
  ?>

  <!DOCTYPE html>
  <html>

  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Kasir | Dashboard</title>
    <link rel="shortcut icon" href="assets/img/logo.png">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="assets/libs/fontawesome/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bbootstrap 4 -->
    <link rel="stylesheet" href="assets/libs/bootstrap/css/bootstrap.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="assets/libs/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="assets/libs/datatables-bs4/css/dataTables.bootstrap4.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="assets/css/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="assets/libs/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="assets/libs/daterangepicker/daterangepicker.css">
    <!-- summernote -->
    <link rel="stylesheet" href="assets/libs/summernote/summernote-bs4.css">
    <!-- Select2 -->
    <link rel="stylesheet" href="assets/libs/select2/css/select2.min.css">
    <link rel="stylesheet" href="assets/libs/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <!-- Style CSS -->
    <link rel="stylesheet" href="assets/css/suggest.css">
    <link rel="stylesheet" href="assets/css/styleutama.css">
    <!-- jQuery -->
    <script src="assets/libs/jquery/jquery-3.4.1.min.js"></script>
  </head>

  <body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

      <!-- Navbar -->
      <?php include "main-header.php"; ?>
      <!-- /.navbar -->

      <!-- Main Sidebar Container -->
      <aside class="main-sidebar sidebar-light-primary elevation-4">
        <!-- Brand Logo -->
        <a href="" class="brand-link navbar-primary">
          <img src="assets/img/header2.png" alt="AdminLTE Logo" class="brand-image" style="opacity: .8">
          <span class="brand-text font-weight-bold text-white">&nbsp;</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
          <!-- Sidebar user panel (optional) -->
          <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">

              <img src="<?= $gambar ?>" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
              <a href="#" class="d-block"><?= $nama ?></a>
            </div>
          </div>

          <!-- Sidebar Menu -->
          <?php include "sidebar.php"; ?>
          <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
      </aside>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <?php
        if (isset($_GET['page'])) {
          if ($_GET['page'] == "barang") {
            include "inc/barang/barang.php";
          } else if ($_GET['page'] == "kas") {
            include "inc/kas/kas.php";
          } else if ($_GET['page'] == "kategori") {
            include "inc/kategori/kategori.php";
          } else if ($_GET['page'] == "penjualan") {
            include "inc/penjualan.php";
          } else if ($_GET['page'] == "pembelian") {
            include "inc/pembelian.php";
		
		  } else if ($_GET['page'] == "kanvas") {
            include "inc/kanvas.php";
			
			
          } else if ($_GET['page'] == "barang_terlaris") {
            include "inc/barangterlaris/barang_terlaris.php";
          } else if ($_GET['page'] == "laporan_perhari") {
            include "inc/laporan/laporan_perhari.php";
          } else if ($_GET['page'] == "laporan_perbulan") {
            include "inc/laporan/laporan_perbulan.php";
          } else if ($_GET['page'] == "laporan_pertahun") {
            include "inc/laporan/laporan_pertahun.php";
          } else if ($_GET['page'] == "laporan_perbarang") {
            include "inc/laporan/laporan_perbarang.php";
          } else if ($_GET['page'] == "laporan_perkategori") {
            include "inc/laporan/laporan_perkategori.php";
          } else if ($_GET['page'] == "laporan_perkaryawan") {
            include "inc/laporan/laporan_perkaryawan.php";
          } else if ($_GET['page'] == "laporan_persupplier") {
            include "inc/laporan/laporan_persupplier.php";
          } else if ($_GET['page'] == "laporan_permember") {
            include "inc/laporan/laporan_permember.php";
          } else if ($_GET['page'] == "laporan_perhari_pembelian") {
            include "inc/laporan/laporan_perhari_pembelian.php";
          } else if ($_GET['page'] == "laporan_perbulan_pembelian") {
            include "inc/laporan/laporan_perbulan_pembelian.php";
          } else if ($_GET['page'] == "laporan_pertahun_pembelian") {
            include "inc/laporan/laporan_pertahun_pembelian.php";
          } else if ($_GET['page'] == "laporan_persupplier_pembelian") {
            include "inc/laporan/laporan_persupplier_pembelian.php";
          } else if ($_GET['page'] == "detail_laporan_persupplier_pembelian") {
            include "inc/laporan/detail_laporan_persupplier_pembelian.php";
          } else if ($_GET['page'] == "laporan_keuangan") {
            include "inc/laporan/laporan_keuangan.php";
          } else if ($_GET['page'] == "laporan_so") {
            include "inc/laporan/laporan_so.php";
          } else if ($_GET['page'] == "laporan_so_detail") {
            include "inc/laporan/laporan_so_detail.php";
          } else if ($_GET['page'] == "pemasok") {
            include "inc/pemasok/pemasok.php";
          } else if ($_GET['page'] == "user") {
            include "inc/user/user.php";
          } else if ($_GET['page'] == "member") {
            include "inc/member/member.php";
          } else if (@$_GET['page'] == "memberbaru") {
            include "inc/member/memberbaru.php";
          } else if (@$_GET['page'] == "memberexpired") {
            include "inc/member/memberexpired.php";
          } else if ($_GET['page'] == "pengembalian") {
            include "inc/pengembalian.php";
          } else if ($_GET['page'] == "lihat_satuan") {
            include "inc/lihat_satuan.php";
          } else if ($_GET['page'] == "input_satuan") {
            include "inc/input_satuan.php";
          } else if ($_GET['page'] == "data_satuan") {
            include "inc/data_satuan.php";
          } else if ($_GET['page'] == "hapus_satuan") {
            include "inc/hapus_satuan.php";
          } else if ($_GET['page'] == "edit_satuan") {
            include "inc/edit_satuan.php";
          } else if ($_GET['page'] == "proses_edit_satuan") {
            include "inc/proses_edit_satuan.php";
          } else if ($_GET['page'] == "proses_tambah_satuan") {
            include "inc/proses_tambah_satuan.php";
          } else if ($_GET['page'] == "edit_penjualan") {
            include "inc/edit_penjualan.php";
          } else if ($_GET['page'] == "setting") {
            include "inc/setting.php";
          }
        } else {
          include "inc/home.php";
        }

        ?>
      </div>

      <div class="modal fade" id="aktivasiModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title" id="myModalLabel">Perpanjangan</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
              <form method="POST" action="">
                <input type="text" name="kodeaktivasi" class="form-control" placeholder="Masukkan Kode Aktivasi...">
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-primary" name="simpanAktivasi">Simpan</button>
              </form>
            </div>
          </div>
        </div>
      </div>

      <!-- /.content-wrapper -->
      <footer class="main-footer">
        <strong>Copyright &copy; 2019 - <?php echo date('Y'); ?> <a href="https://www.diata.id" target="_blank">DIATA</a>.</strong>
        All rights reserved.
        <div class="float-right d-none d-sm-inline-block">
          <b>Version</b> 2.1.3
        </div>
      </footer>

    </div>
    <!-- ./wrapper -->

    <!-- jQuery UI 1.11.4 -->
    <script src="assets/libs/jquery-ui/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
      $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Jquery Number -->
    <script src="assets/libs/jquery-number/jquery-number.js"></script>
    <!-- Bootstrap 4 -->
    <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- ChartJS -->
    <script src="assets/libs/chart.js/Chart.min.js"></script>
    <!-- Sparkline -->
    <script src="assets/libs/sparklines/sparkline.js"></script>
    <!-- jQuery Knob Chart -->
    <script src="assets/libs/jquery-knob/jquery.knob.min.js"></script>
    <!-- daterangepicker -->
    <script src="assets/libs/moment/moment.min.js"></script>
    <script src="assets/libs/daterangepicker/daterangepicker.js"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="assets/libs/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
    <!-- Summernote -->
    <script src="assets/libs/summernote/summernote-bs4.min.js"></script>
    <!-- overlayScrollbars -->
    <script src="assets/libs/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <!-- DataTables -->
    <script src="assets/libs/datatables/jquery.dataTables.js"></script>
    <script src="assets/libs/datatables-bs4/js/dataTables.bootstrap4.js"></script>
    <!-- AdminLTE App -->
    <script src="assets/js/adminlte.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="assets/js/demo.js"></script>
    <!-- Select2 -->
    <script src="assets/libs/select2/js/select2.full.min.js"></script>
    <!-- Random Color -->
    <script src="assets/js/randomColor.js"></script>

    <script>
      $(function() {
        $('.select2').select2()

        //Initialize Select2 Elements
        $('.select2bs4').select2({
          theme: 'bootstrap4'
        })

        $("#example1").DataTable();
        $('#example2').DataTable({
          "paging": true,
          "ordering": true,
          "info": false,
          "autoWidth": false,
          "pageLength": 50
        });
        $('#example2Server').DataTable({
          "paging": true,
          "ordering": true,
          "info": false,
          "autoWidth": false,
          "pageLength": 10,
          "processing": true,
          "serverSide": true,
          "ajax": "inc/barang/getBarang.php",
          columnDefs : [
            {
              "searchable": false,
            "orderable": false,
            "targets":6,
            "render" : function(data,type,row) {
              let btn = `<a href="?page=barang&action=edit&id=${row[0]}">
																<button class="btn btn-success btn-xs shadow" title="Edit Data"><span class='fa fa-edit'></span></button></a>
															<a onclick="return confirm('Yakin ingin menghapus data ?');" href="?page=barang&action=hapus&id=${row[0]}">
																<button class='btn btn-danger btn-xs shadow' title='Delete Data'><span class='fa fa-trash-alt'></span></button></a>
															<a onclick='window.open("inc/barang/cetak_barang.php?id=${row[0]}", "Cetak Barang", "height=700,width=700,scrollbars=yes");'>
																<button class='btn btn-info btn-xs shadow' title='Cetak Data'><span class='fa fa-print'></span></button></a>`
              return btn;
            }
            }
          ]
        });
      });
    </script>

    <!-- Grafik perbarang -->
    <script>
      var ctx = document.getElementById("myBarChart1").getContext('2d');
      var myBarChart1 = new Chart(ctx, {
        type: 'bar',
        data: {
          labels: [
            <?php
            $banyak_data = 0;
            $a = mysql_query("SELECT tb_barang.kode_barang,tb_barang.nama_barang,tb_barang.harga_jual,SUM(tb_barang.harga_jual*tb_barang_terjual.jumlah_jual) AS total,SUM(tb_barang_terjual.jumlah_jual) as jumlah_beli FROM tb_barang JOIN tb_barang_terjual ON tb_barang.kode_barang=tb_barang_terjual.kode_barang JOIN tb_penjualan ON tb_penjualan.no_nota=tb_barang_terjual.no_nota WHERE $sql_filter_grafik GROUP BY tb_barang.nama_barang ORDER BY jumlah_beli DESC LIMIT 5");

            while ($pecah = mysql_fetch_assoc($a)) {
              $banyak_data++;
              echo "'" . $pecah['nama_barang'] . "',";
            }
            ?>
          ],
          datasets: [{
            label: 'Jumlah Terjual',
            data: [
              <?php
              //include "inc/koneksi.php";
              $banyak_data = 0;
              $a1 = mysql_query("SELECT tb_barang.kode_barang,tb_barang.nama_barang,tb_barang.harga_jual,SUM(tb_barang.harga_jual*tb_barang_terjual.jumlah_jual) AS total,SUM(tb_barang_terjual.jumlah_jual) as jumlah_beli FROM tb_barang JOIN tb_barang_terjual ON tb_barang.kode_barang=tb_barang_terjual.kode_barang JOIN tb_penjualan ON tb_penjualan.no_nota=tb_barang_terjual.no_nota WHERE $sql_filter_grafik GROUP BY tb_barang.nama_barang ORDER BY jumlah_beli DESC LIMIT 5");

              while ($pecah1 = mysql_fetch_assoc($a1)) {
                $banyak_data++;
                echo "'" . $pecah1['jumlah_beli'] . "',";
              }
              ?>
            ],
            backgroundColor: randomColor({
              count: <?php echo $banyak_data ?>,
              luminosity: 'dark',
              format: 'rgb' // e.g. 'rgba(9, 1, 107, 0.6482447960879654)'
            }),
            borderWidth: 1
          }]
        },
        options: {
          scales: {
            yAxes: [{
              ticks: {
                beginAtZero: true
              }
            }]
          },
          legend: {
            display: false
          }
        }
      });
    </script>

    <script>
      var ctx = document.getElementById("myLineChart2");
      var myLineChart2 = new Chart(ctx, {
        type: 'bar',
        data: {
          labels: [
            <?php
            $banyak_data = 0;
            $a = mysql_query("SELECT sum(jumlah_jual)as jml,nama_barang FROM tb_barang_terjual JOIN tb_penjualan ON tb_barang_terjual.no_nota=tb_penjualan.no_nota WHERE left(tgl_jual, 7) = left(curdate(),7) group by kode_barang LIMIT 5");
            while ($pecah = mysql_fetch_array($a)) {
              $banyak_data++;
              echo "'" . $pecah['nama_barang'] . "',";
            }
            ?>

          ],
          datasets: [{
            label: "",
            data: [
              <?php
              $banyak_data = 0;
              $a1 = mysql_query("SELECT sum(jumlah_jual)as jml,nama_barang FROM tb_barang_terjual JOIN tb_penjualan ON tb_barang_terjual.no_nota=tb_penjualan.no_nota WHERE left(tgl_jual, 7) = left(curdate(),7) group by kode_barang LIMIT 5");
              while ($pecah1 = mysql_fetch_array($a1)) {
                $banyak_data++;
                echo "'" . $pecah1['jml'] . "',";
              }
              ?>
            ],
            backgroundColor: randomColor({
              count: <?php echo $banyak_data ?>,
              luminosity: 'dark',
              format: 'rgb'
            }),
            borderWidth: 1,
          }]
        },
        options: {
          scales: {
            yAxes: [{
              ticks: {
                beginAtZero: 7
              }
            }],
          },
          legend: {
            display: false
          }
        }
      });
    </script>


    <!-- Grafik perkategori -->
    <script>
      var ctx = document.getElementById("myBarChart2").getContext('2d');
      var myBarChart2 = new Chart(ctx, {
        type: 'bar',
        data: {
          labels: [
            <?php
            $banyak_data = 0;
            $a = mysql_query("SELECT tb_barang_terjual.kode_barang,kategori.nmkat,SUM(tb_barang.harga_jual*tb_barang_terjual.jumlah_jual) as total,SUM(tb_barang_terjual.jumlah_jual) as total_terjual 
            FROM tb_barang 
            JOIN kategori ON tb_barang.idkat=kategori.idkat 
            JOIN tb_barang_terjual ON tb_barang_terjual.kode_barang=tb_barang.kode_barang 
            JOIN tb_penjualan ON tb_barang_terjual.no_nota=tb_penjualan.no_nota
            WHERE $sql_filter_tabel GROUP BY kategori.nmkat ORDER BY total_terjual DESC LIMIT 5");

            while ($pecah = mysql_fetch_assoc($a)) {
              $banyak_data++;
              echo "'" . $pecah['nmkat'] . "',";
            }
            ?>
          ],
          datasets: [{
            label: 'Jumlah Terjual',
            data: [
              <?php
              //include "inc/koneksi.php";
              $banyak_data = 0;
              $a1 = mysql_query("SELECT tb_barang_terjual.kode_barang,kategori.nmkat,SUM(tb_barang.harga_jual*tb_barang_terjual.jumlah_jual) as total,SUM(tb_barang_terjual.jumlah_jual) as total_terjual 
              FROM tb_barang 
              JOIN kategori ON tb_barang.idkat=kategori.idkat 
              JOIN tb_barang_terjual ON tb_barang_terjual.kode_barang=tb_barang.kode_barang 
              JOIN tb_penjualan ON tb_barang_terjual.no_nota=tb_penjualan.no_nota
              WHERE $sql_filter_tabel GROUP BY kategori.nmkat ORDER BY total_terjual DESC LIMIT 5");

              while ($pecah1 = mysql_fetch_assoc($a1)) {
                $banyak_data++;
                echo "'" . $pecah1['total_terjual'] . "',";
              }
              ?>
            ],
            backgroundColor: randomColor({
              count: <?= $banyak_data ?>,
              luminosity: 'dark',
              format: 'rgb' // e.g. 'rgba(9, 1, 107, 0.6482447960879654)'
            }),
            borderWidth: 1
          }]
        },
        options: {
          scales: {
            yAxes: [{
              ticks: {
                beginAtZero: true
              }
            }]
          },
          legend: {
            display: false
          }
        }
      });
    </script>

    <script>
      var ctx = document.getElementById("myBarChart5").getContext('2d');
      var myBarChart5 = new Chart(ctx, {
        type: 'bar',
        data: {
          labels: [
            <?php
            $a = mysql_query("SELECT tb_user.nama_lengkap,SUM(tb_penjualan.total_harga) as total, COUNT(tb_user.kode_user) as struk , (SUM(tb_penjualan.total_harga)/COUNT(tb_user.kode_user)) as rata FROM tb_penjualan JOIN tb_user ON tb_penjualan.id_user=tb_user.kode_user WHERE $sql_filter_tabel GROUP BY tb_user.kode_user");

            while ($pecah = mysql_fetch_assoc($a)) {
              echo "'" . $pecah['nama_lengkap'] . "',";
            }
            ?>

          ],
          datasets: [{
            label: 'Rata-rata',
            data: [
              <?php
              //include "inc/koneksi.php";
              $a1 = mysql_query("SELECT tb_user.nama_lengkap,SUM(tb_penjualan.total_harga) as total, COUNT(tb_user.kode_user) as struk , (SUM(tb_penjualan.total_harga)/COUNT(tb_user.kode_user)) as rata FROM tb_penjualan JOIN tb_user ON tb_penjualan.id_user=tb_user.kode_user WHERE $sql_filter_tabel GROUP BY tb_user.kode_user");

              while ($pecah1 = mysql_fetch_assoc($a1)) {
                echo "'" . $pecah1['rata'] . "',";
              }
              ?>
            ],
            backgroundColor: randomColor({
              count: <?= $banyak_data ?>,
              luminosity: 'dark',
              format: 'rgb' // e.g. 'rgba(9, 1, 107, 0.6482447960879654)'
            }),
            borderWidth: 1
          }]
        },
        options: {
          scales: {
            yAxes: [{
              ticks: {
                beginAtZero: true
              }
            }]
          },
          legend: {
            display: false
          }
        }
      });
    </script>

    <script>
      var ctx = document.getElementById("myBarChart6").getContext('2d');
      var myBarChart6 = new Chart(ctx, {
        type: 'bar',
        data: {
          labels: [
            <?php
            $a = mysql_query("SELECT *,month(p.tgl_jual)as bln,sum(d.modal*d.jumlah_jual)as modal2,sum(d.harga_satuan*d.jumlah_jual)as tot from tb_penjualan p,tb_barang_terjual d where $where and p.no_nota=d.no_nota group by month(p.tgl_jual) order by month(p.tgl_jual) asc");

            while ($pecah = mysql_fetch_assoc($a)) {
              echo "'" . $BulanIndo[$pecah['bln']] . "',";
            }
            ?>

          ],
          datasets: [{
              label: "Penjualan",
              backgroundColor: "#3e95cd",
              data: [
                <?php
                $b = mysql_query("SELECT *,month(p.tgl_jual)as bln,sum(d.modal*d.jumlah_jual)as modal2,sum(d.harga_satuan*d.jumlah_jual)as tot from tb_penjualan p,tb_barang_terjual d where $where and p.no_nota=d.no_nota group by month(p.tgl_jual) order by month(p.tgl_jual) asc");

                while ($pecah2 = mysql_fetch_assoc($b)) {
                  echo "'" . $pecah2['tot'] . "',";
                }
                ?>
              ]
            },
            {
              label: "Pengeluaran",
              backgroundColor: "#8e5ea2",
              data: [
                <?php
                $c = mysql_query("SELECT *,month(p.tgl_jual)as bln,sum(d.modal*d.jumlah_jual)as modal2,sum(d.harga_satuan*d.jumlah_jual)as tot from tb_penjualan p,tb_barang_terjual d where $where and p.no_nota=d.no_nota group by month(p.tgl_jual) order by month(p.tgl_jual) asc");

                while ($pecah3 = mysql_fetch_assoc($c)) {
                  $pengeluaran = mysql_fetch_array(mysql_query("SELECT *,sum(total)as tot from tb_pembelian where month(tgl_beli)='$pecah3[bln]' and year(tgl_beli)='$ket' group by month(tgl_beli)"));

                  echo "'" . $pengeluaran['tot'] . "',";
                }
                ?>
              ]
            },
            {
              label: "Kas",
              backgroundColor: "#6a0d0d",
              data: [
                <?php
                $d = mysql_query("SELECT *,month(p.tgl_jual)as bln,sum(d.modal*d.jumlah_jual)as modal2,sum(d.harga_satuan*d.jumlah_jual)as tot from tb_penjualan p,tb_barang_terjual d where $where and p.no_nota=d.no_nota group by month(p.tgl_jual) order by month(p.tgl_jual) asc");

                while ($pecah4 = mysql_fetch_assoc($d)) {
                  $pengeluaran2 = mysql_fetch_array(mysql_query("SELECT *,sum(total)as tot from tb_pembelian where month(tgl_beli)='$pecah4[bln]' and year(tgl_beli)='$ket' group by month(tgl_beli)"));

                  $rata = $pecah4['tot'] - $pengeluaran2['tot'];

                  echo "'" . $rata . "',";
                }
                ?>
              ]
            },
          ]
        },
        options: {
          scales: {
            yAxes: [{
              ticks: {
                beginAtZero: true
              }
            }]
          },
          legend: {
            display: false
          }
        }
      });
    </script>

    <script>
      var ctx = document.getElementById("myBarChart7").getContext('2d');
      var myBarChart7 = new Chart(ctx, {
        type: 'bar',
        data: {
          labels: [
            <?php
            $banyak_data = 0;
            $a = mysql_query("SELECT SUM(total_harga) AS total, MONTH(tgl_jual) AS bulan FROM tb_penjualan WHERE YEAR(tgl_jual)= '$thn_ini' GROUP BY MONTH(tgl_jual)");

            while ($pecah = mysql_fetch_assoc($a)) {
              $banyak_data++;
              echo "'" . getBulan($pecah['bulan']) . "',";
            }
            ?>
          ],
          datasets: [{
            label: 'Total Penjualan',
            data: [
              <?php
              //include "inc/koneksi.php";
              $banyak_data = 0;
              $a1 = mysql_query("SELECT SUM(total_harga) AS total, MONTH(tgl_jual) AS bulan FROM tb_penjualan WHERE YEAR(tgl_jual)= '$thn_ini' GROUP BY MONTH(tgl_jual)");

              while ($pecah1 = mysql_fetch_assoc($a1)) {
                $banyak_data++;
                echo "'" . $pecah1['total'] . "',";
              }
              ?>
            ],
            backgroundColor: randomColor({
              count: <?= $banyak_data ?>,
              luminosity: 'dark',
              format: 'rgb' // e.g. 'rgba(9, 1, 107, 0.6482447960879654)'
            }),
            borderColor: [
              // 'rgba(255,99,132,1)',
              // 'rgba(54, 162, 235, 1)',
              // 'rgba(255, 206, 86, 1)',
              // 'rgba(75, 192, 192, 1)'
            ],
            borderWidth: 1
          }]
        },
        options: {
          scales: {
            yAxes: [{
              ticks: {
                beginAtZero: true
              }
            }]
          },
          legend: {
            display: false
          }
        }
      });
    </script>

  </body>

  </html>

<?php
} else {
  echo "<script>window.location.href='login.php';</script>";
}
?>