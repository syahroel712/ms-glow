<div class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1 class="m-0 text-dark">Barang</h1>
			</div><!-- /.col -->
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="#">Home</a></li>
					<li class="breadcrumb-item active">Barang</li>
				</ol>
			</div><!-- /.col -->
		</div><!-- /.row -->
	</div><!-- /.container-fluid -->
</div>

<!-- <?php
if ($_GET['action'] == 'input') {
	include "tambah_barang.php";
} else if ($_GET['action'] == 'view') {
	$no = 1;

	$sql = mysql_query("SELECT * FROM tb_barang ORDER BY tanggal DESC");


	$stok = mysql_fetch_array(mysql_query("SELECT *,sum(stok_sisa)as tot,sum(stok_sisa*harga_jual)as hb FROM tb_barang WHERE stok_awal!=0"));

?> -->

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

							<?php
							if ($_SESSION['admin']) { ?>
								<div class="row p-3 mb-1">
									<a href="?page=barang&action=input" class="mr-2"><button class="btn btn-primary shadow"><i class="fa fa-plus"></i> Input Barang Masuk</button></a>
									<a href="inc/export.php"><button class="btn btn-warning shadow"><i class="fa fa-file-excel"></i> Export Barang</button></a>
								</div>
							<?php } ?>
							<div class="row p-3 mb-2">
								<form method="post" enctype="multipart/form-data" action="proses_import.php" class="form-inline">
									<div class="form-group mx-3">
										Silakan Pilih File Excel
									</div>
									<div class="form-group mx-3">
										<input name="userfile" type="file">
									</div>
									<input name="upload" type="submit" value="Import" class="btn btn-success">
								</form>
							</div>

							<!--<div class="row">-->
							<!--	<form action="index.php?page=barang&action=view" method="post" class="form-inline">-->
							<!--		<div class="form-group mx-sm-3 mb-2">-->
							<!--			<label class="mr-3">Pencarian Barang</label>-->
							<!--			<select name="filter" class="form-control">-->
							<!--				<option value="kode" selected>Kode Barang</option>-->
							<!--				<option value="nama">Nama Barang</option>-->
							<!--			</select>-->
							<!--		</div>-->
							<!--		<div class="form-group mx-sm-3 mb-2">-->
							<!--			<input type="text" class="form-control" id="kode" name="kode" placeholder="Masukkan nama barang/kode barang..." style="width: 18em" />-->
							<!--		</div>-->
							<!--		<div class="form-group mx-sm-3 mb-2">-->
							<!--			<button type="submit" name="cari" class="btn btn-danger shadow" id="caribarang"><i class="fa fa-search"></i> Cari</button>-->
							<!--		</div>-->
							<!--	</form>-->
							<!--</div>-->

							<div class="row">
								<div class="col-md-12 p-3">
									<div class="row title-info-barang">
										<div class="col-md-2">Total Stok</div>
										<div class="col-md-2"><b><?php echo number_format($stok['tot'], 0); ?></b></div>
									</div>
									<div class="row title-info-barang">
										<div class="col-md-2">Total Rp. </div>
										<div class="col-md-2"><b><?php echo number_format($stok['hb'], 0); ?></b></div>
									</div>
								</div>
							</div>

							<div class="table-responsive-sm">
								<table id="example2Server" class="table table-bordered">
									<thead>
										<tr>
											<!-- <th>No</th> -->
											<th>Kode Barang</th>
											<th>Nama Barang</th>
											<th>Diskon</th>
											<th>Harga Beli (Rp.)</th>
											<th>Harga Jual (Rp.)</th>
											<th>Stok Sisa</th>
											<?php
											if ($_SESSION['admin']) {
											?>
												<th>Opsi</th>
											<?php
											}
											?>
										</tr>
									</thead>
									<!-- <tbody id="barang">
										<?php
										$cek = mysql_num_rows($sql);
										if ($cek < 1) {
										?>
											<tr>
												<td colspan="9" class="p-3">Data tidak ditemukan</td>
											</tr>
											<?php
										} else {
											while ($data = mysql_fetch_array($sql)) {
												$kat = mysql_fetch_array(mysql_query("SELECT * FROM kategori WHERE idkat='$data[idkat]'"));

											?>
												<tr>
													<td><?= $no; ?></td>
													<td><?= $data['kode_barang']; ?></td>
													<td><?= $data['nama_barang']; ?></td>
													<td><?= $kat['nmkat']; ?></td>
													<td><?= $data['diskon']; ?> %</td>
													<td align="right"><?= number_format($data['harga_beli'], 0, ".", ","); ?></td>
													<td align="right"><?= number_format($data['harga_jual'], 0, ".", ","); ?></td>
													<td align="right"><?= $data['stok_sisa']; ?></td>
													<?php
													if ($_SESSION['admin']) {
													?>
														<td>
															<a href="?page=barang&action=edit&id=<?php echo $data['kode_barang']; ?>">
																<button class="btn btn-success btn-xs shadow" title="Edit Data"><span class='fa fa-edit'></span></button></a>
															<a onclick="return confirm('Yakin ingin menghapus data ?');" href="?page=barang&action=hapus&id=<?php echo $data['kode_barang']; ?>">
																<button class='btn btn-danger btn-xs shadow' title='Delete Data'><span class='fa fa-trash-alt'></span></button></a>
															<a onclick='window.open("inc/barang/cetak_barang.php?id=<?php echo "$data[kode_barang]"; ?>", "Cetak Barang", "height=700,width=700,scrollbars=yes");'>
																<button class='btn btn-info btn-xs shadow' title='Cetak Data'><span class='fa fa-print'></span></button></a>
														</td>
													<?php } ?>
												</tr>
										<?php
												$no++;
											}
										}
										?>
									</tbody> -->
								</table>
							</div>
						</div>

					</div>
				</div>
			</div>
			<!-- /.row -->
		</div><!-- /.container-fluid -->
	</section>

	<script>
		$(window).load(function() {
			$("#kode").focus();
		});
	</script>
<?php
} else if ($_GET['action'] == 'edit') {
	include "edit_barang.php";
} else if ($_GET['action'] == "hapus") {
	include "delete_barang.php";
} else if ($_GET['action'] == "cetakbarang") {
	include "cetak_barang.php";
}
?>