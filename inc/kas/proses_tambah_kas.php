<?php
include "../koneksi.php";
$kd_brg = mysql_real_escape_string($_POST['kd_brg']);
$nm_brg = mysql_real_escape_string($_POST['nm_brg']);

$hj = mysql_real_escape_string($_POST['hj']);
$hb = mysql_real_escape_string($_POST['hb']);
$saldo = mysql_real_escape_string($_POST['saldo']);
$jenis = mysql_real_escape_string($_POST['jenis']);

mysql_query("INSERT into tb_kas values ('', '$nm_brg', '$jenis','$kd_brg','$hj','$hb')") or die(mysql_error());

?>
<script>
  alert("Penambahan data kas sukses");
  window.location.href = '../../?page=kas&action=view';
</script>