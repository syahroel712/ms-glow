<?php
session_start();
include"koneksi.php";
if(@$_SESSION['admin']) {
	$kode_user = @$_SESSION['admin'];
} else if(@$_SESSION['kasir']) {
	$kode_user = @$_SESSION['kasir'];
}
include"koneksi.php";
		mysql_query("delete from beli_tmp where id_user='$kode_user'");
?>
<script type="text/javascript">
		$('#isi').load("inc/tmp_beli.php");
</script>
		