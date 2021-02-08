<div class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1 class="m-0 text-dark">Kategori</h1>
			</div><!-- /.col -->
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="#">Home</a></li>
					<li class="breadcrumb-item active">Kategori</li>
				</ol>
			</div><!-- /.col -->
		</div><!-- /.row -->
	</div><!-- /.container-fluid -->
</div>

<?php
if ($_GET['action'] == 'input') {
	include "tambah_kategori.php";
} else if ($_GET['action'] == 'view') {
?>
	<section class="content">
		<div class="container-fluid">
			<!-- Small boxes (Stat box) -->
			<div class="row">
				<div class="col-lg-12">
					<div class="card">
						<div class="card-header">
							<h3 class="card-title">
								Data Kategori
							</h3>
						</div>
						<div class="card-body">
							<div class="row mb-4 ml-1">
								<a href="?page=kategori&action=input" class="btn btn-primary shadow"><i class="fa fa-plus"></i> Input kategori</a>
							</div>
							<div class="table-responsive-sm">
								<table id="example1" class="table table-bordered">
									<thead>
										<tr>
											<th>Kode kategori</th>
											<th>Kategori </th>
											<th>Margin</th>
											<th>Opsi</th>
										</tr>
									</thead>
									<tbody id="kategori">
										<?php
										$sql = mysql_query("SELECT * FROM kategori");
										$cek = mysql_num_rows($sql);
										if ($cek < 1) {
										?>
											<tr>
												<td colspan="7" class="p-3">Data tidak ditemukan</td>
											</tr>
											<?php
										} else {
											while ($data = mysql_fetch_array($sql)) {
											?>
												<tr>
													<td><?php echo $data['idkat']; ?></td>
													<td><?php echo $data['nmkat']; ?></td>
													<td><?php echo $data['persen']; ?></td>

													<td>
														<a href="?page=kategori&action=edit&id=<?php echo $data['idkat']; ?>">
															<button class="btn btn-success btn-xs shadow" title="Edit Data"><span class='fa fa-edit'></span></button>
														</a>
														<a onclick="return confirm('Yakin ingin menghapus data ?');" href="?page=kategori&action=hapus&id=<?php echo $data['idkat']; ?>">
															<button class='btn btn-danger btn-xs shadow' title='Delete Data'><span class='fa fa-trash-alt'></span></button>
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
			<!-- /.row -->
		</div><!-- /.container-fluid -->
	</section>

	<script>
		function cari() {
			var masukan = $("#pencariankategori").val();
			var tgl = $("#cari_kategori_dgn_tgl").val();
			$.ajax({
				data: 'masukanpencarian=' + masukan + '&tglpencarian=' + tgl,
				type: 'post',
				url: 'inc/proses_cari_kategori.php',
				success: function(msg) {
					$("tbody#kategori").html(msg);
				}
			});
		};

		$("#carikategori").click(function() {
			cari();
		});
		$("#pencariankategori").keyup(function(e) {
			if (e.keyCode == 13) {
				cari();
			}
		});
	</script>
<?php
} else if ($_GET['action'] == 'edit') {
	include "edit_kategori.php";
} else if ($_GET['action'] == "hapus") {
	include "delete_kategori.php";
}
?>