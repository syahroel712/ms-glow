<?php
$id = @$_GET['id'];

$cari=mysql_query("select * from tb_barang_terbeli where no='$id'");
while($d=mysql_fetch_array($cari)){
mysql_query("update tb_pembelian set total=total-'$d[harga_akhir]' where nota = '$id'") or die (mysql_error());
mysql_query("update tb_barang set stok_awal = stok_awal - '$d[jml]',stok_sisa = stok_sisa - '$d[jml]' where kode_barang = '$d[kode_barang]'")or die (mysql_error());	
}
mysql_query("delete from tb_barang_terbeli where no = '$id'") or die (mysql_error());

//$cari2=mysql_fetch_array(mysql_query("select * from tb_barang_terjual where no='$id'"));
?>

<script>
	alert("Data pembelian telah dihapus");
	window.location.href='?page=pembelian&action=view&no=<?php echo"$_GET[nota]"; ?>';
</script>