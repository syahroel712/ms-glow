<?php
include "../koneksi.php";
include "../tglindo.php";
$tgl = date('d M Y');
?>

<body onLoad="javascript:print()">

	<?php
	$tgl = date("Y-m-d");
	if ($_GET['dari'] != "" and $_GET['sampai'] != "") {
		$where = "and date(tgl_beli) between '$_GET[dari]' and '$_GET[sampai]'";
		$ket = "$_GET[dari] s/d $_GET[sampai]";
	} else {
		$where = "and date(tgl_beli)='$tgl'";
		$ket = "Hari ini";
	}

	$setting = mysql_fetch_assoc(mysql_query("SELECT * FROM setting"));
	?>

	<h3 align="center" style="margin:0px"><?= $setting['nama_toko'] ?></h3>
	<h5 align='center' style="margin:0px"><?= $setting['alamat'] ?></h5>

	<h4 align="center" style="margin-top:0px">Laporan Pembelian Harian (<?php echo "$ket"; ?>)</h4>


	<table id="example1" width="100%" cellspacing=0 border=1 align="center" class="table table-bordered table-striped">
		<thead>
			<tr>
				<th>No</th>
				<th>Tanggal</th>
				<th>No Nota</th>
				<th>Total Harga</th>
				<th>Diskon</th>
				<th>PPn</th>
				<th>Total Pembelian</th>

			</tr>
		</thead>
		<tbody id="pembelian">
			<?php
			$sql = mysql_query("select *,date(tgl_beli)as tgl,sum(d.harga_akhir)as tot from tb_barang_terbeli d,tb_pembelian p where p.nota=d.nota $where group by p.nota") or die(mysql_error());
			$cek = mysql_num_rows($sql);
			if ($cek < 1) {
			?><tr>
					<td colspan="13" style="padding:10px;">Data tidak ditemukan</td>
				</tr><?php
						} else {
							$no = 1;
							while ($data = mysql_fetch_array($sql)) {
							?><tr>
						<td><?php echo "$no"; ?></td>
						<td><?php echo $data['tgl']; ?></td>
						<td><?php echo $data['nota']; ?></td>
						<td align="right" style="border-left:0;"><?php echo number_format($data['tot'], 0, ".", ","); ?></td>
						<td align="right" style="border-left:0;"><?php echo number_format($data['diskon_persen'], 0, ".", ","); ?></td>
						<td align="right" style="border-left:0;"><?php echo number_format($data['ppn'], 0, ".", ","); ?></td>
						<td align="right" style="border-left:0;"><?php echo number_format($data['tot'] - ($data['tot'] * ($data['diskon_persen'] / 100)) + (($data['tot'] - ($data['tot'] * ($data['diskon_persen'] / 100))) * $data['ppn'] / 100), 0, ".", ","); ?></td>

					</tr><?php
								$tot1 = $tot1 + ($data['tot'] - ($data['tot'] * ($data['diskon_persen'] / 100)) + (($data['tot'] - ($data['tot'] * ($data['diskon_persen'] / 100))) * $data['ppn'] / 100));

								$no++;
							}
							echo "
			<tr>
				<td colspan=6><b>TOTAL</b></td>
				<th align='right'>" . number_format($tot1, 0) . "</th>
			</tr>
			";
						} ?>
		</tbody>
	</table>
</body>