<?php
$id = @$_GET['id'];
mysql_query("delete from tb_supplier where idsup = '$id'") or die (mysql_error());
?>

<script>
	alert("Data pemasok telah dihapus");
	window.location.href='?page=pemasok&action=view';
</script>