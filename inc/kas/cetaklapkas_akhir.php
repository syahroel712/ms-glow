<?php
include "../koneksi.php";
include "../../terbilang.php";
if ($_GET[tahun] != "") {
				if ($_GET[bln] != "") {
					$bln = "and month(tgl)=$_GET[bln]";
					if ($_GET[tgl] != "") {
						$tgl = "and day(tgl)=$_GET[tgl]";
					}
				}
				$qthn = "where year(tgl)='$_GET[tahun]' $bln $tgl";
			}
$setting = mysql_fetch_assoc(mysql_query("SELECT * FROM setting"));
?>

<body onload="print()">
	<h2 align="center">Laporan Pengeluaran Kas Kasir</h2>
	<h3 align="center" style="margin:0px"><?= $setting['nama_toko'] ?></h3>
	<h5 align='center' style="margin:0px"><?= $setting['alamat'] ?></h5>
	<h4 align="center" style="margin-top:0px">Tanggal (<?php echo "$_GET[tgl]"; ?>-<?php echo "$_GET[bln]"; ?>-<?php echo "$_GET[tahun]"; ?>)</h4>

	<table align="center" width="100%" border="1" cellspacing=0 class="data" style="margin-top:10px;">
		<thead>
			<tr>
				<th>No</th>
				<th>Pengeluaran</th>
				<th colspan="2">Biaya</th>
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
					
					if ($data[jenis] == "Pengeluaran")
					{
				?>
					<tr>
						<td><?php echo $no++; ?></td>
						<td><?php echo $data['ket']; ?></td>
						<td>
							<?php if ($data[kredit] != "" and $data[kredit] != 0) {
									echo "Rp.";
								} ?>
						</td>
						<td align="right" style="border-left:0;">
							<?php if ($data[kredit] != "" and $data[kredit] != 0) {
								echo number_format($data['kredit'], 2, ".", ",");
								}
							?>																		
						</td>
					</tr>
				<?php
				}
				}
				
				?>
				<tr>
					<td colspan="4">&nbsp;</td>
				</tr>

				<tr>
					<td colspan="2"><b>Total Pengeluaran</b></td>
					<td>Rp. </td>
					<td align="right" style="border-left:0;"><?php echo number_format($tkredit, 2, ".", ","); ?></td>
				</tr>
				<tr>
					<td colspan="2"><b>Total Pendapatan</b></td>
					<td>Rp. </td>
					<td align="right" style="border-left:0;"><?php echo number_format($tdebit, 2, ".", ","); ?></td>
				</tr>
				<tr>
					<td colspan="2"><b>Sisa Pendapatan</b></td>
					<td>Rp. </td>
					<td align="right" style="border-left:0;"><?php echo number_format($sub_tot1, 2, ".", ","); ?></td>
				</tr>
			<?php
			}
			?>
		</tbody>
	</table>
		Terbilang : <b> <?php echo terbilang($sub_tot1); ?> RUPIAH</b>
	<br>
	<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#FFFFFF">
		<tr>
			<td width="63%" bgcolor="#FFFFFF">

				<p align="center"><br />
			</td>
			<td width="37%" bgcolor="#FFFFFF">
				<div align="center"> <?php $tgl = date('d M Y');
															echo "Padang, $tgl"; ?><br />
					<br /><br />
					<br /><br />
					MM Wirda II<br />


				</div>
			</td>
		</tr>
	</table>

	<body>