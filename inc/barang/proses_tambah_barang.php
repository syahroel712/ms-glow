<?php
include "../koneksi.php";
$kd_brg = mysql_real_escape_string($_POST['kd_brg']);
$nm_brg = mysql_real_escape_string($_POST['nm_brg']);
$satuan = mysql_real_escape_string($_POST['satuan']);
$sup = mysql_real_escape_string($_POST['sup']);
$kat = mysql_real_escape_string($_POST['kat']);
$hj = mysql_real_escape_string($_POST['hj']);
$hpp = mysql_real_escape_string($_POST['hpp']);
$hb = mysql_real_escape_string($_POST['hb']);
$s_awal = mysql_real_escape_string($_POST['s_awal']);
$disk = mysql_real_escape_string($_POST['disk']);
$tgl = mysql_real_escape_string($_POST['tgl']);

mysql_query("INSERT into tb_satuan values ('','$kd_brg','$satuan','$hj','')") or die(mysql_error());

$id_satuan_sementara = mysql_fetch_assoc(mysql_query("SELECT LAST_INSERT_ID() AS id"));

$id_satuan = $id_satuan_sementara['id'];

$simpan = mysql_query("INSERT INTO tb_barang values ('$kd_brg', '$nm_brg', '$satuan',  '$hj','0','0','0','$hb', '$s_awal', '0', '$s_awal', '$tgl', '$kat', '$sup', '$hb',  '$disk','$id_satuan')") or die(mysql_error());

if ($simpan) {
?>
  <script>
    alert("Penambahan data barang sukses");
    window.location.href = '?page=barang&action=input';
  </script>
<?php
} else {
?>
  <script>
    alert("Gagal menambah barang");
    window.location.href = '?page=barang&action=input';
  </script>
<?php
}
?>