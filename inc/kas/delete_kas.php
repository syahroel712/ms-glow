<?php
$kd_brg = $_GET['id'];
mysql_query("DELETE FROM tb_kas WHERE idkas = '$kd_brg'");
?>
<script>
  alert("Data kas dengan kode <?php echo $kd_brg; ?> berhasil dihapus");
  window.location.href = '?page=kas&action=view';
</script>