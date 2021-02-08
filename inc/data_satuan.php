<div class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1 class="m-0 text-dark">Satuan</h1>
			</div><!-- /.col -->
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="#">Home</a></li>
					<li class="breadcrumb-item active">Satuan</li>
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
							Data Barang
						</h3>
					</div>
					<div class="card-body">
						<div class="table-responsive-sm">
							<table id="example1" class="table table-bordered table-striped">
								<thead>
									<tr>
										<th>No</th>
										<th>Kode Barang</th>
										<th>Nama Barang</th>
										<th>Kategori</th>
										<th>Satuan</th>
										<th>Harga Beli</th>
										<th><b>Harga Jual</b></th>
										<th>Stok Sisa</th>
										<th>Opsi</th>
									</tr>
								</thead>
								<tbody>
									<?php
									$sql = mysql_query("SELECT * FROM tb_barang a left join kategori b on a.idkat=b.idkat");
									$no = 1;
									while ($data = mysql_fetch_array($sql)) {
									?>
										<tr>
											<td><?php echo $no++; ?></td>
											<td><?php echo $data['kode_barang']; ?></td>
											<td><?php echo $data['nama_barang']; ?></td>
											<td><?php echo $data['nmkat']; ?></td>
											<td><?php echo $data['satuan']; ?></td>
											<td><?php echo $data['harga_beli']; ?></td>

											<td align="right" style="border-left:0;"><?php echo number_format($data['harga_jual'], 2, ".", ","); ?></td>

											<td align="right"><?php echo $data['stok_sisa']; ?></td>
											<td>
												<a href="?page=lihat_satuan&kode_barang=<?php echo $data['kode_barang']; ?>">
													<button class="btn btn-warning btn-xs" title="Tambah Satuan"><span class='fa fa-plus'></span></button></a>
											</td>
										</tr>
									<?php
									}
									?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- /.row -->
	</div><!-- /.container-fluid -->
</section>