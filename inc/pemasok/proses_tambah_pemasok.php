<?php
include "../koneksi.php";
$nm = mysql_real_escape_string($_POST['nm']);
$alamat = mysql_real_escape_string($_POST['alamat']);
$nohp = mysql_real_escape_string($_POST['nohp']);
$sales = mysql_real_escape_string($_POST['sales']);
$nosales = mysql_real_escape_string($_POST['nosales']);
mysql_query("INSERT into tb_supplier values ('', '$nm', '$alamat', '$nohp', '$sales', '$nosales')") or die(mysql_error());
?>

<script>
	alert("Pemasok baru berhasil ditambahkan");
	window.location.href = '../../?page=pemasok&action=view';
</script>