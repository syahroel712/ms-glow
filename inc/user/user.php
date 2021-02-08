<!-- Content Header (Page header) -->
<div class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1 class="m-0 text-dark">User</h1>
			</div><!-- /.col -->
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="#">Home</a></li>
					<li class="breadcrumb-item active">User</li>
				</ol>
			</div><!-- /.col -->
		</div><!-- /.row -->
	</div><!-- /.container-fluid -->
</div>


<?php
if ($_GET['action'] == 'input') {
	include "tambah_user.php";
} else if ($_GET['action'] == 'view') {
?>

	<section class="content">
		<div class="container-fluid">
			<!-- Small boxes (Stat box) -->
			<div class="row">
				<div class="col-lg-12">
					<div class="card">
						<div class="card-header">
							<h3 class="card-title">User</h3>
						</div>
						<div class="card-body">
							<?php
							if ($_SESSION['admin']) { ?>
								<div class="row mb-4 ml-1">
									<a href="?page=user&action=input" class="btn btn-primary shadow"><i class="fa fa-plus"></i> Input user</a>
								</div>
							<?php } ?>

							<div class="table-responsive-sm">
								<table id="example1" class="table table-bordered">
									<thead>
										<tr>
											<th>Kode user</th>
											<th>Username</th>
											<th>Nama Lengkap </th>
											<th>Jenis Kelamin</th>
											<th>No.Telp</th>
											<th>Alamat</th>
											<th>Level</th>
											<th>Opsi</th>
										</tr>
									</thead>
									<tbody id="user">
										<?php
										$sql = mysql_query("SELECT * from tb_user") or die(mysql_error());
										$cek = mysql_num_rows($sql);
										if ($cek < 1) {
										?>
											<tr>
												<td colspan="7" style="padding:10px;">Data tidak ditemukan</td>
											</tr>
											<?php
										} else {
											while ($data = mysql_fetch_array($sql)) {
											?>
												<tr>
													<td><?= $data['kode_user']; ?></td>
													<td><?= $data['username']; ?></td>
													<td><?= $data['nama_lengkap']; ?></td>

													<td><?= "$data[jenis_kelamin]"; ?></td>
													<td align="right"><?= $data['no_telepon']; ?></td>
													<td align="right"><?= $data['alamat']; ?></td>
													<td align="right"><?= $data['level']; ?></td>

													<td><a href="?page=user&action=edit&id=<?= $data['kode_user']; ?>">
															<button class="btn btn-success btn-xs shadow" title="Edit Data"><span class='fas fa-edit'></span></button></a>
														<a onclick="return confirm('Yakin ingin menghapus data ?');" href="?page=user&action=hapus&id=<?= $data['kode_user']; ?>">
															<button class='btn btn-danger btn-xs shadow' title='Delete Data'><span class='fas fa-trash-alt'></span></button></a>
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
	include "edit_user.php";
} else if ($_GET['action'] == "hapus") {
	include "delete_user.php";
}
?>