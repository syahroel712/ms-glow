<?php
include "../koneksi.php";

$kode = $_POST['kode'];
$data = mysql_fetch_assoc(mysql_query("SELECT * FROM tb_barang WHERE kode_barang='$kode'"));

if($data == TRUE)
{
	$res = array(
	'value' => 1 ,
	'pesan' => 'Kode Barang Sudah Ada..!'
	);
}else{
	$res = array(
	'value' => 0 ,
	'pesan' => ''
	);
}

echo json_encode($res);