	<a href="?page=modal&action=input"><button class="btn btn-primary btn-sm">Input modal</button></a>
	<!--<a href="?page=modal&action=view"><button class="btn btn-success btn-sm">Lihat Data modal</button></a>-->
	<div style="margin-top:10px;">
		<?php
		if ($_GET['action'] == 'input') {
			include "tambah_modal.php";
		} else if ($_GET['action'] == 'view') {
		?>
			<title>Master modal</title>
			<fieldset class="utama">
				<legend>Data modal</legend>
				<?php

				?>


				<table id="example1" class="table table-bordered table-striped">
					<thead>
						<tr>
							<th>No</th>
							<th>Tanggal</th>
							<th>Kasir </th>
							<th>Modal</th>
							<th>Opsi</th>

						</tr>
					</thead>
					<tbody id="modal">
						<?php
						$sql = mysql_query("select * from tb_modal m,tb_user u where u.kode_user=m.id_user order by m.tgl desc") or die(mysql_error());
						$cek = mysql_num_rows($sql);
						if ($cek < 1) {
						?>
							<tr>
								<td colspan="7" style="padding:10px;">Data tidak ditemukan</td>
							</tr>
							<?php
						} else {
							$no = 1;
							while ($data = mysql_fetch_array($sql)) {
							?>
								<tr>
									<td><?php echo $no++; ?></td>
									<td><?php echo $data['tgl']; ?></td>
									<td><?php echo $data['nama_lengkap']; ?></td>
									<td><?php echo $data['modal']; ?></td>

									<td><a href="?page=modal&action=edit&id=<?php echo $data['id_modal']; ?>">
											<button class="btn btn-success btn-xs" title="Edit Data"><span class='glyphicon glyphicon-edit'></span></button></a>
										<a onclick="return confirm('Yakin ingin menghapus data ?');" href="?page=modal&action=hapus&id=<?php echo $data['id_modal']; ?>">
											<button class='btn btn-danger btn-xs' title='Delete Data'><span class='glyphicon glyphicon-remove'></span></button></a>
									</td>

								</tr>
						<?php
								$no++;
							}
						}
						?>
					</tbody>
				</table>
			</fieldset>
			<script>
				function cari() {
					var masukan = $("#pencarianmodal").val();
					var tgl = $("#cari_modal_dgn_tgl").val();
					$.ajax({
						data: 'masukanpencarian=' + masukan + '&tglpencarian=' + tgl,
						type: 'post',
						url: 'inc/proses_cari_modal.php',
						success: function(msg) {
							$("tbody#modal").html(msg);
						}
					});
				};

				$("#carimodal").click(function() {
					cari();
				});
				$("#pencarianmodal").keyup(function(e) {
					if (e.keyCode == 13) {
						cari();
					}
				});
			</script>
		<?php
		} else if ($_GET['action'] == 'edit') {
			include "edit_modal.php";
		} else if ($_GET['action'] == "hapus") {
			include "delete_modal.php";
		}
		?>
	</div>