<?php
include "koneksi.php";

$src = addslashes($_POST['src']);
$query = mysql_query('SELECT * FROM tb_barang WHERE nama_barang LIKE "' . $src . '%" limit 0,20');
while ($data = mysql_fetch_array($query)) {
	echo '<span class="pilihan" id="pilihbrg" 
	onclick="hideStuff(\'suggest\');
	pilih_kode(\'' . $data['kode_barang'] . '\');
	pilih_stok(\'' . $data['stok_sisa'] . '\');
	pilih_hrg(\'' . $data['harga_jual'] . '\');
	pilih_disk(\'' . $data['diskon'] . '\');
	pilih_barang(\'' . $data['nama_barang'] . '\');
	">' . $data['nama_barang'] . '</span>';
}
