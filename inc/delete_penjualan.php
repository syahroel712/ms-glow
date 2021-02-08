<?php
$id = $_GET['id'];
mysql_query("DELETE from tb_penjualan where no_nota = '$id'");

$cari = mysql_query("SELECT * from tb_barang_terjual where no_nota='$id'");
while ($d = mysql_fetch_array($cari)) {
	mysql_query("UPDATE tb_barang set stok_terjual = stok_terjual - '$d[jumlah_jual]', stok_sisa = stok_sisa + '$d[jumlah_jual]' where kode_barang = '$d[kode_barang]'") or die(mysql_error());
}
mysql_query("DELETE from tb_barang_terjual where no_nota = '$id'");

?>

<script>
	alert("Data penjualan telah dihapus");
	window.location.href = '?page=penjualan&action=view';
</script>