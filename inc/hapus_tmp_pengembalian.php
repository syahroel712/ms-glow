<?php
include"koneksi.php";
$h=mysql_query("delete from pengembalian_tmp where id_beli_tmp='$_GET[id]'");
?>
<script type="text/javascript">
$("#kodebarang").focus();
		$('#isi').load("inc/tmp_pengembalian.php");
</script>