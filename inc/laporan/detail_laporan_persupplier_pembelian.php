<?php
$supplier = mysql_fetch_assoc(mysql_query("SELECT * FROM tb_supplier WHERE idsup='$_GET[id]'"));
?>

<!-- Content Header (Page header) -->
<div class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1 class="m-0 text-dark">Detail Laporan Persupplier</h1>
			</div><!-- /.col -->
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="#">Home</a></li>
					<li class="breadcrumb-item active">Detail Laporan Persupplier</li>
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
						<h3 class="card-title">Laporan Persupplier ( <b><?php echo $supplier['nmsup']; ?></b> )</h3>
					</div>
					<div class="card-body">

						<div class="container mt-4">
							<div class="table-responsive-sm">
								<table id="example1" class="table table-bordered">
									<thead>
										<tr>
											<th>No</th>
											<th>Tanggal</th>
											<th>No Nota</th>
											<th>Supplier</th>
											<th>Total Harga</th>
											<th>Diskon</th>
											<th>PPn</th>
											<th>Total Pembelian</th>
											<th>Detail</th>

										</tr>
									</thead>
									<tbody id="pembelian">
										<?php
										$sql = mysql_query("SELECT *, date(tgl_beli)as tgl, sum(total) as tot from tb_pembelian WHERE idsup='$_GET[id]' group by nota") or die(mysql_error());
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
													<td><?= $data['tgl']; ?></td>
													<td><?= $data['nota']; ?></td>
													<td><?= $sup['nmsup']; ?></td>
													<td align="right" style="border-left:0;"><?= number_format($data['tot'], 0, ".", ","); ?></td>
													<td align="right" style="border-left:0;"><?= number_format($data['diskon_persen'], 0, ".", ","); ?></td>
													<td align="right" style="border-left:0;"><?= number_format($data['ppn'], 0, ".", ","); ?></td>
													<td align="right" style="border-left:0;">
														<?= number_format($data['tot'] - ($data['tot'] * ($data['diskon_persen'] / 100)) + (($data['tot'] - ($data['tot'] * ($data['diskon_persen'] / 100))) * $data['ppn'] / 100), 0, ".", ","); ?>
													</td>
													<td align="center">
														<a href="cetak_struk_beli.php?id=<?php echo $data['nota']; ?>" target="_blank">
															<button class="btn btn-success btn-xs" title="Print Data"><span class='fas fa-print'></span>
															</button>
														</a>
													</td>
												</tr>
										<?php
												$tot1 = $tot1 + ($data['tot'] - ($data['tot'] * ($data['diskon_persen'] / 100)) + (($data['tot'] - ($data['tot'] * ($data['diskon_persen'] / 100))) * $data['ppn'] / 100));
												$no++;
											}
										}
										?>
									</tbody>
									<tr>
										<td colspan=7><b>TOTAL</b></td>
										<td align='right'><b><?= number_format($tot1, 0) ?></b></td>
										<th></th>
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