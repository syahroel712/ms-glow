<!-- Content Header (Page header) -->
<div class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1 class="m-0 text-dark">Pemasok</h1>
			</div><!-- /.col -->
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="#">Home</a></li>
					<li class="breadcrumb-item active">Pemasok</li>
				</ol>
			</div><!-- /.col -->
		</div><!-- /.row -->
	</div><!-- /.container-fluid -->
</div>

<?php if ($_GET['action'] == 'input') {
	include "tambah_pemasok.php";
} else if ($_GET['action'] == 'view') {
?>
	<section class="content">
		<div class="container-fluid">
			<!-- Small boxes (Stat box) -->
			<div class="row">
				<div class="col-lg-12">
					<div class="card">
						<div class="card-header">
							<h3 class="card-title">Pemasok</h3>
						</div>
						<div class="card-body">
							<div class="row mb-4 ml-1">
								<a href="?page=pemasok&action=input"><button class="btn btn-primary shadow"><i class="fa fa-plus"></i> Tambah Pemasok</button></a>
							</div>
							<div class="row p-3 mb-2">
								<form method="post" enctype="multipart/form-data" action="proses_import_pemasok.php" class="form-inline">
									<div class="form-group mx-3">
										Silakan Pilih File Excel
									</div>
									<div class="form-group mx-3">
										<input name="userfile" type="file">
									</div>
									<input name="upload" type="submit" value="Import" class="btn btn-success">
								</form>
							</div>

							<div class="table-responsive-sm">
								<table id="example1" class="table table-bordered">
									<thead>
										<tr>
											<th>No.</th>
											<th>Nama Supplier</th>
											<th>Sales</th>
											<th>No.Telp Sales</th>
											<th>Alamat</th>
											<th>No.Telp Supplier</th>

											<th>Opsi</th>
										</tr>
									</thead>
									<tbody>
										<?php
										$sql = mysql_query("SELECT * from tb_supplier") or die(mysql_error());
										$cek = mysql_num_rows($sql);
										$no = 1;
										if ($cek < 1) { ?>
											<tr>
												<td colspan="7" class="p-3">Data tidak ditemukan</td>
											</tr>
											<?php
										} else {
											while ($data = mysql_fetch_array($sql)) {
											?>
												<tr>
													<td><?= $no++; ?></td>
													<td><?= $data['nmsup']; ?></td>
													<td><?= $data['sales']; ?></td>
													<td><?= $data['nosales']; ?></td>
													<td><?= $data['almt_s']; ?></td>
													<td><?= $data['notelp_s']; ?></td>
													<td>
														<a href="?page=pemasok&action=edit&id=<?= $data['idsup']; ?>">
															<button class="btn btn-success btn-xs shadow" title="Edit Data"><span class='fas fa-edit'></span></button>
														</a>
														<a onclick="return confirm('Yakin ingin menghapus pemasok ?');" href="?page=pemasok&action=delete&id=<?php echo $data['idsup']; ?>">
															<button class='btn btn-danger btn-xs shadow' title='Delete Data'><span class='fas fa-trash-alt'></span></button>
														</a>
													</td>
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
<?php
} else if ($_GET['action'] == 'edit') {
	include "edit_pemasok.php";
} else if ($_GET['action'] == "delete") {
	include "delete_pemasok.php";
} ?>