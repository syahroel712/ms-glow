<?php
$kd_brg = $_GET['id'];
mysql_query("DELETE from tb_barang where kode_barang = '$kd_brg'") or die(mysql_error());
?>
<script>
  alert("Data barang dengan kode <?php echo $kd_brg; ?> berhasil dihapus");
  window.location.href = '?page=barang&action=view';
</script>