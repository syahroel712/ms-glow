<?php
include "koneksi.php";

$data_barang = array();

$data_barang = mysql_fetch_assoc(mysql_query("select * from tb_barang where kode_barang='$_GET[kode_barang]'"));

$data_barang['list_satuan'] = array();
$data_satuan = mysql_query("select * from tb_satuan where kode_barang='$_GET[kode_barang]'");

while($data = mysql_fetch_assoc($data_satuan))
{
	$data_barang['list_satuan'][] = $data;
}

echo json_encode($data_barang);
?>