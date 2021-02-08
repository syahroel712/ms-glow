<?php
include "../koneksi.php";

$id = mysql_real_escape_string($_POST['id']);
$nm = mysql_real_escape_string($_POST['nm']);
$jns = mysql_real_escape_string($_POST['jns']);
$alamat = mysql_real_escape_string($_POST['alamat']);
$nohp = mysql_real_escape_string($_POST['nohp']);

mysql_query("UPDATE kategori set nmkat = '$nm', persen = '$nohp' where idkat = '$id'") or die(mysql_error());

?>
<script>
	alert("Kategori berhasil diedit");
	window.location.href = '../../?page=kategori&action=view';
</script>