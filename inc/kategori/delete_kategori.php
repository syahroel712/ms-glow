<?php
$id = $_GET['id'];
mysql_query("DELETE from kategori where idkat = '$id'");
?>

<script>
	alert("Data kategori telah dihapus");
	window.location.href = '?page=kategori&action=view';
</script>