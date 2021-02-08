<?php
// $tgl = date("Y-m-d");
// if ($_POST['dari'] != "" and $_POST['sampai'] != "") {
// 	$where = "and date(tgl_beli) between '$_POST[dari]' and '$_POST[sampai]' and p.idsup='$_POST[supplier]'";
// 	$ket = "$_POST[dari] s/d $_POST[sampai]";
// } else {
// 	$where = "and p.idsup=''";
// 	$ket = "";
// }
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
						<h3 class="card-title">Laporan Persupplier</h3>
					</div>
					<div class="card-body">

						<div class="container mt-4">
							<div class="table-responsive-sm">
								<table id="example1" class="table table-bordered">
									<thead>
										<tr>
											<th>No</th>
											<th>Nama Supplier</th>
											<th>Total Belanja</th>
										</tr>
									</thead>
									<tbody id="pembelian">
										<?php
										$sql = mysql_query("SELECT *, sum(p.total) as tot from tb_pembelian p, tb_supplier s where p.idsup=s.idsup group by p.idsup") or die(mysql_error());
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
													<td><a href="?page=detail_laporan_persupplier_pembelian&id=<?= $data['idsup'] ?>"><?= $data['nmsup']; ?></a></td>
													<td align="right"><?= number_format($data['tot']); ?></td>
												</tr>
										<?php
												$tot1 += $data['tot'];
												$no++;
											}
										}
										?>
									</tbody>
									<tr>
										<td colspan=2><b>TOTAL</b></td>
										<td align='right'><b><?= number_format($tot1, 0) ?></b></td>
									</tr>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>