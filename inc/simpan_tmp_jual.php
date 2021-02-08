<?php
session_start();
include "koneksi.php";
if ($_SESSION['admin']) {
	$kode_user = $_SESSION['admin'];
} else if ($_SESSION['kasir']) {
	$kode_user = $_SESSION['kasir'];
}

$brg = mysql_query("SELECT * FROM tb_barang WHERE kode_barang='$_POST[kodebarang]'");
if (mysql_num_rows($brg) > 0) {
	$cr = mysql_query("SELECT * FROM jual_tmp WHERE kode_barang='$_POST[kodebarang]' AND id_user='$kode_user'");
	if (mysql_num_rows($cr) > 0) {
		$rcr = mysql_fetch_array($cr);
		mysql_query("UPDATE jual_tmp SET qty=qty+$_POST[jumlahjual], disc=disc+$_POST[disc] WHERE id_tmp_jual='$rcr[id_tmp_jual]'");
	} else {
		mysql_query("INSERT INTO jual_tmp VALUES('','$kode_user','$_POST[kodebarang]','$_POST[jumlahjual]','$_POST[kp]','$_POST[id_satuan]','$_POST[harga_barang]', '$_POST[disc]')");
	}
} else {
?>
	<script>
		alert("Kode barang tidak ditemukan");
	</script>
<?php
}
?>
<script>
	$("#batalitem").click();
	$('#isi').load("inc/tmp_jual.php");
</script>