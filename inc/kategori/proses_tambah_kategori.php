<?php
include "../koneksi.php";

$nm = mysql_real_escape_string($_POST['nm']);
$user = mysql_real_escape_string($_POST['jns']);
$alamat = mysql_real_escape_string($_POST['alamat']);
$nohp = mysql_real_escape_string($_POST['nohp']);
mysql_query("INSERT into kategori VALUES ('$user', '$nm', '$alamat')") or die(mysql_error());
?>

<script>
	alert("Kategori baru berhasil ditambahkan");
	window.location.href = '?page=kategori&action=view';
</script>