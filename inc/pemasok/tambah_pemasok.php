<section class="content">
	<div class="container-fluid">
		<!-- Small boxes (Stat box) -->
		<div class="row">
			<div class="col-lg-12">
				<div class="card">
					<div class="card-header">
						<h3 class="card-title">
							Tambah Pemasok
						</h3>
					</div>
					<form action='inc/pemasok/proses_tambah_pemasok.php' method='post'>
						<div class="card-body">
							<div class="form-group row">
								<label for="inputPassword3" class="col-sm-2 col-form-label">Nama Supplier</label>
								<div class="col-sm-10">
									<input class="form-control" type="text" name="nm" id="nm" />
								</div>
							</div>

							<div class="form-group row">
								<label for="inputPassword3" class="col-sm-2 col-form-label">Sales</label>
								<div class="col-sm-10">
									<input class="form-control" type="text" name="sales" id="sales" />
								</div>
							</div>

							<div class="form-group row">
								<label for="inputPassword3" class="col-sm-2 col-form-label">No.Telp Sales</label>
								<div class="col-sm-10">
									<input class="form-control" type="text" name="nosales" id="nosales" />
								</div>
							</div>


							<div class="form-group row">
								<label for="inputPassword3" class="col-sm-2 col-form-label">Alamat</label>
								<div class="col-sm-10">
									<textarea id="alamat" name="alamat" class="form-control"></textarea>
								</div>
							</div>


							<div class="form-group row">
								<label for="inputPassword3" class="col-sm-2 col-form-label">No.Telp Supplier</label>
								<div class="col-sm-10">
									<input class="form-control" type="text" name="nohp" id="nohp" />
								</div>
							</div>
						</div>
						<div class="card-footer">
							<button id="tambah" class="btn btn-primary">Simpan</button>
							<a href="index.php?page=pemasok&action=view" class="btn btn-default float-right">Cancel</a>
						</div>
					</form>
				</div>
			</div>
		</div>
		<!-- /.row -->
	</div><!-- /.container-fluid -->
</section>