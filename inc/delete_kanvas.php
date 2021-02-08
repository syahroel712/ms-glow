<?php
$id = @$_GET['id'];

$cari=mysql_query("select * from tb_barang_terbeli where nota='$id'");
while($d=mysql_fetch_array($cari)){
mysql_query("update tb_barang set stok_sisa = stok_sisa - '$d[jml]',stok_awal = stok_awal - '$d[jml]' where kode_barang = '$d[kode_barang]'")or die (mysql_error());	
}
mysql_query("delete from tb_pembelian where nota = '$id'") or die (mysql_error());
mysql_query("delete from tb_barang_terbeli where nota = '$id'") or die (mysql_error());

?>

<script>
	alert("Data pembelian telah dihapus");
	window.location.href='?page=pembelian&action=view';
</script>