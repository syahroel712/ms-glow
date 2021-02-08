<section class="content">
	<div class="container-fluid">
		<!-- Small boxes (Stat box) -->
		<div class="row">
			<div class="col-lg-12">
				<div class="card">

					<div class="card-header">
						<h3 class="card-title">
							Input Data Pengeluaran
						</h3>
					</div>
					<div class="card-body">
						<form method="post" action="inc/kas/proses_tambah_kas.php" class="form-horizontal">
							<div class="form-group row">
								<label for="kd_brg" class="col-md-2">Tanggal</label>
								<div class="col-md-4">
									<input type="date" name="kd_brg" id="kd_brg" placeholder="yyyy-mm-dd" class="form-control" />
								</div>
							</div>

							<div class="form-group row">
								<label for="nm_brg" class="col-md-2">Keterangan</label>
								<div class="col-md-4">
									<input type="text" name="nm_brg" id="nm_brg" class="form-control" />
								</div>
							</div>

							<input type="hidden" name="jenis" id="jenis" value="Pengeluaran" readonly="" />

							<div class="form-group row">
								<label for="hb" class="col-md-2">Pengeluaran</label>
								<div class="col-md-4">
									<i>Rp. </i>
									<input type="text" id="hb" class="form-control" />
									<input type="hidden" name="hb" id="hb2" class="form-control" />
								</div>
							</div>

							<div class="form-group">
								<div class="col-md-4 offset-md-2">
									<input name="tambah" type="submit" value="Simpan" class="btn btn-primary" />
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

<script>
	$(function() {
		$("#hb").number(true, 0);
	});
	$("#hb").keyup(function() {
		$("#hb2").val($("#hb").val());
	});
</script>