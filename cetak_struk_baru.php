<font face="arial">

	<?php

	session_start();

	$tgl = date("d-m-Y");

	include "inc/koneksi.php";

	$tot = 0;

	$id_brg = @$_GET['id'];

	$sql2 = mysql_query("select * from tb_penjualan where no_nota = '$id_brg'") or die(mysql_error());

	$data2 = mysql_fetch_array($sql2);
	$no = 1;


	$k = mysql_fetch_array(mysql_query("select * from tb_user where nama_lengkap='$data2[kasir]'"));

	$setting = mysql_fetch_assoc(mysql_query("SELECT * FROM setting"));

	?>

	<head>

		<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">

	</head>

	<body onLoad="javascript:print()">

		<div align="center">
			<font size=2><b>FAKTUR PENJUALAN</b></font>
		</div>

		<br>

		<table width="100%">

			<tr>

				<td>
					<font size=2><i><?= $setting['nama_toko'] ?></i></font>
				</td>

				<td>
					<font size=2><i>Tanggal</i></font>
				</td>
				<td>
					<font size=2>:</font>
				</td>
				<td>
					<font size=2><?php echo $tgl ?></font>
				</td>

			</tr>

			<tr>

				<td>
					<font size=2><i><?= $setting['alamat'] ?></i></font>
				</td>

				<td>
					<font size=2><i>Faktur</i></font>
				</td>
				<td>
					<font size=2>:</font>
				</td>
				<td>
					<font size=2><?php echo $data2["no_nota"] ?></font>
				</td>

			</tr>

			<tr>

				<td>
					<font size=2><i>Kota Padang, Sumatera Barat</i></font>
				</td>

				<td>
					<font size=2><i>Nama Kasir</i></font>
				</td>
				<td>
					<font size=2>:</font>
				</td>
				<td>
					<font size=2><?php echo $data2["kasir"] ?></font>
				</td>

			</tr>

		</table>

		<table width="100%" border="1" align="center">

			<tr>

				<th>No.</th>

				<th>Nama Barang </th>

				<th>Qty</th>

				<th>Jenis</th>

				<th>Harga Satuan</th>

				<th>Total Harga</th>

				<?php
				$b = mysql_query("select *,sum(jumlah_jual)as tot from tb_barang_terjual where no_nota='$_GET[id]' group by kode_barang");
				while ($r = mysql_fetch_array($b)) {

					$tot = $tot + ($r['harga_satuan'] * $r['tot']);

				?>


					</td>
			</tr>

			<tr>

				<td><?php echo $no++ ?></td>

				<td><?php echo $r["nama_barang"] ?></td>

				<td><?php echo $r["tot"] ?></td>

				<td><?php echo $r["jns"] ?></td>

				<td><?php echo $r["harga_satuan"] ?></td>

				<td>Rp.<?php echo number_format($tot, 0); ?></td>

			</tr> <?php } ?>

		<tr style="height:100px;">

			<td colspan="5">&nbsp;</td>

			<td>&nbsp;</td>

		</tr>

		<tr>

			<td colspan="5" align="right">Jumlah&nbsp;&nbsp;</td>

			<td>Rp.<?php echo number_format($tot, 0); ?></td>

		</tr>
		<tr>

			<td colspan="5" align="right">Bayar&nbsp;&nbsp;</td>

			<td>Rp.<?php echo number_format($data2['bayar'], 0); ?></td>

		</tr>
		<tr>

			<td colspan="5" align="right">Kembalian&nbsp;&nbsp;</td>

			<td>Rp.<?php echo number_format($data2['bayar'] - $tot, 0); ?></td>

		</tr>

		</table>

		<br><br>

		<table width="100%">

			<tr>

				<td>PENJUAL</td>

				<td align="center">MENYETUJUI</td>

			</tr>

			<tr>

			</tr>

			<tr>

				<td>_ _ _ _ _ _ _ _ _ _ _</td>

				<td align="center">_ _ _ _ _ _ _ _ _ _ _</td>

				<td>&nbsp;</td>

				<td>&nbsp;</td>

			</tr>

		</table>



		<br><br>

		<font><b>** &nbsp;*</b></font>GARANSI HP 1 TAHUN * GARANSI MESIN HP SECOND 5 BULAN, GARANSI FUNGSI 1 MINGGU(SBK Berlaku)<font><b>**</b></font><br>

		<font><b>** &nbsp;*</b></font>Barang Yang Sudah Di beli, Tidak Bisa <b>DIKEMBALIKAN</b>, atau <b>DIJUAL KEMBALI</b>
		<font><b>* **</b></font><br>

		<font><b>** &nbsp;*</b></font>Update Stok Terbaru Check Instagram @sumbarsmartphone * SUMBAR SMARTPHONE(Good Quality We Played) <font><b>**</b></font>