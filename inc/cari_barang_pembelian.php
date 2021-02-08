<?php
include "koneksi.php";

$kodebarang = @mysql_real_escape_string($_POST['kodebarang']);
$sql = mysql_query("select * from tb_barang where kode_barang = '$kodebarang'") or die (mysql_error());
$data = mysql_fetch_array($sql);
$cek = mysql_num_rows($sql);
if($cek > 0) { ?>
	<script type="text/javascript">
	$("#namabarang").val("<?php echo $data['nama_barang']; ?>");
	$("#stokbarang").val("<?php echo $data['stok_sisa']; ?>");
	$("#hargabarang").val("<?php echo $data['hpp']; ?>");
	//$("#hargabarang").focus();
	</script> <?php
} else {
	?> <script type="text/javascript">
	$("#namabarang").val("");
	$("#stokbarang").val("");
	$("#hargabarang").val("");
	</script> <?php
}
?>