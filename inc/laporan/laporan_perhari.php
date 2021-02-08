<?php
$tgl = date("Y-m-d");
if ($_POST['kode'] != "") {
	$kode = "and p.kasir='$_POST[kode]'";
}
if ($_POST['dari'] != "" and $_POST['sampai'] != "") {
	$where = "and date(tgl_jual) between '$_POST[dari]' and '$_POST[sampai]' $kode";
	$ket = "$_POST[dari] s/d $_POST[sampai]";
} else {
	$where = "and date(tgl_jual)='$tgl' $kode";
	$ket = "Hari ini";
}
?>

<!-- Content Header (Page header) -->
<div class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1 class="m-0 text-dark">Laporan Penjualan</h1>
			</div><!-- /.col -->
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="#">Home</a></li>
					<li class="breadcrumb-item active">Laporan Penjualan</li>
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
						<h3 class="card-title">Laporan Perhari ( <b><?php echo "$ket"; ?></b> )</h3>
					</div>
					<div class="card-body">
						<div class="row">
							<form action="" method="post" class="form-inline">
								<div class="form-group mx-sm-3 mb-2">
									<label>Kasir</label>
									<div class="input-group ml-3">
										<select class="form-control" name="kode">
											<option value="">Semua Kasir</option>
											<?php
											$k = mysql_query("SELECT * from tb_user where level='kasir' order by nama_lengkap");
											while ($rk = mysql_fetch_array($k)) {
												if ($rk['nama_lengkap'] == $_POST['kode']) {
													$selected = "selected";
												} else {
													$selected = "";
												}
											?>
												<option value='<?= "$rk[nama_lengkap]"; ?>' <?= $selected ?>><?php echo "$rk[nama_lengkap]"; ?></option>
											<?php
											}
											?>
										</select>
									</div>
								</div>
								<div class="form-group mx-sm-3 mb-2">
									<label>Dari</label>
									<div class="input-group ml-3">
										<div class="input-group-prepend">
											<span class="input-group-text">
												<i class="far fa-calendar-alt"></i>
											</span>
										</div>
										<input type="date" class="form-control" value="<?php echo "$_POST[dari]"; ?>" id="dari" name="dari" placeholder="yyyy-mm-dd" />
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
										<input type="date" class="form-control" value="<?php echo "$_POST[sampai]"; ?>" id="sampai" name="sampai" placeholder="yyyy-mm-dd" />
									</div>
								</div>

								<div class="form-group mx-sm-3 mb-2 ml-3">
									<label>&nbsp;</label>
									<div class="input-group ml-3">
										<div class="input-group-prepend">
											<button type="submit" name="cari" class="btn btn-danger shadow mr-2"><i class="fa fa-search"></i> Cari</button>
											<a href="inc/laporan/cetakperhari.php?kode=<?php echo "$_POST[kode]"; ?>&dari=<?php echo "$_POST[dari]"; ?>&sampai=<?php echo "$_POST[sampai]"; ?>" target="_Blank" class="btn btn-success shadow"><i class="fa fa-print"></i> Cetak Keseluruhan</a> &nbsp; &nbsp;
											<a href="inc/laporan/cetakperhari_akhir.php?kode=<?php echo "$_POST[kode]"; ?>&dari=<?php echo "$_POST[dari]"; ?>&sampai=<?php echo "$_POST[sampai]"; ?>" target="_Blank" class="btn btn-warning shadow"><i class="fa fa-print"></i> Cetak Akhir</a> &nbsp; &nbsp;
										</div>
									</div>
								</div>
							</form>
							<!-- <div class="form-group mx-sm-3 mb-2 ml-3">
								<a href="inc/export_penjualan.php?kode=<?php echo "$_POST[kode]"; ?>&dari=<?php echo "$_POST[dari]"; ?>&sampai=<?php echo "$_POST[sampai]"; ?>"><button class="btn btn-primary shadow"><i class="fa fa-file-excel"></i> Export Penjualan</button></a>
							</div> -->
						</div>

						<div class="container mt-4">
							<div class="table-responsive-sm">
								<table id="example1" class="table table-bordered">
									<thead>
										<tr>
											<th>No</th>
											<th>Tanggal</th>
											<th>Nota</th>
											<th>Kasir</th>
											<th>Modal</th>
											<th>Total Harga</th>
											<th>Pendapatan</th>
											<th>Metode Pembayaran</th>
										</tr>
									</thead>
									<!--SELECT *,date(tgl_jual)as tgl,sum(d.modal*d.jumlah_jual)as modal2,sum(d.harga_satuan*d.jumlah_jual)as pend from tb_barang_terjual d,tb_penjualan p where p.no_nota=d.no_nota $where group by p.no_nota-->
									<tbody id="penjualan">
										<?php
										//$sql = mysql_query("SELECT *,date(tgl_jual)as tgl,sum(d.modal*d.jumlah_jual)as modal2,sum(d.harga_akhir)as pend from tb_barang_terjual d,tb_penjualan p where p.no_nota=d.no_nota $where group by p.no_nota") or die(mysql_error());
										$sql = mysql_query("SELECT *,date(tgl_jual)as tgl,sum(d.modal*d.jumlah_jual)as modal2,sum(d.harga_akhir)as pend from tb_barang_terjual d,tb_penjualan p where p.no_nota=d.no_nota $where group by p.no_nota") or die(mysql_error());
										$cek = mysql_num_rows($sql);
										if ($cek < 1) {
										?><tr>
												<td colspan="11">Data tidak ditemukan</td>
											</tr>
											<?php
										} else {
											$no = 1;
											while ($data = mysql_fetch_array($sql)) {
											?>
												<tr>
													<td><?php echo "$no"; ?></td>
													<td><?php echo $data['tgl']; ?></td>
													<td><?php echo $data['no_nota']; ?></td>
													<td><?php echo $data['kasir']; ?></td>
													<td align="right" style="border-left:0;"><?php echo number_format($data['modal2'], 0, ".", ","); ?></td>
													<td align="right" style="border-left:0;"><?php echo number_format($data['total_harga'], 0, ".", ","); ?></td>
													<td align="right" style="border-left:0;"><?php echo number_format($data['pend'] - $data['modal2'], 0); ?></td>
													<td><?= $data['metode_pembayaran'] ?></td>
												</tr>
										<?php
												$tot1 = $tot1 + $data['modal2'];
												$tot2 += $data['total_harga'];
												$no++;
											}
										}
										?>
									</tbody>
									<tr>
										<td colspan=4><b>TOTAL</b></td>
										<td align='right'><b><?= number_format($tot1, 0) ?></b></td>
										<td align='right'><b><?= number_format($tot2, 0) ?></b></td>
										<td align='right'><b><?= number_format($tot2 - $tot1, 0) ?></b></td>
										<td></td>
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