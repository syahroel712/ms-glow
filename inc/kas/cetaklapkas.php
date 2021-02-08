<?php
include "../koneksi.php";
?>

<body onload="print()">
	<h2 align="center">Laporan Keuangan</h2>

	<table align="center" border="1" cellspacing=0 class="data" style="margin-top:10px;">
		<thead>
			<tr>
				<th>No</th>
				<th>Tanggal</th>
				<th>Keterangan</th>
				<th colspan=2>Debit </th>
				<th colspan=2>Kredit </th>
				<th colspan=2>Saldo </th>

			</tr>
		</thead>
		<tbody id="barang">
			<?php
			if ($_GET[tahun] != "") {
				if ($_GET[bln] != "") {
					$bln = "and month(tgl)=$_GET[bln]";
					if ($_GET[tgl] != "") {
						$tgl = "and day(tgl)=$_GET[tgl]";
					}
				}
				$qthn = "where year(tgl)='$_GET[tahun]' $bln $tgl";
			}

			$sql = mysql_query("select * from tb_kas $qthn order by tgl desc") or die(mysql_error());
			$cek = mysql_num_rows($sql);
			if ($cek < 1) {
			?>
				<tr>
					<td colspan="8" style="padding:10px;">Kas tidak ditemukan</td>
				</tr>
				<?php
			} else {
				$no = 1;
				while ($data = mysql_fetch_array($sql)) {
					if ($data[jenis] == "Pengeluaran") {
						$sub_tot1 = $sub_tot1 - $data[kredit];
					} else {
						$sub_tot1 = $sub_tot1 + $data[debit];
					}
					$tdebit = $tdebit + $data[debit];
					$tkredit = $tkredit + $data[kredit];
				?>
					<tr>
						<td><?php echo $no; ?></td>
						<td><?php echo $data['tgl']; ?></td>
						<td><?php echo $data['ket']; ?></td>

						<td><?php if ($data[debit] != "" and $data[debit] != 0) {
									echo "Rp.";
								} ?></td>
						<td align="right" style="border-left:0;"><?php if ($data[debit] != "" and $data[debit] != 0) {
																												echo number_format($data['debit'], 2, ".", ",");
																											} ?></td>
						<td><?php if ($data[kredit] != "" and $data[kredit] != 0) {
									echo "Rp.";
								} ?></td>
						<td align="right" style="border-left:0;"><?php if ($data[kredit] != "" and $data[kredit] != 0) {
																												echo number_format($data['kredit'], 2, ".", ",");
																											} ?></td>

						<td>Rp. </td>
						<td align="right" style="border-left:0;"><?php echo number_format($sub_tot1, 2, ".", ","); ?></td>


					</tr>
				<?php
					$no++;
				}
				?>
				<tr>
					<td colspan=3><b>TOTAL</b></td>
					<td>Rp. </td>
					<td align="right" style="border-left:0;"><?php echo number_format($tdebit, 2, ".", ","); ?></td>
					<td>Rp. </td>
					<td align="right" style="border-left:0;"><?php echo number_format($tkredit, 2, ".", ","); ?></td>
					<td>Rp. </td>
					<td align="right" style="border-left:0;"><?php echo number_format($sub_tot1, 2, ".", ","); ?></td>
				</tr>
			<?php
			}
			?>
		</tbody>
	</table>
	<br>
	<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#FFFFFF">
		<tr>
			<td width="63%" bgcolor="#FFFFFF">

				<p align="center"><br />
			</td>
			<td width="37%" bgcolor="#FFFFFF">
				<div align="center"> <?php $tgl = date('d M Y');
															echo "Solok, $tgl"; ?><br />
					<br /><br />
					<br /><br />
					Pimpinan<br />


				</div>
			</td>
		</tr>
	</table>

	<body>