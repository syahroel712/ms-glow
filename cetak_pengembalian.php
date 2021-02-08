<?php

include "inc/koneksi.php";
include "fungsi_indotgl.php";

$tgl = date("Y-m-d");

if ($_GET['dari'] != "" and $_GET['sampai'] != "") {
	$where = "date(tgl_beli) between '$_GET[dari]' and '$_GET[sampai]'";
	$ket = "$_GET[dari] s/d $_GET[sampai]";
} else {
	$where = "date(tgl_beli)='$tgl'";
	$ket = "Hari ini";
}

$setting = mysql_fetch_assoc(mysql_query("SELECT * FROM setting"));
?>

<body onLoad="javascript:print()">

	<h3 align="center" style="margin:0px"><?= $setting['nama_toko'] ?></h3>
	<h5 align='center' style="margin:0px"><?= $setting['alamat'] ?></h5>
	<h4 align="center" style="margin-top:0px">Laporan Pengembalian (<?php echo "$ket"; ?>)</h4>


	<table id="example1" width="100%" cellspacing=0 border=1 align="center" class="table table-bordered table-striped">
		<thead>
			<tr>
				<th>No Nota</th>
				<th>Tanggal Beli</th>
				<th>Pelanggan</th>
				<th>Kasir</th>
				<th>Total Harga</th>
				<th>Diskon</th>
				<th>PPn</th>
				<th>Total Bayar</th>
			</tr>
		</thead>
		<tbody id="penjualan">
			<?php
			$sql = mysql_query("SELECT * FROM tb_pengembalian WHERE $where ORDER BY tgl_beli DESC");
			$no = 0;
			while ($data = mysql_fetch_array($sql)) {
				$no++;
			?>
				<tr>
					<td><?php echo $data['nota']; ?></td>
					<td><?php echo tgl_indo($data[tgl_beli]); ?></td>
					<td><?php echo $data['idsup']; ?></td>
					<td><?php echo $data['kasir']; ?></td>
					<?php
					$tot = mysql_fetch_array(mysql_query("SELECT *,sum(harga_akhir)as tot,(sum(harga_akhir)-(sum(harga_akhir)*(" . $data[diskon_persen] . "/100)))as tot2 FROM tb_barang_pengembalian where nota='$data[nota]' group by nota"));
					?>

					<td align="right" style="border-left:0;"><?php echo number_format($tot['tot'], 0); ?></td>
					<td align="right" style="border-left:0;">(<?php echo number_format($data['diskon_persen'], 0); ?>%) Rp. <?php echo number_format($tot['tot'] * ($data['diskon_persen'] / 100)); ?> </td>
					<td align="right" style="border-left:0;"><?php echo number_format($data['ppn'], 0); ?>%</td>
					<td align="right" style="border-left:0;"><?php echo number_format($tot[tot2] + ($tot['tot2'] * ($data['ppn'] / 100)), 0); ?></td>
				</tr>
			<?php
				$totsel += $tot['tot'];
				$totdiskon += $data['diskon_persen'];
				$totppn += $data['ppn'];
				$totbayar += $tot[tot2] + ($tot['tot2'] * ($data['ppn'] / 100));
			}
			?>
			<?php
			echo "
			<tr>
				<td colspan=4><b>TOTAL</b></td>
				<td align='right'><b>" . number_format($totsel, 0) . "</b></td>
				<td align='right'><b>" . number_format($totdiskon, 0) . " %</b></td>
				<td align='right'><b>" . number_format($totppn, 0) . " %</b></td>
				<td align='right'><b>" . number_format($totbayar, 0) . "</b></td>
			</tr>";
			?>
		</tbody>
	</table>
</body>