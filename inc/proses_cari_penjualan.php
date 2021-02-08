<?php
include "koneksi.php";
$tgl = @mysql_real_escape_string($_POST['tgl']);

if($tgl != "") {
	$sql = mysql_query("select * from tb_penjualan where tgl_jual = '$tgl'") or die (mysql_error());
} else {
	$sql = mysql_query("select * from tb_penjualan") or die (mysql_error());
}
$cek = mysql_num_rows($sql);
if($cek < 1) {
	?><tr>
		<td colspan="13" style="padding:10px;">Data tidak ditemukan</td>
	</tr><?php
} else {
	while($data = mysql_fetch_array($sql)) {
		?><tr>
			<td><?php echo $data['no_nota']; ?></td>
			<td><?php echo $data['tgl_jual']; ?></td>
			<td><?php echo $data['pelanggan']; ?></td>
			<td><?php echo $data['kasir']; ?></td>
			<td style="width:60px; text-align:center;"><button id="lihatbarang" no="<?php echo $data['no_nota']; ?>">Lihat</button></td>
			<td>Rp.</td><td align="right" style="border-left:0;"><?php echo number_format($data['sub_total'], 2, ".", ","); ?></td>
			<td><?php echo $data['diskon_persen']; ?></td>
			<td>Rp.</td><td align="right" style="border-left:0;"><?php echo number_format($data['diskon_total'], 2, ".", ","); ?></td>
			<td>Rp.</td><td align="right" style="border-left:0;"><?php echo number_format($data['total_harga'], 2, ".", ","); ?></td>
			<td><button>Hapus</button></td>
		</tr><?php
	}
}
?>