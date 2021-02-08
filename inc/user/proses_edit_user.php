<?php
include "../koneksi.php";
$id = mysql_real_escape_string($_POST['id']);
$nm = mysql_real_escape_string($_POST['nm']);
$user = mysql_real_escape_string($_POST['user']);
$pass = mysql_real_escape_string($_POST['pass']);
$jk = mysql_real_escape_string($_POST['jk']);
$alamat = mysql_real_escape_string($_POST['alamat']);
$tlp = mysql_real_escape_string($_POST['tlp']);
$ket = mysql_real_escape_string($_POST['ket']);
$level = mysql_real_escape_string($_POST['level']);
mysql_query("UPDATE tb_user set username = '$user', password = md5('$pass'), pass = '$pass', nama_lengkap = '$nm', jenis_kelamin = '$jk', alamat = '$alamat', no_telepon = '$tlp', keterangan = '$ket', level = '$level' where kode_user = '$id'");

?>

<script>
	alert("User berhasil diedit");
	window.location.href = '../../?page=user&action=view';
</script>