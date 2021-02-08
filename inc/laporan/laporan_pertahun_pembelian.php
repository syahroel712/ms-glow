<?php
//include "../fungsi_indotgl.php" ;
$BulanIndo = array("", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");

$tgl = date("Y-m-d");
$thn = date('Y');

if ($_POST['th'] != "") {
	$where = " year(tgl_beli) between '$_POST[th]' and '$_POST[th2]'";
	$ket = "$_POST[th] s/d $_POST[th2]";
} else {
	$where = " year(tgl_beli)='$thn'";
	$ket = "Tahun ini";
}
?>

<!-- Content Header (Page header) -->
<div class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1 class="m-0 text-dark">Laporan Pembelian</h1>
			</div><!-- /.col -->
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="#">Home</a></li>
					<li class="breadcrumb-item active">Laporan Pembelian</li>
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
						<h3 class="card-title">Laporan Pertahun ( <b><?php echo "$ket"; ?></b> )</h3>
					</div>
					<div class="card-body">
						<div class="row">
							<form action="" method="post" class="form-inline">
								<div class="form-group mx-sm-3 mb-2">
									<label>Dari</label>
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

								<div class="form-group mx-sm-3 mb-2">
									<label>Sampai</label>
									<div class="input-group ml-3">
										<div class="input-group-prepend">
											<span class="input-group-text">
												<i class="far fa-calendar-alt"></i>
											</span>
										</div>
										<select name='th2' class="form-control">
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
									<button type="submit" name="cari" class="btn btn-danger shadow mr-2"><i class="fa fa-search"></i> Cari</button>
									<a href="inc/laporan/cetakpertahunpembelian.php?th=<?php echo "$_POST[th]"; ?>&th2=<?php echo "$_POST[th2]"; ?>" target="_Blank" class="btn btn-success shadow"><i class="fa fa-print"></i> Cetak</a>
								</div>
							</form>
						</div>

						<div class="container mt-4">
							<div class="table-responsive-sm">
								<table id="example1" class="table table-bordered">
									<thead>
										<tr>
											<th>No</th>
											<th>Tahun</th>
											<th>pembelian</th>
										</tr>
									</thead>
									<tbody id="pembelian">
										<?php
										$sql = mysql_query("SELECT *,year(p.tgl_beli)as thn,sum(d.harga_satuan*d.jml)as tot from tb_pembelian p,tb_barang_terbeli d where $where and p.nota=d.nota group by year(p.tgl_beli) order by year(p.tgl_beli) asc") or die(mysql_error());
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
											?><tr>
													<td><?php echo "$no"; ?></td>
													<td><?php echo $data['thn']; ?></td>
													<?php
													$total3;
													$td = mysql_query("select *,year(p.tgl_beli)as thn,(sum(d.harga_satuan*d.jml)-(sum(d.harga_satuan*d.jml)*(p.diskon_persen/100)))as tot from tb_pembelian p,tb_barang_terbeli d where year(p.tgl_beli)='$data[thn]' and p.nota=d.nota group by d.nota order by year(p.tgl_beli) asc");
													while ($tot3 = mysql_fetch_array($td)) {
														$total3 = $total3 + $tot3[tot];
													}
													?>
													<td align="right" style="border-left:0;"><?php echo number_format($total3, 2, ".", ","); ?></td>
												</tr>
											<?php
												$tot2 = $tot2 + $total3;
											}
											?>
									</tbody>

									<tr>
										<td colspan=2><b>TOTAL</b></td>
										<td align='right'><b><?= number_format($tot2, 2) ?></b></td>
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