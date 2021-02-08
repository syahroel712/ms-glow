<?php
$kd_brg = @$_GET['id'];
mysql_query("delete from tb_user where kode_user = '$kd_brg'") or die (mysql_error());
?>
<script>
alert("Data user dengan kode <?php echo $kd_brg; ?> berhasil dihapus");
window.location.href='?page=user&action=view';
</script>