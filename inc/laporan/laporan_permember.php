<?php
$tgl = date("Y-m-d");

if ($_POST['dari'] != "" and $_POST['sampai'] != "") {
    $where = "date(tgl_jual) between '$_POST[dari]' and '$_POST[sampai]'";
    
	$ket = "$_POST[dari] s/d $_POST[sampai] $sup[nmsup]";
} else {
	$where = "date(tgl_jual)='$tgl'";
	$ket = "Hari ini";
}
?>

<!-- Content Header (Page header) -->
<div class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1 class="m-0 text-dark">Laporan Member</h1>
			</div><!-- /.col -->
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="#">Home</a></li>
					<li class="breadcrumb-item active">Laporan Member</li>
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
						<h3 class="card-title">Laporan Member ( <b><?php echo "$ket"; ?></b> )</h3>
					</div>
					<div class="card-body">
						<div class="row">
							<form action="" method="post" class="form-inline">
								<div class="form-group mx-sm-2 mb-2">
									<label>Dari</label>
									<div class="input-group ml-2">
										<div class="input-group-prepend">
											<span class="input-group-text">
												<i class="far fa-calendar-alt"></i>
											</span>
										</div>
										<input type="date" class="form-control" value="<?php echo "$_POST[dari]"; ?>" id="dari" name="dari" placeholder="yyyy-mm-dd" required/>
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
										<input type="date" class="form-control" value="<?php echo "$_POST[sampai]"; ?>" id="sampai" name="sampai" placeholder="yyyy-mm-dd" required/>
									</div>
								</div>

								<div class="form-group mx-sm-2 mb-2 ml-3">
									<label>&nbsp;</label>
									<div class="input-group ml-2">
										<div class="input-group-prepend">
											<button type="submit" name="cari" class="btn btn-danger shadow mr-2"><i class="fa fa-search"></i> Cari</button>
											
											<a href="inc/laporan/cetakmember.php?dari=<?php echo "$_POST[dari]"; ?>&sampai=<?php echo "$_POST[sampai]"; ?>" target="_Blank" class="btn btn-success shadow"><i class="fa fa-print"></i> Cetak</a>
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
											<th>Nama Member</th>
											<th>Jumlah Transaksi</th>
											<th>Total Transaksi</th>
										</tr>
									</thead>
									<tbody id="penjualan">
										<?php
										$sql = mysql_query("SELECT *,COUNT(*) AS tottransaksi, SUM(total_harga) AS tothargatransaksi FROM tb_penjualan p, tb_member m WHERE p.pelanggan=m.id_member AND $where GROUP BY p.pelanggan") or die(mysql_error());
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
													<td><?= "$no"; ?></td>
													<td><?= $data['nm']; ?></td>
													<td><?= $data['tottransaksi']; ?></td>
													<td align="right" style="border-left:0;">
														<?= number_format($data['tothargatransaksi']); ?>
													</td>
												</tr>
										<?php
												$tot1 += $data['tothargatransaksi'];
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