<?php
include"koneksi.php";
$h=mysql_query("delete from tb_level where id_level='$_GET[id]'");
?>
<script type="text/javascript">
		$("#isi").load("inc/isi_level.php?kode=<?php echo"$_GET[kode]"; ?>");
</script>