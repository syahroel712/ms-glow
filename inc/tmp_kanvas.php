<?php
session_start();
error_reporting(0);
include "koneksi.php";
if ($_SESSION['admin']) {
	$kode_user = $_SESSION['admin'];
} else if ($_SESSION['kasir']) {
	$kode_user = $_SESSION['kasir'];
}
$qi = mysql_query("SELECT * from kanvas_tmp t,tb_barang b where t.kode_barang=b.kode_barang and t.id_user='$kode_user' order by id_beli_tmp desc");
$no = 1;
$st = 0;

while ($item = mysql_fetch_array($qi)) {
	$stdc = ($item['qty'] * $item['dc']);
?>

	<tr>
		<td><?= $no ?></td>
		<td><span id="kodebarang-<?= $no ?>"><?= $item['kode_barang'] ?></span></td>
		<td><span id="namabarang-<?= $no ?>"><?= $item['nama_barang'] ?></span></td>
		<td><span id="jumlahjual-<?= $no ?>"><?= $item['qty'] ?></span></td>
		<td>Rp.</td>
		<td><span id="hargasatuan2-<?= $no ?>"><?= $item['hrg'] ?></span></td>
		<td><span id="diskon-<?= $no ?>"><?= $item['dc'] ?></span></td>
		<td>Rp.</td>
		<td><span id="hargasatuan-<?= $no ?>"><?= round($stdc) ?></span></td>
		<td>Rp.</td>
		<td><span class="harga-akhir-tabel" id="hargaakhir-<?= $no ?>"><?= round( $item['hrg'] * $item['qty'] - $stdc) ?></span></td>
		<td>

			<a href="inc/hapus_tmp_kanvas.php?id=<?php echo "$item[id_beli_tmp]"; ?>">
				<button class='btn btn-danger btn-xs' title='Delete Data'><span class='fa fa-trash-alt'></span></button>
			</a>

		</td>
	</tr>

<?php
	$no++;
	$st += round($item['hrg'] * $item['qty'] - $stdc);
}
?>

<script>
	$("#subtotal").val("<?php echo $st; ?>").number(true, 0);

	var diskonpersen = $("#persen").val();
	var subtotal = $("#subtotal").val();
	$("#diskonharga").val(<?php echo $st; ?>);

	var diskonharga = $("#diskonharga").val();
	$("#totalharga").val(<?php echo $st; ?>);
	$("#tagihan").text(subtotal).number(true, 0);

	$(function() {
		$('#isi a').click(function() {
			var url = $(this).attr('href');
			$('#hasil').load(url);
			$('#isi').load("inc/tmp_kanvas.php");
			return false;
		});
	});
</script>