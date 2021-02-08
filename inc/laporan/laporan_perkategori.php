<?php
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
		<div class="row">
			<div class="col-lg-12">
				<div class="card">
					<div class="card-header">
						<h3 class="card-title">Laporan Perkategori ( <b><?php echo $tgl ?></b> )</h3>
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
									<canvas id="myBarChart2" height="40"></canvas>
								</div>
							</div>
						</div>

						<div class="row mt-4">
							<div class="col-md-12">
								<div class="box-body">
									<div class="table-responsive-sm">
										<table class="table table-bordered" id="example1">
											<thead>
												<tr>
													<th>No</th>
													<th>Nama Kategori</th>
													<th>Jumlah Terjual</th>
													<th>Total</th>
													<!-- <th>Aksi</th> -->
												</tr>
											</thead>
											<tbody>
												<?php
												$ambil = mysql_query("SELECT tb_barang_terjual.kode_barang,kategori.nmkat,SUM(tb_barang.harga_jual*tb_barang_terjual.jumlah_jual) as total,SUM(tb_barang_terjual.jumlah_jual) as total_terjual 
                                    FROM tb_barang 
                                    JOIN kategori ON tb_barang.idkat=kategori.idkat 
                                    JOIN tb_barang_terjual ON tb_barang_terjual.kode_barang=tb_barang.kode_barang 
                                    JOIN tb_penjualan ON tb_barang_terjual.no_nota=tb_penjualan.no_nota
                                    WHERE $sql_filter_tabel GROUP BY kategori.nmkat ORDER BY total_terjual DESC LIMIT 10");
												$no = 1;
												while ($pecah = mysql_fetch_assoc($ambil)) {
												?>

													<tr>
														<td><?= $no++; ?></td>
														<td><?= $pecah['nmkat']; ?></td>
														<td><?= $pecah['total_terjual']; ?></td>
														<td>Rp. <?= number_format($pecah['total']); ?></td>
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
</section>