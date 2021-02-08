<?php
include "koneksi.php";
$tgl = date('Y-m-d H:i:s');

$tgl = date("Y-m-d");

// if ($_GET['kode'] != "") {
// 	$kode = "and p.kasir='$_GET[kode]'";
// 	$produk = "- Kasir : $_GET[kode]";
// }

if ($_GET['dari'] != "" and $_GET['sampai'] != "") {
	$squ = "where date(tgl_jual) between '$_GET[dari]' and '$_GET[sampai]' $kode";
	$ket = "$_GET[dari] s/d $_GET[sampai]";
} else {
	$ket = "$tgl";
	$squ = "where date(tgl_jual)='$tgl'";
}

// Fungsi header dengan mengirimkan raw data excel
header("Content-type: application/vnd-ms-excel");
// Mendefinisikan nama file ekspor "hasil-export.xls"
header("Content-Disposition: attachment; filename=data_penjualan_$ket.xls");

// Tambahkan table
?>
<center>
	<h2><?= $ket ?></h2>
</center>
<table id="example1" class="table table-bordered" border="1" cellpadding="5">
	<thead>
		<tr>
			<th>No</th>
			<th>No Nota</th>
			<th>Tanggal Jual</th>
			<th>Kasir</th>
			<th>Total Harga</th>
			<th>Bayar</th>
			<th>Kembalian</th>
			<th>Metode Pembayaran</th>
		</tr>
	</thead>
	<tbody id="penjualan">
		<?php
		$sql = mysql_query("SELECT * FROM tb_penjualan $squ ORDER BY tgl_jual DESC");
		$cek = mysql_num_rows($sql);
		if ($cek < 1) {
		?>

			<tr>
				<td colspan="8" class="p-3">Data tidak ditemukan</td>
			</tr>

			<?php
		} else {
			$no = 1;
			while ($data = mysql_fetch_array($sql)) {
			?>
				<tr>
					<?php
					$tot = mysql_fetch_array(mysql_query("SELECT *,SUM(harga_akhir) AS tot FROM tb_barang_terjual WHERE no_nota='$data[no_nota]' GROUP BY no_nota"));
					?>
					<td><?php echo "$no"; ?></td>
					<td>
						<?= $data['no_nota']; ?>
					</td>
					<td><?= $data['tgl_jual']; ?></td>
					<td><?= $data['kasir']; ?></td>
					<td align="right"><?= number_format($data['total_harga'], 0, ".", ","); ?></td>
					<td align="right"><?= number_format($data['bayar'], 0, ".", ","); ?></td>
					<td align="right"><?= number_format($data['bayar'] - $data['total_harga'], 0, ".", ","); ?></td>
					<td><?= $data['metode_pembayaran'] ?></td>
				</tr>
		<?php
				$totdismember += $data['diskon_total'];
				$totsel += $tot['tot'];
				$totseluruh = $totsel - $totdismember;
				$totbayar += $data['bayar'];
				$no++;
			}
		}
		?>
	</tbody>

	<tr>
		<td colspan=4><b>TOTAL</b></td>
		<td align='right'><b><?= number_format($totseluruh, 0) ?></b></td>
		<td align='right'><b> </b></td>
		<td align='right'><b> </b></td>

		<!--<td align='right'><b><?= number_format($totbayar, 0) ?></b></td>-->
		<!--			<td align='right'><b><?= number_format($totbayar - $totsel, 0) ?></b></td>-->
		<th></th>
	</tr>

</table>