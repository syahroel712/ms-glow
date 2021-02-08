<?php
$tanggal = date('Y-m-d');
if ($_POST['dari'] != "" and $_POST['sampai'] != "") {
	$squ = "where date(tgl_beli) between '$_POST[dari]' and '$_POST[sampai]' $kode";
	$tanggal = "$_POST[dari] s/d $_POST[sampai]";
} else {
	$tanggal = "$tanggal";
	$squ = "where date(tgl_beli)='$tanggal'";
}
?>

<div class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1 class="m-0 text-dark">Pembelian</h1>
			</div><!-- /.col -->
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="#">Home</a></li>
					<li class="breadcrumb-item active">Data Pembelian</li>
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
						<h3 class="card-title">
							Data Pembelian (<b> <?= tgl_indo($tanggal) ?> <?php if ($_GET['no'] != "") {
																															echo "Nota : $_GET[no]";
																														} ?> </b>)
						</h3>
					</div>
					<div class="card-body">

						<?php
						if ($_GET['no'] != "") {
						?>
							<div class="table-responsive-sm">
								<table id="example1" class="table table-bordered">
									<thead>
										<tr>
											<th>No</th>
											<th>Kode Barang</th>
											<th>Nama Barang</th>
											<th>Harga Beli</th>
											<th>Jumlah Jual</th>
											<th>Sub Total</th>
											<?php if (@$_SESSION['admin']) { ?>
												<th>Opsi</th>
											<?php } ?>
										</tr>
									</thead>
									<tbody id="pembelian">
										<?php
										$sql = mysql_query("select * from tb_barang_terbeli where nota='$_GET[no]'") or die(mysql_error());
										$cek = mysql_num_rows($sql);
										if ($cek < 1) {
										?><tr>
												<td colspan="13" style="padding:10px;">Data tidak ditemukan</td>
											</tr><?php
													} else {
														$no = 1;
														while ($data = mysql_fetch_array($sql)) {
														?><tr>
													<td><?php echo "$no"; ?></td>
													<td><?php echo $data['kode_barang']; ?></td>
													<td><?php echo $data['nama_barang']; ?></td>
													<td align="right" style="border-left:0;"><?php echo number_format($data['harga_satuan'], 0); ?></td>
													<td align="right" style="border-left:0;"><?php echo number_format($data['jml'], 0); ?></td>
													<td align="right" style="border-left:0;"><?php echo number_format($data['harga_satuan'] * $data['jml'], 0); ?></td>
													<?php if (@$_SESSION['admin']) { ?>
														<td>
															<a onclick="return confirm('Yakin ingin menghapus data ?');" href="?page=pembelian&action=delete_detail&id=<?php echo $data['no']; ?>&nota=<?php echo $data['nota']; ?>">
																<button class='btn btn-danger btn-xs shadow' title='Delete Data'><span class='fa fa-trash-alt'></span></button></a></td>

													<?php } ?>
												</tr><?php
															$no++;
														}
													} ?>
									</tbody>
								</table>
							</div>
						<?php
						} else {

							if ($_SESSION['kasir']) {
								//modal
								$kode_user = @$_SESSION['kasir'];
								$sql_user = mysql_query("select * from tb_user where kode_user = '$kode_user'") or die(mysql_error());
								$data_user = mysql_fetch_array($sql_user);
								$skr = date('Y-m-d');
								$modal = mysql_fetch_array(mysql_query("select * from tb_modal where id_user='$kode_user' and tgl='$skr'"));
								$pe = mysql_fetch_array(mysql_query("select *,sum(d.harga_akhir)as tot from tb_penjualan p,tb_barang_terjual d where p.no_nota=d.no_nota and date(p.tgl_jual)='$skr' and p.kasir='$data_user[nama_lengkap]'"));
								echo "<h4 style='margin:0px;'>Modal &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: Rp. " . number_format($modal[modal], 0) . "</h4>";
								echo "<h4>Penjualan : Rp. " . number_format($pe[tot], 0) . "</h4>";
								echo "<h4>Total &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: Rp. " . number_format($modal[modal] + $pe[tot], 0) . "</h4>";
							}
						?>
							<div class="row">
								<form action="" method="POST" class="form-inline">
									<div class="form-group mx-sm-3 mb-2">
										<label for="dari">Dari</label>
										<div class="input-group ml-3">
											<div class="input-group-prepend">
												<span class="input-group-text">
													<i class="far fa-calendar-alt"></i>
												</span>
											</div>
											<input type="date" class="form-control float-right" value="<?php echo "$_POST[dari]"; ?>" id="dari" name="dari">
										</div>
									</div>

									<div class="form-group mx-sm-3 mb-2">
										<label for="sampai">Sampai</label>
										<div class="input-group ml-3">
											<div class="input-group-prepend">
												<span class="input-group-text">
													<i class="far fa-calendar-alt"></i>
												</span>
											</div>
											<input type="date" class="form-control float-right" value="<?php echo "$_POST[sampai]"; ?>" id="sampai" name="sampai">
										</div>
									</div>

									<div class="form-group mx-sm-3 mb-2">
										<label>&nbsp;</label>
										<div class="input-group ml-3">
											<div class="input-group-prepend">
												<button type="submit" name="cari" class="btn btn-danger shadow"><i class="fa fa-search"></i> Cari</button>
											</div>
										</div>
									</div>
								</form>
							</div>

							<div class="container mt-4">
								<div class="table-responsive-sm">
									<table id="example1" class="table table-bordered">
										<thead>
											<tr>
												<th>No Nota</th>
												<th>Tanggal Beli</th>
												<th>Supplier</th>
												<th>Kasir</th>
												<th>Total Harga</th>
												<th>Diskon</th>
												<th>PPn</th>
												<th>Total Bayar</th>
												<?php if (@$_SESSION['admin']) { ?>
													<th>Opsi</th>
												<?php } ?>
											</tr>
										</thead>
										<tbody id="pembelian">
											<?php
											$sql = mysql_query("SELECT * FROM tb_pembelian $squ ORDER BY tgl_beli DESC");
											$cek = mysql_num_rows($sql);
											if ($cek < 1) {
											?>
												<tr>
													<td colspan="13" class="p-3">Data tidak ditemukan</td>
												</tr>
												<?php
											} else {
												$no = 1;
												while ($data = mysql_fetch_array($sql)) {
													$sup = mysql_fetch_array(mysql_query("SELECT * FROM tb_supplier WHERE idsup='$data[idsup]'"));

													$tot = mysql_fetch_array(mysql_query("SELECT *,SUM(harga_akhir) AS tot,(SUM(harga_akhir)-(SUM(harga_akhir) * ('$data[diskon_persen] . '/100))) AS tot2 FROM tb_barang_terbeli WHERE nota='$data[nota]' group by nota"));
												?>
													<tr>
														<td>
															<a href='?page=pembelian&action=view&no=<?php echo $data['nota']; ?>'><?= $data['nota']; ?></a>
														</td>
														<td><?= tgl_indo($data['tgl_beli']); ?></td>
														<td><?= $sup['nmsup']; ?></td>
														<td><?= $data['kasir']; ?></td>
														<td align="right"><?= number_format($tot['tot'], 0); ?></td>
														<td align="right">
															(<?= number_format($data['diskon_persen'], 0); ?>%)
															Rp. <?= number_format($tot['tot'] * ($data['diskon_persen'] / 100)); ?>
														</td>
														<td align="right"><?= number_format($data['ppn'], 0); ?>%</td>
														<td align="right">
															<?= number_format($tot[tot2] + ($tot['tot2'] * ($data['ppn'] / 100)), 0); ?>
														</td>
														<?php if ($_SESSION['admin']) { ?>
															<td>
																<a href="cetak_struk_beli.php?id=<?php echo $data['nota']; ?>" target="_blank">
																	<button class="btn btn-success btn-xs shadow" title="Print Data"><span class='fa fa-print'></span></button>
																</a>
																<a onclick="return confirm('Yakin ingin menghapus data ?');" href="?page=pembelian&action=delete&id=<?php echo $data['nota']; ?>">
																	<button class='btn btn-danger btn-xs shadow' title='Delete Data'><span class='fa fa-trash-alt'></span></button>
																</a>
															</td>

														<?php }
														$totsel += $tot['tot'];
														$totdiskon += $data['diskon_persen'];
														$totppn += $data['ppn'];
														$totbayar += $tot[tot2] + ($tot['tot2'] * ($data['ppn'] / 100));
														$no++;
														?>
													</tr><?php
															}
														} ?>
										</tbody>

										<tr>
											<td colspan=4><b>TOTAL</b></td>
											<td align='right'><b><?= number_format($totsel, 0) ?></b></td>
											<td align='right'><b><?= number_format($totdiskon, 0) ?> %</b></td>
											<td align='right'><b><?= number_format($totppn, 0) ?> %</b></td>
											<td align='right'><b><?= number_format($totbayar, 0) ?></b></td>
											<th></th>
										</tr>

									</table>
								</div>
							</div>
						<?php
						}
						?>

					</div>

				</div>
			</div>
		</div>
		<!-- /.row -->
	</div><!-- /.container-fluid -->
</section>

<script type="text/javascript">
	$("#caripembelian").click(function() {
		var tgl_pembelian = $(this).val();
		$.ajax({
			url: 'inc/proses_cari_pembelian.php',
			type: 'post',
			data: 'tgl=' + tgl_pembelian,
			success: function(msg) {
				$("tbody#pembelian").html(msg);
			}
		});
	});

	$("#pembelian").on("click", "#lihatbarang", function() {
		var no = $(event.target).attr("no");
		$.ajax({
			data: 'no=' + no,
			url: 'inc/lihat_barang_dijual.php',
			type: 'post',
			success: function(msg) {
				$("#barangterjual").html(msg);
			}
		});
		$("#bg-popup").fadeIn(700, function() {
			$("#popup").fadeIn(600);
		});
	});

	$("#keluar").click(function() {
		$("#popup").fadeOut(400, function() {
			$("#bg-popup").fadeOut(600);
		});
	});
</script>