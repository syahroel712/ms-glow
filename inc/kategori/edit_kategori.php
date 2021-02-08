<?php
$id = $_GET['id'];
$sql = mysql_query("SELECT * from kategori where idkat = '$id'");
$data = mysql_fetch_array($sql);
?>

<section class="content">
	<div class="container-fluid">
		<!-- Small boxes (Stat box) -->
		<div class="row">
			<div class="col-lg-12">
				<div class="card">
					<div class="card-header">
						<h3 class="card-title">
							Edit Kategori ( <b> <?= $data['nmkat'] ?> </b> )
						</h3>
					</div>
					<form action='inc/kategori/proses_edit_kategori.php' method='post'>
						<div class="card-body">
							<div class="form-group row">
								<label class="col-sm-2 col-form-label">ID Kategori</label>
								<div class="col-sm-10">
									<input class="form-control" type="text" readonly=readonly name="id" value="<?php echo $_GET['id']; ?>" />
								</div>
							</div>

							<div class="form-group row">
								<label class="col-sm-2 col-form-label">Kategori</label>
								<div class="col-sm-10">
									<input class="form-control" type="text" name="nm" value="<?php echo $data['nmkat']; ?>" />
								</div>
							</div>

							<div class="form-group row">
								<label class="col-sm-2 col-form-label">Margin</label>
								<div class="col-sm-10">
									<input class="form-control" type="text" name="nohp" value="<?php echo $data['persen']; ?>" />
								</div>
							</div>
						</div>
						<div class="card-footer">
							<button type='submit' id="edit" class="btn btn-primary">Simpan</button>
							<a href="index.php?page=kategori&action=view" class="btn btn-default float-right">Cancel</a>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</section>


<script>
	$("#edit").click(function() {
		var nm = $("#nm").val();
		var jns = $("#jns").val();

		var alamat = $("#alamat").val();
		var nohp = $("#nohp").val();

		if (nm == '') {
			alert("Nama Lengkap tidak boleh kosong");
			$("#nm").focus();
		} else if (user == '') {
			alert("Perusahaan tidak boleh kosong");
			$("#user").focus();

		} else {
			$.ajax({
				type: 'post',
				url: 'inc/proses_edit_kategori.php',
				data: 'nm=' + nm + '&alamat=' + alamat + '&nohp=' + nohp + '&id=<?php echo $id; ?>',
				success: function(msg) {
					$("#hasil_edit").html(msg);
				}
			});
		}
	});
</script>

<div id="hasil_edit"></div>