<?php
include "../koneksi.php";

$id = mysql_real_escape_string($_POST['id']);
$nm_brg = mysql_real_escape_string($_POST['nm_brg']);
$kd_brg = mysql_real_escape_string($_POST['kd_brg']);

$hj = mysql_real_escape_string($_POST['hj']);
$hb = mysql_real_escape_string($_POST['hb']);
$saldo = mysql_real_escape_string($_POST['saldo']);
$jenis = mysql_real_escape_string($_POST['jenis']);

mysql_query("UPDATE tb_kas SET ket= '$nm_brg',jenis = '$jenis',  tgl = '$kd_brg', debit='$hj',kredit='$hb' where idkas = '$id'") or die(mysql_error());

?>
<script>
	alert("kas berhasil diedit");
	window.location.href = '../../?page=kas&action=view';
</script>