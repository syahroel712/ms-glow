<?php
include "koneksi.php";
$no = @$_POST['no'];
$sql_terjual = mysql_query("select * from tb_barang_pengembalian where no_nota = '$no'") or die (mysql_error());
$cek_terjual = mysql_num_rows($sql_terjual);
if($cek_terjual < 1) { ?>
    <tr>
    	<td colspan="8" style="padding:10px;">Data tidak ditemukan</td>
    </tr><?php
} else {
	while($data_terjual = mysql_fetch_array($sql_terjual)) { ?>
	<tr>
		<td><?php echo $data_terjual['kode_barang']; ?></td>
		<td><?php echo $data_terjual['nama_barang']; ?></td>
		<td>Rp. </td><td align="right" style="border-left:0;"><?php echo number_format($data_terjual['harga_satuan'], 2, ".", ","); ?></td>
		<td><?php echo $data_terjual['jumlah_jual']; ?></td>
		<td>Rp. </td><td align="right" style="border-left:0;"><?php echo number_format($data_terjual['harga_akhir'], 2, ".", ","); ?></td>
		<td><?php echo $data_terjual['no_nota']; ?></td>
	</tr> <?php
	}
}
?>