<?php
if (isset($_GET['tgldari']) && !empty($_GET['tgldari']) && isset($_GET['tglsampai']) && !empty($_GET['tglsampai'])) {
	$tgldari = $_GET['tgldari'];
	$tglsampai = $_GET['tglsampai'];
	
	if($tgldari === $tglsampai){
    	$sql_filter_tabel .= "tb_penjualan.tgl_jual LIKE '$tgldari%'";
	}else{
    	$sql_filter_tabel .= "tb_penjualan.tgl_jual BETWEEN '$tgldari' AND '$tglsampai'";	    
	}
	
	
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
						<h3 class="card-title">Laporan Perbarang ( <b><?php echo $tgl ?></b> )</h3>
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
										<input type="date" class="form-control" name="tgldari" value="<?= $tgldari ?>">
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
										<input type="date" class="form-control" name="tglsampai" value="<?= $tglsampai ?>">
									</div>
								</div>

								<div class="form-group mx-sm-3 mb-2 ml-3">
									<label>&nbsp;</label>
									<div class="input-group ml-3">
										<div class="input-group-prepend">
											<button type="submit" class="btn btn-danger shadow "><i class="fa fa-search"></i> Cari</button>
										</div>
									</div>
								</div>
							</form>
							<div class="form-group mx-sm-3 mb-2 ml-3">
								<a href="inc/laporan/export_lap_perbarang.php?dari=<?php echo "$_GET[tgldari]"; ?>&sampai=<?php echo "$_GET[tglsampai]"; ?>"><button class="btn btn-primary shadow"><i class="fa fa-file-excel"></i> Export Penjualan</button></a>
							</div>
						</div>

						<div class="row mt-5">
							<div class="col-lg-12">
								<!-- /.box-header -->
								<div class="box-body">
									<canvas id="myBarChart1" height="40"></canvas>
								</div>
								<!-- /.box-body -->
							</div>
						</div>

						<div class="row mt-4">
							<div class="col-lg-12">
								<div class="table-responsive-sm">
									<table class="table table-bordered" id="example1">
										<thead>
											<tr>
												<th>No</th>
												<th>Nama Barang</th>
												<th>Jumlah Terjual</th>
												<th>Total</th>
												<!-- <th>Aksi</th> -->
											</tr>
										</thead>
										<tbody>
											<?php
											$ambil = mysql_query("SELECT tb_barang.kode_barang,tb_barang.nama_barang,tb_barang.harga_jual,SUM(tb_barang.harga_jual*tb_barang_terjual.jumlah_jual) AS total,SUM(tb_barang_terjual.jumlah_jual) as jumlah_beli FROM tb_barang JOIN tb_barang_terjual ON tb_barang.kode_barang=tb_barang_terjual.kode_barang JOIN tb_penjualan ON tb_penjualan.no_nota=tb_barang_terjual.no_nota WHERE $sql_filter_tabel GROUP BY tb_barang.nama_barang ORDER BY jumlah_beli DESC ");
											$no = 1;
											while ($pecah = mysql_fetch_assoc($ambil)) {
											?>
												<tr>
													<td><?= $no++; ?></td>
													<td><?= $pecah['nama_barang']; ?></td>
													<td><?= $pecah['jumlah_beli']; ?></td>
													<td>Rp. <?= number_format($pecah['total']); ?></td>
												</tr>
											<?php
											}
											?>
										</tbody>
									</table>
								</div>
							</div>
							<!-- /.box-body -->
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>