<?php
include "koneksi.php";
$kd_brg = @mysql_real_escape_string($_POST['kd_brg']);
$nm_brg = @mysql_real_escape_string($_POST['nm_brg']);
$satuan = @mysql_real_escape_string($_POST['satuan']);

$s_awal = @mysql_real_escape_string($_POST['s_awal']);

$sisa = $s_awal-$s_terjual;

mysql_query("update tb_barang set nama_barang = '$nm_brg',  stok_sisa=stok_sisa+'$s_awal' where kode_barang = '$kd_brg'") or die (mysql_error());
?>
<script>
	alert("Pembelian Sukses");
	window.location.href='?page=barang&action=view';
</script>