<div class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1 class="m-0 text-dark">Satuan</h1>
			</div><!-- /.col -->
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="#">Home</a></li>
					<li class="breadcrumb-item active">Satuan</li>
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
							Input Data Satuan
						</h3>
					</div>
					<div class="card-body">
						<table class='table'>
							<form action="?page=proses_tambah_satuan" method="POST" enctype="multipart/form-data">
								<tr>
									<td>Kode Barang</td>
									<td>:</td>
									<td><input class='form-control' disabled="disabled" type="text" id="kode_barang" name="kode_barang" class='form-control' value='<?php echo $_SESSION['kode_barang_terpilih']; ?>' </td> </tr> <tr>
									<td>Nama satuan</td>
									<td>:</td>
									<td><input class='form-control' name="nama_satuan" type="text" id="nama_satuan" /></td>
								</tr>
								<tr>
									<td>Harga satuan</td>
									<td>:</td>
									<td><input class='form-control' name="harga_satuan" type="text" id="harga_satuan" /></td>
								</tr>
								<tr>
									<td>Konversi Stok</td>
									<td>:</td>
									<td><input class='form-control' name="konversi_stok" type="text" id="konversi_stok" /></td>
								</tr>
								<tr>
									<td></td>
									<td></td>
									<td><button id="tambah" class="btn btn-primary">Tambah</button></td>
								</tr>
							</form>
						</table>

					</div>
				</div>
			</div>
		</div>
		<!-- /.row -->
	</div><!-- /.container-fluid -->
</section>


<div id="hasil"></div>
<script src="./jquery.js"></script>
<script src="./jquery-ui.js"></script>
<script src="./jquery-number.js"></script>
<script type="text/javascript">
	$(window).load(function() {
		$("#kd_brg").focus();
		$("#hb").number(true, 2);
		$("#hj").number(true, 2);
		$("#hj2").number(true, 2);
		$("#hj3").number(true, 2);
		$("#hj4").number(true, 2);
		$("#min_hg").number(true, 0);
		$("#hg").number(true, 2);

		//$("#dari").number(true, 2);
		//$("#sampai").number(true, 2);

		//$("#isi").load("inc/isi_level.php");
	});
</script>