<?php
$data = mysql_fetch_assoc(mysql_query("SELECT * FROM setting"));

if (isset($_POST['simpan'])) {
	$update = mysql_query("UPDATE setting SET nama_toko='$_POST[nama_toko]', alamat='$_POST[alamat]' WHERE id='1'");

	if ($update) {
		echo "<script>window.alert('Data Berhasil Disimpan');
								window.location.href='index.php?page=setting';</script>";
	}
}
?>

<div class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1 class="m-0 text-dark">Setting</h1>
			</div><!-- /.col -->
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="#">Home</a></li>
					<li class="breadcrumb-item active">Setting</li>
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
							Setting
						</h3>
					</div>

					<form method="POST" action="">
						<div class="card-body">
							<div class="form-group row">
								<label for="nama_toko" class="col-sm-2 col-form-label">Nama Toko</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" id="nama_toko" name="nama_toko" value="<?= $data['nama_toko'] ?>">
								</div>
							</div>
							<div class="form-group row">
								<label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" id="alamat" name="alamat" value="<?= $data['alamat'] ?>">
								</div>
							</div>
						</div>
						<!-- /.card-body -->
						<div class="card-footer">
							<button id="tambah" name="simpan" class="btn btn-primary">Simpan</button>
						</div>
					</form>
					<!-- /.card-footer -->

				</div>
			</div>
		</div>
		<!-- /.row -->
	</div><!-- /.container-fluid -->
</section>