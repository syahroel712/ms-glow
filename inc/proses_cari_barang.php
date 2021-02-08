<?php
include "koneksi.php";
$masukan = @mysql_real_escape_string($_POST['masukanpencarian']);
$tgl = @mysql_real_escape_string($_POST['tglpencarian']);

if($tgl != "") {
	if($masukan != "") {
		$sql = mysql_query("select * from tb_barang where tanggal = '$tgl' and nama_barang like '%$masukan%'") or die (mysql_error());
	} else if($masukan == "") {
		$sql = mysql_query("select * from tb_barang where tanggal = '$tgl'") or die (mysql_error());
	}
} else if($masukan != "") {
	if($tgl != "") {
		$sql = mysql_query("select * from tb_barang where nama_barang like '%$masukan%' and tanggal = '$tgl'") or die (mysql_error());
	} else if($tgl == "") {
		$sql = mysql_query("select * from tb_barang where nama_barang like '%$masukan%'") or die (mysql_error());
	}
} else {
	$sql = mysql_query("select * from tb_barang order by tanggal asc") or die (mysql_error());
}

$cek = mysql_num_rows($sql);
if($cek < 1) { ?>
	<tr>
    	<td colspan="12" style="padding:10px;">Data tidak ditemukan</td>
    </tr>
<?php } else {
	while($data = mysql_fetch_array($sql)) { ?>
		<tr>
			<td><?php echo $data['kode_barang']; ?></td>
			<td><?php echo $data['nama_barang']; ?></td>
			<td><?php echo $data['satuan']; ?></td>
			
			<td>Rp. </td><td align="right" style="border-left:0;"><?php echo number_format($data['harga_beli'], 2, ".", ","); ?></td>
			<td>Rp. </td><td align="right" style="border-left:0;"><?php echo number_format($data['harga_jual'], 2, ".", ","); ?></td>
			<td align="right"><?php echo $data['stok_awal']; ?></td>
			<td align="right"><?php echo $data['stok_terjual']; ?></td>
			<td align="right"><?php echo $data['stok_sisa']; ?></td>
			<td align="center"><?php echo $data['tanggal']; ?></td>
			<td>
			<a href="?page=barang&action=edit&id=<?php echo $data['kode_barang']; ?>">
				<button class="btn btn-success btn-xs" title="Edit Data"><span class='glyphicon glyphicon-edit'></span></button></a>
			<a onclick="return confirm('Yakin ingin menghapus data ?');" href="?page=barang&action=hapus&id=<?php echo $data['kode_barang']; ?>">
			<button class='btn btn-danger btn-xs' title='Delete Data' ><span class='glyphicon glyphicon-remove'></span></button></a></td>
				
		</tr>
<?php	}
} ?>