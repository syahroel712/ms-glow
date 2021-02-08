<?php
$carikode = mysql_query("SELECT max(idkat) from kategori") or die(mysql_error());
$datakode = mysql_fetch_row($carikode);
if ($datakode) {
	$nilaikode = substr($datakode[0], 2);
	$kode = (int) $nilaikode;
	$kode = $kode + 1;
	$hasilkode = $sekarang . str_pad($kode, 3, "0", STR_PAD_LEFT);
} else {
	$hasilkode = $sekarang . "001";
}
?>

<section class="content">
	<div class="container-fluid">
		<!-- Small boxes (Stat box) -->
		<div class="row">
			<div class="col-lg-12">
				<div class="card">
					<div class="card-header">
						<h3 class="card-title">
							Tambah Kategori
						</h3>
					</div>

					<div class="card-body">
						<div class="form-group row">
							<label for="kode" class="col-sm-2 col-form-label">Kode kategori</label>
							<div class="col-sm-10">
								<input class="form-control" type="text" value="<?php echo "$hasilkode"; ?>" id="kode" />
							</div>
						</div>
						<div class="form-group row">
							<label for="nm" class="col-sm-2 col-form-label">Kategori</label>
							<div class="col-sm-10">
								<input class="form-control" type="text" id="nm" />
							</div>
						</div>
						<div class="form-group row">
							<label for="persen" class="col-sm-2 col-form-label">Margin <i>%</i></label>
							<div class="col-sm-10">
								<input class="form-control" type="text" id="persen" width="170" />
							</div>
						</div>
					</div>
					<!-- /.card-body -->
					<div class="card-footer">
						<button id="tambah" class="btn btn-primary">Simpan</button>
						<a href="index.php?page=kategori&action=view" class="btn btn-default float-right">Cancel</a>
					</div>
					<!-- /.card-footer -->

				</div>
			</div>
		</div>
		<!-- /.row -->
	</div><!-- /.container-fluid -->
</section>

<script>
	$("#tambah").click(function() {
		var nm = $("#nm").val();
		var jns = $("#kode").val();
		var alamat = $("#persen").val();
		var nohp = $("#nohp").val();

		if (nm == '') {
			alert("Nama Lengkap tidak boleh kosong");
			$("#nm").focus();
		} else {
			$.ajax({
				type: 'post',
				url: 'inc/kategori/proses_tambah_kategori.php',
				data: 'nm=' + nm + '&jns=' + jns + '&alamat=' + alamat + '&nohp=' + nohp,
				success: function(msg) {
					$("#hasil_tambah").html(msg);
				}
			});
		}
	});
</script>

<div id="hasil_tambah"></div>