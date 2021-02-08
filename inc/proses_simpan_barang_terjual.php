<?php
include "koneksi.php";
$kodebarang = @mysql_real_escape_string($_POST['kodebarang']);
$namabarang = @mysql_real_escape_string($_POST['namabarang']);
$hargasatuan = @mysql_real_escape_string($_POST['hargasatuan']);
$jumlahjual = @mysql_real_escape_string($_POST['jumlahjual']);
$hargaakhir = @mysql_real_escape_string($_POST['hargaakhir']);
$nonota = @mysql_real_escape_string($_POST['nonota']);
$id_satuan = @mysql_real_escape_string($_POST['nama_satuan']);
$disc = @mysql_real_escape_string($_POST['disc']);

$b = mysql_fetch_array(mysql_query("select * from tb_barang where kode_barang='$kodebarang'"));
mysql_query("insert into tb_barang_terjual values('', '$kodebarang', '$namabarang', '$b[harga_beli]', '$hargasatuan', '$jumlahjual', '$hargaakhir', '$nonota', '$id_satuan', '$disc')") or die(mysql_error());
mysql_query("update tb_barang set stok_terjual = stok_terjual + '$jumlahjual', stok_sisa = stok_sisa - '$jumlahjual' where kode_barang = '$kodebarang'") or die(mysql_error());
