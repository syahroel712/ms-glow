<?php
error_reporting(0);
include "../koneksi.php";
include "../tglindo.php";
$tgl = date('d M Y');
?>

<body onLoad="javascript:print()">
	<?php
	//include "../fungsi_indotgl.php" ;
	$BulanIndo = array("", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");

	$sup = mysql_fetch_assoc(mysql_query("SELECT nmsup FROM tb_supplier WHERE idsup='$_GET[supplier]'"));

	$setting = mysql_fetch_assoc(mysql_query("SELECT * FROM setting"));
	?>
	<h3 align="center" style="margin:0px"><?= $setting['nama_toko'] ?></h3>
	<h5 align='center' style="margin:0px"><?= $setting['alamat'] ?></h5>
	<h4 align="center" style="margin-top:0px">Laporan Barang Per Supplier (<?php echo "$_GET[dari] s/d $_GET[sampai] $sup[nmsup]"; ?>)</h4>


	<table id="example1" width="100%" cellspacing=0 border=1 align="center" class="table table-bordered table-striped">
		<thead>
			<tr>
				<th>No</th>
				<th>Nama Barang</th>
				<th>Jumlah Jual</th>
				<th>Total Penjualan</th>
			</tr>
		</thead>
		<tbody id="penjualan">
			<?php

			$tgl = date("Y-m-d");

			$sql = mysql_query("SELECT *, SUM(jumlah_jual) AS jum, SUM(harga_akhir) AS tot FROM tb_penjualan p LEFT JOIN tb_barang_terjual j ON p.no_nota=j.no_nota LEFT JOIN tb_barang b ON j.kode_barang=b.kode_barang LEFT JOIN tb_supplier su ON b.idsup=su.idsup WHERE b.idsup='$_GET[supplier]' AND date(tgl_jual) between '$_GET[dari]' and '$_GET[sampai]' GROUP BY j.kode_barang");


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
						<td><?= $data['nama_barang']; ?></td>
						<td><?= $data['jum']; ?></td>
						<td align="right" style="border-left:0;">
							<?= number_format($data['tot']); ?>
						</td>
					</tr>
			<?php
					$tot1 += $data['tot'];
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