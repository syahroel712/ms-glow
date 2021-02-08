<?php
$kd_brg = @$_GET['id'];
mysql_query("delete from tb_member where id_member = '$kd_brg'") or die (mysql_error());
?>
<script>
alert("Data member dengan kode <?php echo $kd_brg; ?> berhasil dihapus");
window.location.href='?page=member&action=view';
</script>