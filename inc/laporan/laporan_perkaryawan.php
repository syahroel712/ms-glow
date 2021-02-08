<?php

// cek apakah tanggal sudah dipilih atau belum
if (isset($_GET['tgldari']) && !empty($_GET['tgldari']) && isset($_GET['tglsampai']) && !empty($_GET['tglsampai'])) {
	$tgldari = $_GET['tgldari'];
	$tglsampai = $_GET['tglsampai'];
	$sql_filter_tabel .= "tb_penjualan.tgl_jual BETWEEN '$tgldari' AND '$tglsampai'";
	$sql_filter_grafik = $sql_filter_tabel;
	$tgl = tgl_indo($tgldari) . " - " . tgl_indo($tglsampai);
} else {
	$sql_filter_grafik = "left(tb_penjualan.tgl_jual,7) = left(CURDATE(), 7)";
	$sql_filter_tabel = "left(tb_penjualan.tgl_jual,7) = left(CURDATE(), 7)";
	$tgl = "Bulan " . tgl_indo3(date("Y-m-d"));
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
						<h3 class="card-title">Laporan Perkaryawan ( <b><?php echo $tgl ?></b> )</h3>
					</div>
					<div class="card-body">
						<div class="row">
							<form action="" method="GET" class="form-inline">
								<input type="hidden" name="page" value="<?= $_GET['page'] ?>" />
								<div class="form-group mx-sm-3 mb-2">
									<label>Dari</label>
									<div class="input-group ml-3">
										<div class="input-group-prepend">
											<span class="input-group-text">
												<i class="far fa-calendar-alt"></i>
											</span>
										</div>
										<input type="date" name="tgldari" value="<?= $tgldari ?>" class="form-control">
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
										<input type="date" name="tglsampai" value="<?= $tglsampai ?>" class="form-control">
									</div>
								</div>
								<div class="form-group mx-sm-3 mb-2 ml-3">
									<label>&nbsp;</label>
									<div class="input-group ml-3">
										<div class="input-group-prepend">
											<button type="submit" name="submit" class="btn btn-danger shadow"><i class="fa fa-search"></i> Cari</button>
										</div>
									</div>
								</div>
							</form>
						</div>

						<div class="row mt-5">
							<div class="col-md-12">
								<div class="box-body">
									<canvas id="myBarChart5" height="40"></canvas>
								</div>
							</div>
						</div>

						<div class="row mt-4">
							<div class="col-md-12">
								<div class="box box-info">
									<div class="box-body">
										<div class="table-responsive-sm">
											<table class="table table-bordered" id="example1">
												<thead>
													<tr>
														<th>No</th>
														<th>Nama Kasir</th>
														<th>Total</th>
														<th>Struk</th>
														<th>Rata Rata</th>
													</tr>
												</thead>
												<tbody>
													<?php
													$ambil = mysql_query("SELECT tb_user.nama_lengkap,SUM(tb_penjualan.total_harga) as total, COUNT(tb_user.kode_user) as struk , (SUM(tb_penjualan.total_harga)/COUNT(tb_user.kode_user)) as rata FROM tb_penjualan JOIN tb_user ON tb_penjualan.id_user=tb_user.kode_user WHERE $sql_filter_tabel GROUP BY tb_user.kode_user");
													$no = 1;
													while ($pecah = mysql_fetch_assoc($ambil)) {
													?>

														<tr>
															<td><?= $no++; ?></td>
															<td><?= $pecah['nama_lengkap']; ?></td>
															<td>Rp. <?= number_format($pecah['total']); ?></td>
															<td><?= $pecah['struk']; ?></td>
															<td>Rp. <?= number_format($pecah['rata']); ?></td>
														</tr>
													<?php
													} ?>
												</tbody>
											</table>
										</div>
									</div>
								</div>
							</div>
						</div>

					</div>
				</div>
			</div>
		</div>
	</div>
</section>