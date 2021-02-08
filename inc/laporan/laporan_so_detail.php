<?php
$sql = mysql_query("SELECT * FROM tb_barang WHERE kode_barang='$_GET[id]'");
$r = mysql_fetch_assoc($sql);

if (isset($_POST['simpanso'])) {
	$tgl = date('Y-m-d');
	$insert = mysql_query("INSERT INTO tb_so (tgl_input, kode_barang, stok_sisa, stok_input, selisih) VALUES('$tgl', '$_POST[kode_barang]', '$_POST[stok_sisa]', '$_POST[stok_terkini]', '$_POST[selisih]')");

	if ($insert) {
		echo "<script>alert('Data Disimpan');
							window.location='index.php?page=laporan_so';</script>";
	}
}
?>

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
						<h3 class="card-title">Detail SO ( <b><?= $r['nama_barang'] ?></b> )</h3>
					</div>
					<div class="card-body">

						<div class="row">
							<form action="" method="POST" class="form-inline">
								<div class="form-group mx-sm-3 mb-2">
									<input type="text" class="form-control" id="total" name="total" placeholder="Input Total Barang Terkini" required />
								</div>
								<div class="form-group mx-sm-3 mb-2">
									<button type="submit" name="simpan" class="btn btn-primary shadow">Tambah</button>
								</div>
								<div class="form-group mx-sm-3 mb-2">
									<a href="?page=laporan_so" class="btn btn-danger shadow">Kembali</a>
								</div>
							</form>

							<form action="" method="POST" class="form-inline">
								<div class="form-group mx-sm-3 mb-2">
									<input type="hidden" name="kode_barang" class="form-control" value="<?php echo $r['kode_barang']; ?>">
									<input type="hidden" name="stok_sisa" class="form-control" value="<?php echo $r['stok_sisa']; ?>">
									<input type="hidden" name="stok_terkini" class="form-control" value="<?= $_POST['total'] != "" ? $_POST['total'] : ""  ?>">
									<input type="hidden" name="selisih" class="form-control" value="<?= $_POST['total'] != "" ? $r['stok_sisa'] - $_POST['total'] : ""; ?>">

									<?php
									if ($_POST['total'] != '') { ?>
										<button type="submit" name="simpanso" class="btn btn-success shadow">Simpan</button>
									<?php } ?>
								</div>
							</form>
						</div>
						<br />

						<div class="table-responsive-sm">
							<table id="example" class="table table-bordered">
								<thead>
									<tr>
										<th>Kode Barang</th>
										<th>Nama Barang</th>
										<th>Stok Sisa</th>
										<th>Stok Terkini</th>
										<th>Selisih</th>
									</tr>
								</thead>
								<tbody id="barang">
									<tr>
										<td><?php echo $r['kode_barang']; ?></td>
										<td><?php echo $r['nama_barang']; ?></td>
										<td align="right"><?php echo $r['stok_sisa']; ?></td>
										<td align="right"><?= $_POST['total'] != "" ? $_POST['total'] : ""  ?></td>
										<td align="right"><?= $_POST['total'] != "" ? $r['stok_sisa'] - $_POST['total'] : ""; ?></td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>

				</div>
			</div>
		</div>
	</div>