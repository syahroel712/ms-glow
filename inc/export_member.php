<?php
include "koneksi.php";

// Fungsi header dengan mengirimkan raw data excel
header("Content-type: application/vnd-ms-excel");
$tgl = date('Y-m-d H:i:s');
// Mendefinisikan nama file ekspor "hasil-export.xls"
header("Content-Disposition: attachment; filename=data_member_$tgl.xls");
$sql = mysql_query("select * from tb_barang")

// Tambahkan table
?>
<table id="example" class="table table-bordered table-striped">
	<thead>
		<tr>
			<th>Kode member</th>

			<th>Nama Lengkap </th>

			<th>Jenis Kelamin</th>

			<th>No.Telp</th>

			<th>Email</th>

			<th>Tanggal Lahir</th>

			<th>Kota</th>

			<th>Tgl Daftar</th>
		</tr>
	</thead>
	<tbody id="member">
		<?php
		$sql = mysql_query("select * from tb_member") or die (mysql_error());
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
					<td><?php echo $data['id_member']; ?></td>
					<td><?php echo $data['nm']; ?></td>
					<td><?php echo $data['jk']; ?></td>
					<td><?php echo $data['notelp']; ?></td>
					<td><?php echo $data['email']; ?></td>
					<td><?php echo $data['tgl_lahir']; ?></td>
					<td><?php echo $data['kota']; ?></td>
					<td><?php echo $data['tgl_daftar']; ?></td>
				</tr>
		<?php
				$no++;
			}
		}
		?>
	</tbody>
</table>