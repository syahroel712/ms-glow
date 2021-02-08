<?php
$id = $_GET['id'];
mysql_query("DELETE from tb_modal where id_modal = '$id'") or die(mysql_error());
?>

<script>
	alert("Data modal telah dihapus");
	window.location.href = '?page=modal&action=view';
</script>