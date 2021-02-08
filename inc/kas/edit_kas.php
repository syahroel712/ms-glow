<?php
$id = $_GET['id'];
$sql = mysql_query("SELECT * FROM tb_kas WHERE idkas = '$id'");
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
							Edit Data kas
						</h3>
					</div>
					<div class="card-body">
						<form action='inc/kas/proses_edit_kas.php' method='post' class="form-horizontal">

							<div class="form-group row">
								<label for="kd_brg" class="col-md-2">Tanggal</label>
								<div class="col-md-4">
									<input class="form-control" type="text" name="id" value="<?php echo "$data[idkas]"; ?>" hidden=hidden />
									<input class="form-control" type="date" name="kd_brg" value="<?php echo "$data[tgl]"; ?>" placeholder="yyyy-mm-dd" />
								</div>
							</div>

							<div class="form-group row">
								<label for="kd_brg" class="col-md-2">Keterangan</label>
								<div class="col-md-4">
									<input class="form-control" type="text" name="nm_brg" value="<?php echo "$data[ket]"; ?>" />
								</div>
							</div>

							<div class="form-group row">
								<label for="kd_brg" class="col-md-2">Jenis</label>
								<div class="col-md-4">
									<select name="jenis" id="jenis" onchange="changetextbox();" class="form-control">
										<option value="" class="form-control">- Pilih -</option>
										<option name="Pengeluaran" class="form-control" <?php if ($data['jenis'] == "Pengeluaran") {
																																			echo "selected";
																																		} ?>>Pengeluaran</option>
										<option name="Pendapatan" class="form-control" <?php if ($data['jenis'] == "Pendapatan") {
																																			echo "selected";
																																		} ?>>Pendapatan</option>
									</select>
								</div>
							</div>

							<div class="form-group row">
								<label for="kd_brg" class="col-md-2">Debet</label>
								<div class="col-md-4">
									<i>Rp. </i><input class="form-control" type="text" name="hj" value="<?php echo "$data[debit]"; ?>" id="hj" />
								</div>
							</div>

							<div class="form-group row">
								<label for="kd_brg" class="col-md-2">Kredit</label>
								<div class="col-md-4">
									<i>Rp. </i><input class="form-control" type="text" name="hb" id="hb" value="<?php echo "$data[kredit]"; ?>" />
								</div>
							</div>

							<script>
								function changetextbox() {
									if (document.getElementById("jenis").value == "Pendapatan") {
										document.getElementById("hb").disabled = 'true';
										document.getElementById("hj").disabled = '';

									} else if (document.getElementById("jenis").value == "Pengeluaran") {
										document.getElementById("hj").disabled = 'true';
										document.getElementById("hb").disabled = '';
									} else {
										document.getElementById("hj").disabled = '';
										document.getElementById("hb").disabled = '';
									}
								}
							</script>

							<div class="form-group row">
								<div class="col-md-1 offset-md-2">
									<input class="form-control btn btn-primary" name="tambah" type="submit" value="Simpan" />
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		<!-- /.row -->
	</div><!-- /.container-fluid -->
</section>