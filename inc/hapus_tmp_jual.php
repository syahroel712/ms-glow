<?php
include"koneksi.php";
$h=mysql_query("delete from jual_tmp where id_tmp_jual='$_GET[id]'");
?>
<script type="text/javascript">
$("#kodebarang").focus();
		$('#isi').load("inc/tmp_jual.php");
</script>