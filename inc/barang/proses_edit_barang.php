<?php
include "../koneksi.php";
$kd_brg = mysql_real_escape_string($_POST['kd_brg']);
$nm_brg = mysql_real_escape_string($_POST['nm_brg']);
$satuan = mysql_real_escape_string($_POST['satuan']);
$sup = mysql_real_escape_string($_POST['sup']);
$kat = mysql_real_escape_string($_POST['prdId']);

$hj = mysql_real_escape_string($_POST['hj']);
$hb = mysql_real_escape_string($_POST['hb']);
$s_awal = mysql_real_escape_string($_POST['s_awal']);
$disk = mysql_real_escape_string($_POST['disk']);
$s_terjual = mysql_real_escape_string($_POST['s_terjual']);
$tgl = mysql_real_escape_string($_POST['tgl']);
$sisa = $s_awal - $s_terjual;

mysql_query("UPDATE tb_barang SET nama_barang = '$nm_brg', idsup = '$sup', idkat = '$kat', satuan = '$satuan',  harga_jual = '$hj',  harga_beli = '$hb', stok_awal = '$s_awal'+stok_terjual, stok_sisa = '$s_awal', tanggal = '$tgl', diskon = '$disk' where kode_barang = '$kd_brg'") or die(mysql_error());

?>

<script>
	alert("Edit data barang sukses");
	window.location.href = '../../index.php?page=barang&action=view';
</script>