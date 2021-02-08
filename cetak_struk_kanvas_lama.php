<font face="arial">

	<?php

	session_start();
	
	include "terbilang.php";
	
	$tgl = date("d-m-Y");

	include "inc/koneksi.php";

	$tot = 0;

	$id_brg = @$_GET['id'];

	$sql2 = mysql_query("select * from tb_kanvas a left join tb_member b on a.id_member=b.id_member where a.nota = '$id_brg'") or die(mysql_error());

	$data2 = mysql_fetch_array($sql2);
	$no = 1;


	$k = mysql_fetch_array(mysql_query("select * from tb_user where nama_lengkap='$data2[kasir]'"));

	$setting = mysql_fetch_assoc(mysql_query("SELECT * FROM setting"));

	?>

	<head>

		<!-- <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css"> -->

	</head>

	<body onLoad="javascript:print()">

		<div align="center">
			<font size=2><b>FAKTUR PENJUALAN</b></font>
		</div>

		<br>

		<table width="100%" style="font-size:10px">

			<tr>

				<td>
					<font><b><?= $setting['nama_toko'] ?></b></font>
				</td>

				<td>
					<font><b>Tanggal</b></font>
				</td>
				<td>
					<font>:</font>
				</td>
				<td>
					<font><?php echo $tgl ?></font>
				</td>

			</tr>

			<tr>

				<td>
					<font><b><?= $setting['alamat'] ?></b></font>
				</td>

				<td>
					<font><b>Faktur</b></font>
				</td>
				<td>
					<font>:</font>
				</td>
				<td>
					<font><?php echo $data2["nota"] ?> - <?php echo $data2["nm"] ?></font>
				</td>

			</tr>

			<tr>

				<td>
					<font><b>Kota Padang, Sumatera Barat</b></font>
				</td>

				<td>
					<font><b>Nama Kasir</b></font>
				</td>
				<td>
					<font>:</font>
				</td>
				<td>
					<font><?php echo $data2["kasir"] ?></font>
				</td>

			</tr>

		</table>

		<table width="100%" border="2px" align="center" style="font-size:10px; border:none">

			<tr>

				<th>No.</th>

				<th>Kode Barang </th>
				
				<th>Nama Barang </th>

				<th>Qty</th>

				<th>Harga Satuan</th>

				
				
				<th>Diskon</th>

				<th>Total Harga</th>

				<?php
				$diskon=0;
				$totdiskon=0;
				$tot=0;
				$totharga =0;
				$b = mysql_query("select *,sum(jml)as tot from tb_barang_kanvas where nota='$_GET[id]' group by kode_barang");
				while ($r = mysql_fetch_array($b)) {

					$totH = ($r['harga_satuan'] * $r['tot']);
					
					$diskon= $r['diskon'];
					$diskonH = $r['diskon'] * $r['tot'];
					$tot = $totH - $diskonH;
					$totdiskon+=$diskonH;
					$totharga+=$tot;

				?>


			</tr>

			<tr style="font-size:9px" border="1">

				<td><?php echo $no++ ?></td>

				<td><?php echo $r["kode_barang"] ?></td>
				
				<td><?php echo $r["nama_barang"] ?></td>

				<td><?php echo $r["tot"] ?></td>

				<td><?php echo number_format($r["harga_satuan"],0) ?></td>

				
				
				<td><?php echo $diskon; ?></td>

				<td align="right"> <?php echo number_format($tot, 0); ?></td>

			</tr> <?php } ?>

		<tr style="height:5px;">

			<td colspan="6">&nbsp;</td>

			<td colspan="1">&nbsp;</td>

		</tr>

		<tr border="1">

			<td colspan="5" align="right"><b>Total Diskon&nbsp;&nbsp;</b></td>

			<td colspan="2" align="right">Rp. <b><?php echo number_format($totdiskon, 0); ?> </b></td>
			

		</tr>
		
		<tr border="1">

			<td colspan="5" align="right"><b>Total Pembayaran&nbsp;&nbsp;</b></td>

			<td colspan="2" align="right">Rp. <b><?php echo number_format($totharga, 0); ?> </b></td>
			

		</tr>
		
		<tr border="1">

			<td align="left">Terbilang&nbsp;&nbsp;</td>

			<td colspan="6" align="left"><b> <?php echo terbilang($tot); ?> RUPIAH</b></td>

		</tr>
		</table>

		<br>

		<table width="100%" style="font-size:9px">

			<tr>

				<td>Tanda Terima</td>

				<td align="center">Hormat Kami,</td>

			</tr>

			<tr>
				<td>&nbsp;</td>
			</tr>
			
			

			<tr>

				<td>_ _ _ _ _ _ _ _ _ _ _</td>

				<td align="center">_ _ _ _ _ _ _ _ _ _ _</td>

				<td>&nbsp;</td>

				<td>&nbsp;</td>

			</tr>

		</table>