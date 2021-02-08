<?php
include "koneksi.php";
$kodebarang = @mysql_real_escape_string($_POST['kodebarang']);
$namabarang = @mysql_real_escape_string($_POST['namabarang']);
$hargasatuan2 = @mysql_real_escape_string($_POST['hargasatuan2']);
$hargasatuan = @mysql_real_escape_string($_POST['hargasatuan']);
$jumlahjual = @mysql_real_escape_string($_POST['jumlahjual']);
$hargaakhir = @mysql_real_escape_string($_POST['hargaakhir']);
$diskon = @mysql_real_escape_string($_POST['diskon']);
$diskonharga = @mysql_real_escape_string($_POST['diskonharga']);
$sup = @mysql_real_escape_string($_POST['sup']);
$ppn = @mysql_real_escape_string($_POST['ppn']);
$nonota = @mysql_real_escape_string($_POST['nonota']);
$b=mysql_fetch_array(mysql_query("select * from tb_barang where kode_barang='$kodebarang'"));
$ha=($hargasatuan-($hargasatuan*($diskonharga/100)));
$ha2=$ha+($ha*($ppn/100));
mysql_query("insert into tb_barang_terbeli values('', '$kodebarang', '$namabarang', '$hargasatuan', '$jumlahjual', '$hargaakhir', '$nonota','$diskon')") or die (mysql_error());
mysql_query("update tb_barang set harga_beli='$ha2', stok_awal = stok_awal + '$jumlahjual', stok_sisa = stok_sisa + '$jumlahjual', hpp='$hargasatuan2', tanggal=now() where kode_barang = '$kodebarang'")or die (mysql_error());

// setelah harga_beli ini stok_awal = stok_awal + '$jumlahjual', stok_sisa = stok_sisa + '$jumlahjual'
?>