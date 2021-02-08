<?php
include "../koneksi.php";
$tgl = date('Y-m-d H:i:s');

$tgl = date("Y-m-d");

// if ($_GET['kode'] != "") {
// 	$kode = "and p.kasir='$_GET[kode]'";
// 	$produk = "- Kasir : $_GET[kode]";
// }



if ($_GET['dari'] != "" and $_GET['sampai'] != "") {
    if($_GET['dari'] === $_GET['sampai']){
    	$squ = "WHERE tb_penjualan.tgl_jual LIKE '$_GET[dari]%'";
	}else{
    	$squ = "WHERE tb_penjualan.tgl_jual BETWEEN '$_GET[dari]' AND '$_GET[sampai]'";	    
	}
	// $squ = "where date(tb_penjualan.tgl_jual) between '$_GET[dari]' and '$_GET[sampai]' $kode";
	$ket = "$_GET[dari] s/d $_GET[sampai]";
} else {
	$ket = "$tgl";
	$squ = "where tb_penjualan.tgl_jual = '$tgl'";
}

// Fungsi header dengan mengirimkan raw data excel
header("Content-type: application/vnd-ms-excel");
// Mendefinisikan nama file ekspor "hasil-export.xls"
header("Content-Disposition: attachment; filename=data_penjualan_$ket.xls");

// Tambahkan table
?>
<center>
	<h2><?= $ket ?></h2>
</center>
<table id="example1" class="table table-bordered" border="1" cellpadding="5">
	<thead>
		<tr>
			<th>No</th>
            <th>Nama Barang</th>
            <th>Jumlah Terjual</th>
            <th>Total</th>
		</tr>
	</thead>
	<tbody id="penjualan">
		<?php
		$sql = mysql_query("SELECT 
                                tb_barang.kode_barang,
                                tb_barang.nama_barang,
                                tb_barang.harga_jual,
                                SUM(tb_barang.harga_jual*tb_barang_terjual.jumlah_jual) AS total,
                                SUM(tb_barang_terjual.jumlah_jual) as jumlah_beli 
                                FROM tb_barang 
                                JOIN tb_barang_terjual ON tb_barang.kode_barang=tb_barang_terjual.kode_barang JOIN tb_penjualan ON tb_penjualan.no_nota=tb_barang_terjual.no_nota 
                                $squ 
                                GROUP BY tb_barang.nama_barang 
                                ORDER BY jumlah_beli DESC
                            ");

		$cek = mysql_num_rows($sql);
		if ($cek < 1) {
		?>

			<tr>
				<td colspan="4" class="p-3">Data tidak ditemukan</td>
			</tr>

			<?php
		} else {
			$no = 1;
            $totseluruh = 0;
			while ($pecah = mysql_fetch_array($sql)) {
                $totseluruh += $pecah['total'];
			?>
				<tr>
                    <td><?= $no++; ?></td>
                    <td><?= $pecah['nama_barang']; ?></td>
                    <td><?= $pecah['jumlah_beli']; ?></td>
                    <td>Rp. <?= number_format($pecah['total']); ?></td>
                </tr>
		<?php
			}
		}
		?>
	</tbody>

	<tr>
		<td colspan="3"><b>TOTAL</b></td>
		<td align='right'><b><?= number_format($totseluruh, 0) ?></b></td>
	</tr>

</table>