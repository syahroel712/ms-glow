<?php
error_reporting(0);
include "../koneksi.php";
include "../tglindo.php";
$tgl = date('d M Y');

$setting = mysql_fetch_assoc(mysql_query("SELECT * FROM setting"));
?>

<body onLoad="javascript:print()">
	<?php
	//include "../fungsi_indotgl.php" ;
	$BulanIndo = array("", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");

	?>
	<h3 align="center" style="margin:0px"><?= $setting['nama_toko'] ?></h3>
	<h5 align='center' style="margin:0px"><?= $setting['alamat'] ?></h5>
	<h4 align="center" style="margin-top:0px">Laporan Pembelian Member</h4>


	<table id="example1" width="100%" cellspacing=0 border=1 align="center" class="table table-bordered table-striped">
		<thead>
			<tr>
				<th>No</th>
				<th>Nama Member</th>
				<th>Jumlah Transaksi</th>
				<th>Total Transaksi</th>
			</tr>
		</thead>
		<tbody id="penjualan">
			<?php

			if ($_GET['dari'] != "" and $_GET['sampai'] != "") {

				$sql = mysql_query("SELECT *,COUNT(*) AS tottransaksi, SUM(total_harga) AS tothargatransaksi FROM tb_penjualan p, tb_member m WHERE p.pelanggan=m.id_member AND date(tgl_jual) between '$_GET[dari]' and '$_GET[sampai]' GROUP BY p.pelanggan") or die(mysql_error());
			} else {
				$tgl = date("Y-m-d");

				$sql = mysql_query("SELECT *,COUNT(*) AS tottransaksi, SUM(total_harga) AS tothargatransaksi FROM tb_penjualan p, tb_member m WHERE p.pelanggan=m.id_member AND date(tgl_jual)='$tgl' GROUP BY p.pelanggan") or die(mysql_error());
			}

			$cek = mysql_num_rows($sql);
			if ($cek < 1) {
			?><tr>
					<td colspan="13" style="padding:10px;">Data tidak ditemukan</td>
				</tr>
				<?php
			} else {
				$no = 1;
				while ($data = mysql_fetch_array($sql)) {

				?>
					<tr>
						<td><?= "$no"; ?></td>
						<td><?= $data['nm']; ?></td>
						<td><?= $data['tottransaksi']; ?></td>
						<td align="right" style="border-left:0;">
							<?= number_format($data['tothargatransaksi']); ?>
						</td>
					</tr>
			<?php
					$tot1 += $data['tothargatransaksi'];
					$no++;
				}
			}
			?>
		</tbody>
		<tr>
			<td colspan=3><b>TOTAL</b></td>
			<td align='right'><b><?= number_format($tot1, 0) ?></b></td>
		</tr>
	</table>
</body>