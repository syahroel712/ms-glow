<?php
include "../koneksi.php";
$id = $_GET['id'];
mysql_query("DELETE from tb_so where id = '$id'") or die(mysql_error());
?>
<script>
  alert("Data berhasil dihapus");
  window.location.href = '../../index.php?page=laporan_so';
</script>