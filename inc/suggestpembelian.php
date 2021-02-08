<?php
include "koneksi.php";

$src = addslashes($_POST['src']);
$query = mysql_query('SELECT * from tb_barang where nama_barang like "' . $src . '%" LIMIT 0,20');
while ($data = mysql_fetch_array($query)) {
	echo '<span class="pilihan" id="pilihbrg" onclick="pilih_kota(\'' . $data['nama_barang'] . '\');hideStuff(\'suggest\');pilih_kode(\'' . $data['kode_barang'] . '\');pilih_stok(\'' . $data['stok_sisa'] . '\');pilih_hrg(\'' . $data['harga_beli'] . '\');">' . $data['nama_barang'] . '</span>';
}
?>
<script type="text/javascript">
	$("#pilihbrg").click(function() {
		//alert('tes');
		$("#hargabarang").focus();

	});
</script>