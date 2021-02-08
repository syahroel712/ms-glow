<?php
session_start();
include "koneksi.php";
if ($_SESSION['admin']) {
	$kode_user = $_SESSION['admin'];
} else if ($_SESSION['kasir']) {
	$kode_user = $_SESSION['kasir'];
}

$qi = mysql_query("SELECT * FROM jual_tmp t,tb_barang b WHERE t.kode_barang=b.kode_barang AND t.id_user='$kode_user' ORDER BY id_tmp_jual ASC");
$no = 1;
$subtotal = 0;
$jmlno = mysql_num_rows($qi);
while ($item = mysql_fetch_array($qi)) {
	$harga_barang = $item['harga_jual'];
	$hs = 0;
	$lv = mysql_query("SELECT * FROM tb_level WHERE kode_barang='$item[kode_barang]' ORDER BY hrg ASC");
	while ($level = mysql_fetch_array($lv)) {
		if ($item['qty'] <= $level['sampai'] and $item['qty'] >= $level['dari']) {
			$hs = $level['hrg'];
		}
	}
	if ($hs == "" or $hs == "0") {
		$diskon = $item['disc'] / $item['qty'];

		// $hargadiskon = ($item['harga_jual'] * $diskon) / 100;
		$hargadiskon = $diskon;
		$totdiskon = $item['harga_jual'] - $hargadiskon;
		$total = $totdiskon * $item['qty'];
	}
?>

	<tr>
		<td><?= $no ?></td>
		<td><span id="kodebarang-<?= $no ?>"><?= $item['kode_barang'] ?></span></td>
		<td><span id="namabarang-<?= $no ?>"><?= $item['nama_barang'] ?></span></td>
		<td>Rp.</td>
		<td><span id="hargasatuan-<?= $no ?>"><?= round($harga_barang) ?></span></td>
		<input type='text' id='diskonPersen' value="<?= $item['disc'] ?>">
		<td><span id="jumlahjual-<?= $no ?>"><?= $item['qty'] ?></span></td>
		<td><span style="display: none;" id="disc-<?= $no ?>"><?= $item['disc'] ?></span>
			<span id="discount-<?= $no ?>"><?= $diskon ?></span>
		</td>
		<td>Rp.
		</td>
		<td><span class="harga-akhir-tabel" id="hargaakhir-<?= $no ?>"><?= $total ?></span></td>
		<td>

			<a href="inc/hapus_tmp_jual.php?id=<?php echo "$item[id_tmp_jual]"; ?>">
				<button class='btn btn-danger btn-xs' title='Delete Data'><span class='fa fa-trash-alt'></span></button>
			</a>

		</td>
	</tr>
<?php
	$no++;
	$jmlno = $jmlno - 1;
	$subtotal += $total;
}
?>
<script>
	$("#totalharga").val("<?php echo $subtotal; ?>").number(true, 0);
	$("#subtotal").val("<?php echo $subtotal; ?>").number(true, 0);
	$("#tagihan").text("<?php echo $subtotal; ?>").number(true, 0);

	$(function() {
		$('#isi a').click(function() {
			var url = $(this).attr('href');
			$('#hasil').load(url);
			$('#isi').load("inc/tmp_jual.php");
			return false;
		});
	});
</script>