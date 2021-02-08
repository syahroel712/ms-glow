<?php
include "koneksi.php";

$id_satuan = @mysql_real_escape_string($_POST['id_satuan']);
$kode_barang = @mysql_real_escape_string($_POST['kode_barang']);
$nama_satuan = @mysql_real_escape_string($_POST['nama_satuan']);
$harga_satuan = @mysql_real_escape_string($_POST['harga_satuan']);

mysql_query("update tb_satuan set kode_barang = '$kode_barang', nama_satuan = '$nama_satuan', harga_satuan = '$harga_satuan' where id_satuan = '$id_satuan'") or die(mysql_error());

?>
<script>
	alert("Satuan berhasil diedit");
	window.location.href = "../?page=lihat_satuan&kode_barang=<?= $kode_barang ?>";
</script>