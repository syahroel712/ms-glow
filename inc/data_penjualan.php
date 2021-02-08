<?php
$tanggal = date('Y-m-d');

if (@$_SESSION['kasir']) {
	$kode_user = @$_SESSION['kasir'];
	$sql_user = mysql_query("select * from tb_user where kode_user = '$kode_user'") or die(mysql_error());
	$data_user = mysql_fetch_array($sql_user);
	$squ = "where kasir='$data_user[nama_lengkap]' and date(tgl_jual)='$tanggal'";
	//$ket="Hari Ini";
} else {
	if ($_POST['dari'] != "" and $_POST['sampai'] != "") {
		$squ = "where date(tgl_jual) between '$_POST[dari]' and '$_POST[sampai]' $kode";
		$tanggal = "$_POST[dari] s/d $_POST[sampai]";
	} else {
		$tanggal = "$tanggal";
		$squ = "where date(tgl_jual)='$tanggal'";
	}
}
?>

<div class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1 class="m-0 text-dark">Penjualan</h1>
			</div><!-- /.col -->
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="#">Home</a></li>
					<li class="breadcrumb-item active">Data Penjualan</li>
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
				<div class="card ">
					<div class="card-header">
						<h3 class="card-title">
							Data Penjualan (<b> <?= tgl_indo($tanggal) ?> <?php if ($_GET['no'] != "") {
																															echo "Nota : $_GET[no]";
																														} ?></b> )
						</h3>
					</div>
					<div class="card-body">
						<?php
						if ($_GET['no'] != "") {
						?>
							<!--<a href="?page=edit_penjualan&nota=<?php //echo $_GET['no']; 
																											?>" class="btn btn-primary"><i class="fa fa-plus"></i> Input Barang</a>-->
							<!--<br><br>-->
							<div class="table-responsive-sm">
								<table id="example1" class="table table-bordered">
									<thead>
										<tr>
											<th>No</th>
											<th>Kode Barang</th>
											<th>Nama Barang</th>
											<th>Harga Beli</th>
											<th>Harga Jual</th>
											<th>Jumlah Jual</th>
											<th>Sub Total</th>
											<?php
											if ($_SESSION['admin']) {
											?>
												<th>Opsi</th>
											<?php
											}
											?>
										</tr>
									</thead>
									<tbody>
										<?php
										$sql = mysql_query("SELECT * FROM tb_barang_terjual WHERE no_nota='$_GET[no]'");
										$cek = mysql_num_rows($sql);
										if ($cek < 1) {
										?>
											<tr>
												<td colspan="13" class="pt-3">Data tidak ditemukan</td>
											</tr>
											<?php
										} else {
											$no = 1;
											while ($data = mysql_fetch_array($sql)) {
											?>
												<tr>
													<td><?= "$no"; ?></td>
													<td><?= $data['kode_barang']; ?></td>
													<td><?= $data['nama_barang']; ?></td>
													<td align="right"><?= number_format($data['modal'], 0, ".", ","); ?></td>
													<td align="right"><?= number_format($data['harga_satuan'], 0, ".", ","); ?></td>
													<td align="right"><?= number_format($data['jumlah_jual'], 0, ".", ","); ?></td>
													<td align="right"><?= number_format($data['harga_akhir'], 0, ".", ","); ?></td>
													<?php if ($_SESSION['admin']) { ?>
														<td>
															<a onclick="return confirm('Yakin ingin menghapus data ?');" href="?page=penjualan&action=delete_detail&id=<?php echo $data['no']; ?>&nota=<?php echo $data['no_nota']; ?>">

																<button class='btn btn-danger btn-xs shadow' title='Delete Data'><span class='fa fa-trash-alt'></span></button></a>
														</td>
													<?php } ?>
												</tr>
										<?php
												$no++;
											}
										}
										?>
									</tbody>
								</table>
							</div>
							<?php
						} else {

							if ($_SESSION['kasir']) {
								//modal
								$kode_user = $_SESSION['kasir'];
								$sql_user = mysql_query("SELECT * from tb_user where kode_user = '$kode_user'") or die(mysql_error());
								$data_user = mysql_fetch_array($sql_user);
								$skr = date('Y-m-d');
								$modal = mysql_fetch_array(mysql_query("SELECT * from tb_modal where id_user='$kode_user' and tgl='$skr'"));
								$pe = mysql_fetch_array(mysql_query("SELECT *,sum(d.harga_akhir)as tot from tb_penjualan p,tb_barang_terjual d where p.no_nota=d.no_nota and date(p.tgl_jual)='$skr' and p.kasir='$data_user[nama_lengkap]'"));
							?>
								<h4 style='margin:0px;'>Modal &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: Rp. <?= number_format($modal['modal'], 0) ?></h4>
								<h4>Penjualan : Rp. <?= number_format($pe['tot'], 0) ?></h4>
								<h4 style="display: inline-block;">Total &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: Rp. <?= number_format($modal['modal'] + $pe['tot'], 0) ?></h4>
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="cetak_harian.php?tgl_jual=<?= $tanggal ?>&kasir=<?= $kode_user ?>" class="btn btn-success" style="display: inline-block;" target="_blank">Cetak<a>
										<br><br>
									<?php
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
														<button type="submit" name="cari" class="btn btn-danger shadow row"><i class="fa fa-search"></i> Cari</button>
													</div>
												</div>
											</div>
										</form>
										<div class="form-group mx-sm-3 mb-2 ml-3">
											<a href="inc/export_penjualan.php?dari=<?php echo "$_POST[dari]"; ?>&sampai=<?php echo "$_POST[sampai]"; ?>"><button class="btn btn-primary shadow"><i class="fa fa-file-excel"></i> Export Penjualan</button></a>
										</div>
									</div>

									<div class="container mt-4">
										<div class="table-responsive-sm">
											<table id="example1" class="table table-bordered">
												<thead>
													<tr>
														<th>No</th>
														<th>No Nota</th>
														<th>Tanggal Jual</th>
														<th>Kasir</th>
														<th>Total Harga</th>
														<th>Bayar</th>
														<th>Kembalian</th>
														<th>Metode Pembayaran</th>
														<?php
														if (@$_SESSION['admin']) {
														?>
															<th>Opsi</th>
														<?php
														}
														?>
													</tr>
												</thead>
												<tbody id="penjualan">
													<?php
													$sql = mysql_query("SELECT * FROM tb_penjualan $squ ORDER BY tgl_jual DESC");
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
														?>

															<tr>
																<?php
																$tot = mysql_fetch_array(mysql_query("SELECT *,SUM(harga_akhir) AS tot FROM tb_barang_terjual WHERE no_nota='$data[no_nota]' GROUP BY no_nota"));
																?>
																<td><?php echo "$no"; ?></td>
																<td>
																	<a href='?page=penjualan&action=view&no=<?= $data['no_nota']; ?>'><?= $data['no_nota']; ?></a>
																</td>
																<td><?= tgl_indo($data['tgl_jual']); ?></td>
																<td><?= $data['kasir']; ?></td>
																<td align="right"><?= number_format($data['total_harga'], 0, ".", ","); ?></td>
																<td align="right"><?= number_format($data['bayar'], 0, ".", ","); ?></td>
																<td align="right"><?= number_format($data['bayar'] - $data['total_harga'], 0, ".", ","); ?></td>
																<td><?= $data['metode_pembayaran'] ?></td>

																<td>
																	<a href="cetak_struk.php?id=<?php echo $data['no_nota']; ?>" target="_blank">
																		<button class="btn btn-success btn-xs shadow" title="Print Data"><span class='fa fa-print'></span></button></a>
																	<?php
																	if ($_SESSION['admin']) {
																	?>
																		<a onclick="return confirm('Yakin ingin menghapus data ?');" href="?page=penjualan&action=delete&id=<?php echo $data['no_nota']; ?>">
																			<button class='btn btn-danger btn-xs shadow' title='Delete Data'><span class='fa fa-trash-alt'></span></button></a>
																	<?php
																	}
																	?>
																</td>
															</tr>
													<?php
															$totdismember += $data['diskon_total'];
															$totsel += $tot['tot'];
															$totseluruh = $totsel - $totdismember;
															$totbayar += $data['bayar'];
															$no++;
														}
													}
													?>
												</tbody>

												<tr>
													<td colspan=4><b>TOTAL</b></td>
													<td align='right'><b><?= number_format($totseluruh, 0) ?></b></td>
													<td align='right'><b> </b></td>
													<td align='right'><b> </b></td>

													<!--<td align='right'><b><?= number_format($totbayar, 0) ?></b></td>-->
													<!--			<td align='right'><b><?= number_format($totbayar - $totsel, 0) ?></b></td>-->
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
	$("#caripenjualan").click(function() {
		var tgl_penjualan = $(this).val();
		$.ajax({
			url: 'inc/proses_cari_penjualan.php',
			type: 'post',
			data: 'tgl=' + tgl_penjualan,
			success: function(msg) {
				$("tbody#penjualan").html(msg);
			}
		});
	});

	$("#penjualan").on("click", "#lihatbarang", function() {
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