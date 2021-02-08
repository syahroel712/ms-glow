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

	$tgl = date("Y-m-d");
	$thn = date('Y');

	if ($_GET['th'] != "") {
		$where = " year(tgl_beli) between '$_GET[th]' and '$_GET[th2]'";
		$ket = "$_GET[th] s/d $_GET[th2]";
	} else {
		$where = " year(tgl_beli)='$thn'";
		$ket = "Tahun ini";
	}

	$setting = mysql_fetch_assoc(mysql_query("SELECT * FROM setting"));
	?>

	<h3 align="center" style="margin:0px"><?= $setting['nama_toko'] ?></h3>
	<h5 align='center' style="margin:0px"><?= $setting['alamat'] ?></h5>
	<h4 align="center" style="margin-top:0px">Laporan Pembelian Tahunan (<?php echo "$ket"; ?>)</h4>


	<table id="example1" width="100%" cellspacing=0 border=1 align="center" class="table table-bordered table-striped">
		<thead>
			<tr>
				<th>No</th>
				<th>Tahun</th>
				<th>pembelian</th>

			</tr>
		</thead>
		<tbody id="pembelian">
			<?php
			$sql = mysql_query("select *,year(p.tgl_beli)as thn,sum(d.harga_satuan*d.jml)as tot from tb_pembelian p,tb_barang_terbeli d where $where and p.nota=d.nota group by year(p.tgl_beli) order by year(p.tgl_beli) asc") or die(mysql_error());
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
						<td><?php echo $data['thn']; ?></td>
						<?php
								$total3;
								$td = mysql_query("select *,year(p.tgl_beli)as thn,(sum(d.harga_satuan*d.jml)-(sum(d.harga_satuan*d.jml)*(p.diskon_persen/100)))as tot from tb_pembelian p,tb_barang_terbeli d where year(p.tgl_beli)='$data[thn]' and p.nota=d.nota group by d.nota order by year(p.tgl_beli) asc");
								while ($tot3 = mysql_fetch_array($td)) {
									$total3 = $total3 + $tot3[tot];
								}
						?>
						<td align="right" style="border-left:0;"><?php echo number_format($total3, 2, ".", ","); ?></td>
					</tr><?php
								$tot2 = $tot2 + $total3;
							}
							echo "
			<tr>
				<td colspan=2><b>TOTAL</b></td>
				<td align='right'><b>" . number_format($tot2, 2) . "</b></td>
			</tr>
			";
						} ?>
		</tbody>
	</table>
</body>