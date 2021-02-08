<?php
error_reporting(0);
date_default_timezone_set('Asia/Jakarta');
mysql_connect("localhost", "root", "") or die(mysql_error());
mysql_select_db("market_kasir") or die(mysql_error());
$r = mysql_fetch_array(mysql_query("select * from tb_visi"));
$tgl_skr = date('Y-m-d');
if ($tgl_skr >= "$r[kadaluarsa]") {
  echo "<div class='container-fluid'><h2 style='color:red;' align='center'>Aplikasi Sudah Expired Silakan diperbaharui ...!</h2></div>";
?>

  <div style="text-align: center;">
    <form method="POST" action="">
      <input type="text" name="kodeaktivasi" class="form-control" placeholder="Masukkan Kode Aktivasi..." style="padding: 5px; width: 300px;">
      <button type="submit" class="btn btn-primary" name="simpanAktivasi" style="padding: 5px; cursor: pointer;">Simpan</button>
    </form>
  </div>

  <?php
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
        window.location.href = 'index.php';
      </script>
<?php
    } else {
      echo "<script>alert('kode aktivasi tidak tersedia')</script>";
    }
  }

  mysql_connect("localhost", "", "?") or die(mysql_error());
  mysql_select_db("") or die(mysql_error());
}
?>