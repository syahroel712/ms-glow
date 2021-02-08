<?php
$tgl = date("Y-m-d");

// if ($_POST['supplier'] != "") {
// 	$kode = "and p.kasir='$_POST[kode]'";
// }

if ($_POST['dari'] != "" and $_POST['sampai'] != "" and $_POST['supplier']) {
    $sup = mysql_fetch_assoc(mysql_query("SELECT nmsup FROM tb_supplier WHERE idsup='$_POST[supplier]'"));
    
	$ket = "$_POST[dari] s/d $_POST[sampai] $sup[nmsup]";
} else {
	$where = "and date(tgl_jual)='$tgl'";
	$ket = "Hari ini";
}
?>

<!-- Content Header (Page header) -->
<div class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1 class="m-0 text-dark">Laporan Persupplier</h1>
			</div><!-- /.col -->
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="#">Home</a></li>
					<li class="breadcrumb-item active">Laporan Persupplier</li>
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
						<h3 class="card-title">Laporan Persupplier ( <b><?php echo "$ket"; ?></b> )</h3>
					</div>
					<div class="card-body">
						<div class="row">
							<form action="" method="post" class="form-inline">
								<div class="form-group mx-sm-3 mb-2">
									<label>Supplier</label>
									<div class="input-group ml-3">
										<select class="form-control" name="supplier" required>
											<option value="">Pilih Supplier</option>
											<?php
											$k = mysql_query("SELECT * from tb_supplier order by nmsup ASC");
											while ($rk = mysql_fetch_array($k)) {
												if ($rk['idsup'] == $_POST['supplier']) {
													$selected = "selected";
												} else {
													$selected = "";
												}
											?>
												<option value='<?= "$rk[idsup]"; ?>' <?= $selected ?>><?php echo "$rk[nmsup]"; ?></option>
											<?php
											}
											?>
										</select>
									</div>
								</div>
								<div class="form-group mx-sm-2 mb-2">
									<label>Dari</label>
									<div class="input-group ml-2">
										<div class="input-group-prepend">
											<span class="input-group-text">
												<i class="far fa-calendar-alt"></i>
											</span>
										</div>
										<input type="date" class="form-control" value="<?php echo "$_POST[dari]"; ?>" id="dari" name="dari" placeholder="yyyy-mm-dd" />
									</div>
								</div>

								<div class="form-group mx-sm-2 mb-2">
									<label>Sampai</label>
									<div class="input-group ml-2">
										<div class="input-group-prepend">
											<span class="input-group-text">
												<i class="far fa-calendar-alt"></i>
											</span>
										</div>
										<input type="date" class="form-control" value="<?php echo "$_POST[sampai]"; ?>" id="sampai" name="sampai" placeholder="yyyy-mm-dd" />
									</div>
								</div>

								<div class="form-group mx-sm-2 mb-2 ml-3">
									<label>&nbsp;</label>
									<div class="input-group ml-2">
										<div class="input-group-prepend">
											<button type="submit" name="cari" class="btn btn-danger shadow mr-2"><i class="fa fa-search"></i> Cari</button>
											
											<a href="inc/laporan/cetaksupplier.php?dari=<?php echo "$_POST[dari]"; ?>&sampai=<?php echo "$_POST[sampai]"; ?>&supplier=<?php echo "$_POST[supplier]"; ?>" target="_Blank" class="btn btn-success shadow"><i class="fa fa-print"></i> Cetak</a>
										</div>
									</div>
								</div>
							</form>
						</div>

						<div class="container mt-4">
							<div class="table-responsive-sm">
								<table id="example1" class="table table-bordered ">
									<thead>
										<tr>
											<th>No</th>
											<th>Nama Barang</th>
											<th>Jumlah Jual</th>
											<th>Total Penjualan</th>
										</tr>
									</thead>
									<tbody id="penjualan">
										<?php
										$sql = mysql_query("SELECT *, SUM(jumlah_jual) AS jum, SUM(harga_akhir) AS tot FROM tb_penjualan p LEFT JOIN tb_barang_terjual j ON p.no_nota=j.no_nota LEFT JOIN tb_barang b ON j.kode_barang=b.kode_barang LEFT JOIN tb_supplier su ON b.idsup=su.idsup WHERE b.idsup='$_POST[supplier]' AND date(tgl_jual) between '$_POST[dari]' and '$_POST[sampai]' GROUP BY j.kode_barang") or die(mysql_error());
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
												$sup = mysql_fetch_array(mysql_query("SELECT * from tb_supplier where idsup='$data[idsup]'"));

											?><tr>
													<td><?= "$no"; ?></td>
													<td><?= $data['nama_barang']; ?></td>
													<td><?= $data['jum']; ?></td>
													<td align="right" style="border-left:0;">
														<?= number_format($data['tot']); ?>
													</td>
													
												</tr>
										<?php
												$tot1 += $data['tot'];
												$no++;
											}
										}
										?>
									</tbody>
									<tr>
										<td colspan=3><b>TOTAL</b></td>
										<td align='right'><b><?= number_format($tot1, 0) ?></b></td>
									</tr>
								</table>
							</div>
						</div>
						<script type="text/javascript">
							$(window).load(function() {
								$("#kode").focus();
							});
						</script>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>