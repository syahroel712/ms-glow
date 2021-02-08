<div class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h2 class="m-0 text-dark">Member</h2>
			</div><!-- /.col -->
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="#">Home</a></li>
					<li class="breadcrumb-item active">Member</li>
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
							Data Member
						</h3>
					</div>
					<div class="card-body">

						<a href="?page=member&action=input"><button class="btn btn-primary btn-sm">Input member</button></a>

						<a href="?page=member&action=view"><button class="btn btn-success btn-sm">Lihat Data member</button></a>

						<a href="inc/export_member.php"><button class="btn btn-warning btn-sm"><i class="fa fa-file-excel"></i> Export Data</button></a>

						<?php

						if (isset($_POST['simpandc'])) {

							mysql_query("update diskon set dc='$_POST[diskon]'");
						}

						$dc = mysql_fetch_array(mysql_query("select * from diskon"));

						?>
						<br>
						<br>
						<form action='' method='post'>

							<table>

								<tr>

									<td>

										Diskon

									</td>

									<td>

										<input name='diskon' type='type' value='<?php echo "$dc[dc]"; ?>' placeholder='Diskon Persen' /> &nbsp;

									</td>

									<td>

										<input type='submit' class='btn btn-info' name='simpandc' value='Simpan' />

									</td>

								</tr>

							</table>

						</form>

						<div style="margin-top:10px;">

							<?php

							if (@$_GET['action'] == 'input') {

								include "tambah_member.php";
							} else if (@$_GET['action'] == 'view') {

							?>

								<title>Master member</title>

								<fieldset class="utama">


									<?php



									?>



									<table id="example1" class="table table-bordered table-striped table-responsive">

										<thead>

											<tr>

												<th>Kode member</th>

												<th>Nama Lengkap </th>

												<th>Jenis Kelamin</th>

												<th>No.Telp</th>

												<th>Email</th>

												<th>Tanggal Lahir</th>

												<th>Kota</th>

												<th>Tgl Daftar</th>

												<!--<th>Tgl Diperpanjang</th>-->



												<th>Opsi</th>



											</tr>

										</thead>

										<tbody id="member">

											<?php

											$sql = mysql_query("select * from tb_member") or die(mysql_error());

											$cek = mysql_num_rows($sql);

											if ($cek < 1) {

											?>

												<tr>

													<td colspan="8" style="padding:10px;">Data tidak ditemukan</td>

												</tr>

												<?php

											} else {

												while ($data = mysql_fetch_array($sql)) {

												?>

													<tr>

														<td><?php echo $data['id_member']; ?></td>

														<td><?php echo $data['nm']; ?></td>

														<td><?php echo $data['jk']; ?></td>



														<td><?php echo "$data[notelp]"; ?></td>

														<td><?php echo $data['email']; ?></td>
														<td><?php echo $data['tgl_lahir']; ?></td>
														<td><?php echo $data['kota']; ?></td>

														<td><?php echo $data['tgl_daftar']; ?></td>

														<!--<td><?php echo $data['tgl_diperbarui']; ?></td>-->



														<td><a href="?page=member&action=edit&id=<?php echo $data['id_member']; ?>">

																<button class="btn btn-success btn-xs shadow" title="Edit Data"><span class='fa fa-edit'></span></button></a>

															<a target="_blank" onclick="return confirm('Kirim Pesan Ucapan?');" href="https://wa.me/<?php echo $data['notelp']; ?>?text=Assalamu'alaikum">

																<button class='btn btn-warning btn-xs shadow' title='Kirim Pesan WA'><span class='fa fa-envelope-open'></span></button></a>

															<a onclick="return confirm('Yakin ingin menghapus data ?');" href="?page=member&action=hapus&id=<?php echo $data['id_member']; ?>">

																<button class='btn btn-danger btn-xs shadow' title='Delete Data'><span class='fa fa-trash-alt'></span></button></a>

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
</section>
</fieldset>

<script>
	function cari() {

		var masukan = $("#pencarianmember").val();

		var tgl = $("#cari_member_dgn_tgl").val();

		$.ajax({

			data: 'masukanpencarian=' + masukan + '&tglpencarian=' + tgl,

			type: 'post',

			url: 'inc/member/proses_cari_member.php',

			success: function(msg) {

				$("tbody#member").html(msg);

			}

		});

	};



	$("#carimember").click(function() {

		cari();

	});

	$("#pencarianmember").keyup(function(e) {

		if (e.keyCode == 13) {

			cari();

		}

	});
</script>

<?php

							} else if (@$_GET['action'] == 'edit') {

								include "edit_member.php";
							} else if (@$_GET['action'] == "hapus") {

								include "delete_member.php";
							}

?>

</div>