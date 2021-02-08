<!-- Content Header (Page header) -->
<div class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1 class="m-0 text-dark">Barang Terlaris</h1>
			</div><!-- /.col -->
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="#">Home</a></li>
					<li class="breadcrumb-item active">Barang Terlaris</li>
				</ol>
			</div><!-- /.col -->
		</div><!-- /.row -->
	</div><!-- /.container-fluid -->
</div>

<?php

$tgl = date("Y-m-d");
if ($_GET['action'] == 'input') {
	//include "tambah_barang.php";
} else if ($_GET['action'] == 'view') {
	$i = 1;
	$no = 1;
	if ($_POST['dari'] != "" and $_POST['sampai'] != "") {
		$cari = "and date(p.tgl_jual) between '$_POST[dari]' and '$_POST[sampai]'";
		$ket = "$_POST[dari] s/d $_POST[sampai]";
	} else {
		$cari = "and date(p.tgl_jual)='$tgl'";
		$ket = "Hari ini";
	}

	$sql = mysql_query("SELECT *,SUM(jumlah_jual)as terjual from tb_barang b, tb_barang_terjual d,tb_penjualan p where p.no_nota=d.no_nota and b.kode_barang=d.kode_barang $cari group by d.kode_barang order by p.tgl_jual desc");

?>


	<section class="content">
		<div class="container-fluid">
			<!-- Small boxes (Stat box) -->
			<div class="row">
				<div class="col-lg-12">
					<div class="card">
						<div class="card-header">
							<h3 class="card-title">Data Barang Terlaris ( <?php echo "$ket"; ?> )</h3>
						</div>
						<div class="card-body">
							<div class="row">
								<form action="" method="post" class="form-inline">
									<div class="form-group mx-sm-3 mb-2">
										<label for="dari">Dari</label>
										<div class="input-group ml-3">
											<div class="input-group-prepend">
												<span class="input-group-text">
													<i class="far fa-calendar-alt"></i>
												</span>
											</div>
											<input type="date" class="form-control" value="<?php echo "$_POST[dari]"; ?>" id="dari" name="dari" placeholder="yyyy-mm-dd" />
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
											<input type="date" class="form-control" value="<?php echo "$_POST[sampai]"; ?>" id="sampai" name="sampai" placeholder="yyyy-mm-dd" />
										</div>
									</div>
									<div class="form-group mx-sm-3 mb-2">
										<button type="submit" name="cari" class="btn btn-danger shadow"><i class="fa fa-search"></i> Cari</button>
									</div>
								</form>
							</div>

							<div class="container mt-4">
								<table id="example1" class="table table-bordered">
									<thead>
										<tr>
											<th>No</th>
											<th>Kode Barang</th>
											<th>Nama Barang</th>
											<th>Kategori</th>
											<th>Satuan</th>
											<th>Stok Sisa</th>
											<th>Stok Terjual</th>
											<th>Tgl Barang Masuk</th>
										</tr>
									</thead>
									<tbody id="barang">
										<?php
										$cek = mysql_num_rows($sql);
										if ($cek < 1) {
										?>
											<tr>
												<td colspan="8" class="p-3">Data tidak ditemukan</td>
											</tr>
											<?php
										} else {
											while ($data = mysql_fetch_array($sql)) {
												$kat = mysql_fetch_array(mysql_query("SELECT * from kategori WHERE idkat='$data[idkat]'"));
												$tanggal = tgl_indo($data['tanggal']);

											?>
												<tr>
													<td><?= $no; ?></td>
													<td><?= $data['kode_barang']; ?></td>
													<td><?= $data['nama_barang']; ?></td>
													<td><?= "$kat[nmkat]"; ?></td>
													<td><?= $data['satuan']; ?></td>
													<td align="right"><?= $data['stok_sisa']; ?></td>
													<td align="right"><?= $data['terjual']; ?></td>
													<td align="center"><?= $tanggal; ?></td>
												</tr>
										<?php
												$no++;
											}
										}
										?>
									</tbody>
								</table>


								<script>
									$(window).load(function() {
										$("#kode").focus();
									});
								</script>
							<?php
						}
							?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>