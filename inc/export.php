<?php
include "koneksi.php";

// Fungsi header dengan mengirimkan raw data excel
header("Content-type: application/vnd-ms-excel");
$tgl = date('Y-m-d H:i:s');
// Mendefinisikan nama file ekspor "hasil-export.xls"
header("Content-Disposition: attachment; filename=data_barang_$tgl.xls");
$sql = mysql_query("select * from tb_barang")

// Tambahkan table
?>
<table id="example" class="table table-bordered table-striped">
	<thead>
		<tr>
			<th>No</th>
			<th>Kode Barang</th>
			<th>Nama Barang</th>
			<th>Kategori</th>
			<th>Satuan</th>

			<th colspan="2">Harga Beli</th>
			<th colspan="2">Harga Jual</th>
			<th>Stok Awal</th>
			<th>Stok Terjual</th>
			<th>Stok Sisa</th>
			<th>Tgl Barang Masuk</th>

		</tr>
	</thead>
	<tbody id="barang">
		<?php
		//$sql = mysql_query("select * from tb_barang order by tanggal asc") or die (mysql_error());
		$cek = mysql_num_rows($sql);
		if ($cek < 1) {
		?>
			<tr>
				<td colspan="14" style="padding:10px;">Data tidak ditemukan</td>
			</tr>
			<?php
		} else {
			$no = 1;
			while ($data = mysql_fetch_array($sql)) {
				//$sup=mysql_fetch_array(mysql_query("select * from tb_supplier where idsup='$data[idsup]'"));
				$kat = mysql_fetch_array(mysql_query("select * from kategori where idkat='$data[idkat]'"));
				//$tanggal="$data[tanggal]";
				$tanggal = $data['tanggal'];

			?>
				<tr>
					<td><?php echo $no; ?></td>
					<td><?php echo $data['kode_barang']; ?></td>
					<td><?php echo $data['nama_barang']; ?></td>
					<td><?php echo "$kat[nmkat]"; ?></td>
					<td><?php echo $data['satuan']; ?></td>

					<td>Rp. </td>
					<td align="right" style="border-left:0;"><?php echo number_format($data['harga_beli'], 2, ".", ","); ?></td>
					<td>Rp. </td>
					<td align="right" style="border-left:0;"><?php echo number_format($data['harga_jual'], 2, ".", ","); ?></td>
					<td align="right"><?php echo $data['stok_awal']; ?></td>
					<td align="right"><?php echo $data['stok_terjual']; ?></td>
					<td align="right"><?php echo $data['stok_sisa']; ?></td>
					<td align="center"><?php echo $tanggal; ?></td>

				</tr>
		<?php
				$no++;
			}
		}
		?>
	</tbody>
</table>