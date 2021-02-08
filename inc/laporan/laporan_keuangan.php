<?php
//include "../fungsi_indotgl.php" ;
$BulanIndo = array("", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");

$tgl = date("Y-m-d");
$thn = date('Y');

if ($_POST['th'] != "") {
	$where = " year(tgl_jual)='$_POST[th]'";
	$ket = "$_POST[th]";
} else {
	$where = " year(tgl_jual)='$thn'";
	$ket = "$thn";
}
?>

<!-- Content Header (Page header) -->
<div class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1 class="m-0 text-dark">Laporan Keuangan</h1>
			</div><!-- /.col -->
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="#">Home</a></li>
					<li class="breadcrumb-item active">Laporan Keuangan</li>
				</ol>
			</div><!-- /.col -->
		</div><!-- /.row -->
	</div><!-- /.container-fluid -->
</div>

<section class="content">
	<div class="container-fluid">
		<!-- Small boxes (Stat box) -->
		<div class="row">
			<div class="col-lg-12">
				<div class="card">
					<div class="card-header">
						<h3 class="card-title">Laporan Keuangan ( <b><?php echo "$ket"; ?></b> )</h3>
					</div>
					<div class="card-body">
						<div class="row">
							<form action="" method="post" class="form-inline">
								<div class="form-group mx-sm-3 mb-2">
									<label>Tahun</label>
									<div class="input-group ml-3">
										<div class="input-group-prepend">
											<span class="input-group-text">
												<i class="far fa-calendar-alt"></i>
											</span>
										</div>
										<select name='th' class="form-control">
											<option value="">- Pilih Tahun -</option>
											<?php
											for ($t = 2017; $t <= $thn; $t++) {
												echo "<option value='$t'>$t</option>";
											}
											?>
										</select>
									</div>
								</div>
								<div class="form-group mx-sm-3 mb-2 ml-3">
									<label>&nbsp;</label>
									<div class="input-group ml-3">
										<div class="input-group-prepend">
											<button type="submit" name="cari" class="btn btn-danger shadow mr-2"><i class="fa fa-search"></i> Cari</button>
											<a href="inc/laporan/cetakkeuangan.php?th=<?php echo "$_POST[th]"; ?>" target="_Blank" class="btn btn-success"><i class="fa fa-print"></i> Cetak</a>
										</div>
									</div>
								</div>
							</form>
						</div>

						<div class="row mt-4">
							<div class="col-md-12">
								<div class="box-body">
									<canvas id="myBarChart6" height="40"></canvas>
								</div>
							</div>
						</div>

						<div class="table-responsive-sm">
							<table id="example2" class="table table-bordered">
								<thead>
									<tr>
										<th>No</th>
										<th>Bulan</th>
										<th>Penjualan</th>
										<th>Pengeluaran</th>
										<th>Kas</th>
									</tr>
								</thead>
								<tbody id="penjualan">
									<?php
									$sql = mysql_query("SELECT *,month(p.tgl_jual)as bln,sum(d.modal*d.jumlah_jual)as modal2,sum(d.harga_satuan*d.jumlah_jual)as tot from tb_penjualan p,tb_barang_terjual d where $where and p.no_nota=d.no_nota group by month(p.tgl_jual) order by month(p.tgl_jual) asc") or die(mysql_error());
									$cek = mysql_num_rows($sql);
									if ($cek < 1) {
									?>
										<tr>
											<td colspan="13" style="padding:10px;">Data tidak ditemukan</td>
										</tr>
										<?php
									} else {
										$no = 1;
										while ($data = mysql_fetch_array($sql)) {
											$pengeluaran = mysql_fetch_array(mysql_query("SELECT *,sum(total)as tot from tb_pembelian where month(tgl_beli)='$data[bln]' and year(tgl_beli)='$ket' group by month(tgl_beli)"));
										?><tr>
												<td><?php echo $no++; ?></td>
												<td><?php echo $BulanIndo[$data['bln']]; ?></td>
												<td align="right" style="border-left:0;"><?php echo number_format($data['tot'], 2, ".", ","); ?></td>
												<td align="right" style="border-left:0;"><?php echo number_format($pengeluaran['tot'], 2, ".", ","); ?></td>
												<td align="right" style="border-left:0;"><?php echo number_format(($data['tot'] - $pengeluaran['tot']), 2, ".", ","); ?></td>
											</tr><?php
														$tot1 = $tot1 + $pengeluaran['tot'];
														$tot2 = $tot2 + $data['tot'];
													}
														?>
								</tbody>
								<tr>
									<td colspan=2><b>TOTAL</b></td>
									<td align='right'><b><?= number_format($tot2, 2) ?></b></td>
									<td align='right'><b><?= number_format($tot1, 2) ?></b></td>
									<td align='right'><b><?= number_format($tot2 - $tot1, 2) ?></b></td>
								</tr>
							<?php
									}
							?>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>