<?php
include "koneksi.php";

$src = addslashes($_POST['src']);
$query = mysql_query('select * from tb_barang where nama_barang like "' . $src . '%" limit 0,20');
while ($data = mysql_fetch_assoc($query)) {
	echo '<span class="pilihan" id="pilihbrg" onclick="pilih_kota(\'' . $data['nama_barang'] . '\');hideStuff(\'suggest\');pilih_kode(\'' . $data['kode_barang'] . '\');pilih_stok(\'' . $data['stok_sisa'] . '\');pilih_beli(\'' . $data['harga_beli'] . '\');pilih_satuan(\'' . $data['harga_jual'] . '\');">' . $data['nama_barang'] . '</span>';
}
?>
<script type="text/javascript">


</script>