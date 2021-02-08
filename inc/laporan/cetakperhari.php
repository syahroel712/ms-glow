<?php
error_reporting(0);
include "../koneksi.php";
include "../tglindo.php";
$tgl = date('d M Y');
?>

<body onLoad="javascript:print()">

	<?php
	$tgl = date("Y-m-d");

	if ($_GET['kode'] != "") {
		$kode = "and p.kasir='$_GET[kode]'";
		$produk = "- Kasir : $_GET[kode]";
	}

	if ($_GET['dari'] != "" and $_GET['sampai'] != "") {
		$where = "and date(tgl_jual) between '$_GET[dari]' and '$_GET[sampai]' $kode";
		$ket = "$_GET[dari] s/d $_GET[sampai]";
	} else {
		$where = "and date(tgl_jual)='$tgl' $kode";
		$ket = "Hari ini";
	}

	$setting = mysql_fetch_assoc(mysql_query("SELECT * FROM setting"));
	?>

	<h3 align="center" style="margin:0px"><?= $setting['nama_toko'] ?></h3>
	<h5 align='center' style="margin:0px"><?= $setting['alamat'] ?></h5>
	<h4 align="center" style="margin-top:0px">Laporan Penjualan Harian (<?php echo "$ket"; ?>) <?php echo "$produk"; ?></h4>


	<table id="example1" width="100%" cellspacing=0 border=1 align="center" class="table table-bordered table-striped">
		<thead>
			<tr>
				<th>No</th>
				<th>Tanggal</th>
				<th>Nota</th>
				<th>Kasir</th>
				<th>Modal</th>
				<th>Total Harga</th>
				<th>Pendapatan</th>
				<th>Metode Pembayaran</th>
			</tr>
		</thead>
		<tbody id="penjualan">
			<?php
			$sql = mysql_query("select *,date(tgl_jual)as tgl,sum(d.modal*d.jumlah_jual)as modal2 from tb_barang_terjual d,tb_penjualan p where p.no_nota=d.no_nota $where group by p.no_nota") or die(mysql_error());
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
						<td><?php echo $data['no_nota']; ?></td>
						<td><?php echo $data['kasir']; ?></td>
						<td align="right" style="border-left:0;"><?php echo number_format($data['modal2'], 0, ".", ","); ?></td>
						<td align="right" style="border-left:0;"><?php echo number_format($data['total_harga'], 0, ".", ","); ?></td>
						<td align="right" style="border-left:0;"><?php echo number_format($data['total_harga'] - $data['modal2'], 0); ?></td>
						<td><?= $data['metode_pembayaran'] ?></td>
					</tr><?php
								$tot1 = $tot1 + $data['modal2'];
								$tot2 = $tot2 + $data['total_harga'];
								$no++;
							}
							echo "
			<tr>
				<td colspan=4><b>TOTAL</b></td>
				<th align='right'>" . number_format($tot1, 0) . "</th>
				<th align='right'>" . number_format($tot2, 0) . "</th>
				<th align='right'>" . number_format(($tot2 - $tot1), 0) . "</th>
				<th></th>
			</tr>
			";
						} ?>
		</tbody>
	</table>
</body>