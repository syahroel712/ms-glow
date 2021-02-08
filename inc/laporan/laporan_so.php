<!-- Content Header (Page header) -->
<div class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1 class="m-0 text-dark">Laporan SO</h1>
			</div><!-- /.col -->
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="#">Home</a></li>
					<li class="breadcrumb-item active">Laporan SO</li>
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
						<h3 class="card-title">Laporan SO</h3>
					</div>
					<div class="card-body">

						<div class="table-responsive-sm">
							<table id="example1" class="table table-bordered">
								<thead>
									<tr>
										<th>No</th>
										<th>Tanggal</th>
										<th>Nama Barang</th>
										<th>Stok Sisa</th>
										<th>Stok Input</th>
										<th>Selisih</th>
										<?php
										if ($_SESSION['admin']) {
										?>
											<th>Opsi</th>
										<?php } ?>
									</tr>
								</thead>
								<tbody id="barang">
									<?php
									$no = 0;
									$sql = mysql_query("SELECT * from tb_so s LEFT JOIN tb_barang b ON s.kode_barang=b.kode_barang order by s.tgl_input ASC") or die(mysql_error());
									$cek = mysql_num_rows($sql);
									if ($cek < 1) {
									?>
										<tr>
											<td colspan="14" style="padding:10px;">Data tidak ditemukan</td>
										</tr>
										<?php
									} else {
										while ($data = mysql_fetch_array($sql)) {
											$no++;
											// $tanggal = tgl_indo($data[tanggal]);

										?>
											<tr>
												<td><?php echo $no; ?></td>
												<td><?php echo $data['tgl_input']; ?></td>
												<td><?php echo $data['nama_barang']; ?></td>
												<td align="right"><?php echo $data['stok_sisa']; ?></td>
												<td align="right"><?php echo $data['stok_input']; ?></td>
												<td align="right"><?php echo $data['selisih']; ?></td>
												<?php
												if (@$_SESSION['admin']) {
												?>
													<td>
														<a onclick="return confirm('Yakin ingin menghapus data ?');" href="inc/laporan/hapus_so.php?id=<?php echo $data['id']; ?>">
															<button class="btn btn-danger btn-xs" title="Hapus"><span class='fas fa-trash'></span></button></a>
													</td>
												<?php } ?>
											</tr>
									<?php
										}
									}
									?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<script>
	$(window).load(function() {
		$("#kode").focus();
	});
</script>