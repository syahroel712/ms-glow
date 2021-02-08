<?php
include "../koneksi.php";

$id = mysql_real_escape_string($_POST['id']);
$nm = mysql_real_escape_string($_POST['nm']);
$alamat = mysql_real_escape_string($_POST['alamat']);
$nohp = mysql_real_escape_string($_POST['nohp']);
$sales = mysql_real_escape_string($_POST['sales']);
$nosales = mysql_real_escape_string($_POST['nosales']);

mysql_query("UPDATE tb_supplier set nmsup = '$nm', almt_s = '$alamat', notelp_s = '$nohp', sales = '$sales', nosales = '$nosales' where idsup = '$id'") or die(mysql_error());
?>
<script>
	alert("Pemasok berhasil diedit");
	window.location.href = '../../?page=pemasok&action=view';
</script>