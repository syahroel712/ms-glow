<?php
error_reporting(0);
include "../koneksi.php";

$tgl = date('d M Y');

?>

<body onLoad="javascript:print()">
	<?php
	$BulanIndo = array("", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");

	$tgl = date("Y-m-d");
	$bln = date('m');
	$thn = date('Y');

	if ($_GET['th'] != "") {
		$where = "and (month(p.tgl_jual)>='$_GET[dari]' and month(p.tgl_jual)<='$_GET[sampai]') and year(tgl_jual)='$_GET[th]'";
		$ket = "Dari bulan : " . $BulanIndo[$_GET['dari']] . " s/d " . $BulanIndo[$_GET['sampai']] . " - $_GET[th]";
	} else {
		$where = "and month(p.tgl_jual)='$bln' and year(p.tgl_jual)='$thn'";
		$ket = "Bulan ini";
	}
	$setting = mysql_fetch_assoc(mysql_query("SELECT * FROM setting"));
	?>
	<h3 align="center" style="margin:0px"><?= $setting['nama_toko'] ?></h3>
	<h5 align='center' style="margin:0px"><?= $setting['alamat'] ?></h5>
	<h4 align="center" style="margin-top:0px">Laporan Penjualan Bulanan (<?php echo "$ket"; ?>)</h4>


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

			</tr>
		</thead>
		<tbody id="penjualan">
			<?php
			$sql = mysql_query("select *,date(p.tgl_jual)as tgl,month(p.tgl_jual)as bln,year(p.tgl_jual)as thn,sum(d.modal*d.jumlah_jual)as modal2,sum(d.harga_satuan*d.jumlah_jual)as pend from tb_penjualan p,tb_barang_terjual d where p.no_nota=d.no_nota $where group by p.no_nota") or die(mysql_error());
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
						<td align="right" style="border-left:0;"><?php echo number_format($data['pend'], 0, ".", ","); ?></td>
						<td align="right" style="border-left:0;"><?php echo number_format($data['pend'] - $data['modal2'], 0); ?></td>
					</tr><?php
								$tot1 = $tot1 + $data['modal2'];
								$tot2 = $tot2 + $data['pend'];
								$no++;
							}
							echo "
			<tr>
				<td colspan=4><b>TOTAL</b></td>
				<th align='right'>" . number_format($tot1, 0) . "</th>
				<th align='right'>" . number_format($tot2, 0) . "</th>
				<th align='right'>" . number_format($tot2 - $tot1, 0) . "</th>
			</tr>
			";
						} ?>
		</tbody>
	</table>
</body>