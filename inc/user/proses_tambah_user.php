<?php
include "../koneksi.php";
$nm = mysql_real_escape_string($_POST['nm']);
$user = mysql_real_escape_string($_POST['user']);
$pass = mysql_real_escape_string($_POST['pass']);
$jk = mysql_real_escape_string($_POST['jk']);
$alamat = mysql_real_escape_string($_POST['alamat']);
$tlp = mysql_real_escape_string($_POST['tlp']);
$ket = mysql_real_escape_string($_POST['ket']);
$level = mysql_real_escape_string($_POST['level']);
mysql_query("INSERT into tb_user values ('', '$user', md5('$pass'), '$pass', '$nm', '$jk', '$alamat', '$tlp', '$ket', '$level')") or die(mysql_error());
?>

<script>
	alert("User baru berhasil ditambahkan");
	window.location.href = '../../?page=user&action=view';
</script>