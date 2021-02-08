<?php
if (isset($_GET['kode_barang'])) {
	$_SESSION['kode_barang_terpilih'] = $_GET['kode_barang'];
} else {
	if (!isset($_SESSION['kode_barang_terpilih'])) {
		//echo "<script>window.location='?page=satuan&action=view';</script>";
	}
}

$id_brg = $_SESSION['kode_barang_terpilih'];
$sql2 = mysql_query("select * from tb_satuan where kode_barang = '$id_brg' ") or die(mysql_error());
$no = 1;
?>

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
							Lihat Data Satuan
						</h3>
					</div>
					<div class="card-body">
						<a href="?page=input_satuan" class=""><button class="btn btn-primary shadow">Input Data Satuan</button></a>
						<a href="?page=data_satuan" class=""><button class="btn btn-warning shadow">Lihat Data</button></a>

						<div class="container mt-4">
							<table id="example1" class="table table-bordered">
								<thead>
									<tr>
										<th>No</th>
										<th>Nama Satuan</th>
										<th>Harga Satuan</th>
										<th>Opsi</th>
									</tr>
								</thead>
								<?php
								while ($data = mysql_fetch_array($sql2)) {
								?>
									<tbody>
										<tr>
											<td><?php echo $no++; ?></td>
											<td><?php echo $data['nama_satuan']; ?></td>
											<td><?php echo $data['harga_satuan']; ?></td>

											<td><a href="?page=edit_satuan&id=<?php echo $data['id_satuan']; ?>">
													<button class="btn btn-success btn-xs" title="Edit Data"><span class='fa fa-edit'></span></button></a>
												<a onclick="return confirm('Yakin ingin menghapus data ?');" href="?page=hapus_satuan&id=<?php echo $data['id_satuan']; ?>">
													<button class='btn btn-danger btn-xs' title='Delete Data'><span class='fa fa-trash-alt'></span></button></a>
											</td>

										</tr>
									</tbody>
								<?php }	?>
							</table>
						</div>
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
		$("#hb").number(true, 2);
		$("#hj").number(true, 2);
		$("#hj3").number(true, 2);
		$("#hj5").number(true, 2);
		$("#hj7").number(true, 2);
		$("#min_hg").number(true, 0);
		$("#hg").number(true, 2);

		$("#dari").number(true, 0);
		$("#sampai").number(true, 0);
		$("#hglevel").number(true, 2);

		$("#isi").load("inc/isi_level.php?kode=<?php echo "$_GET[id]"; ?>");
	});
	$("#hb").keyup(function() {
		$("#hb2").val($("#hb").val());
	});
	$("#hj").keyup(function() {
		$("#hj2").val($("#hj").val());
	});
	$("#hj3").keyup(function() {
		$("#hj4").val($("#hj3").val());
	});
	$("#hj5").keyup(function() {
		$("#hj6").val($("#hj5").val());
	});
	$("#hj7").keyup(function() {
		$("#hj8").val($("#hj7").val());
	});
	$("#min_hg").keyup(function() {
		$("#min_hg2").val($("#min_hg").val());
	});
	$("#hg").keyup(function() {
		$("#hg2").val($("#hg").val());
	});
	$("#hglevel").keyup(function() {
		$("#hglevel2").val($("#hglevel").val());
	});

	$("#tambahlevel").click(function() {
		var kd_brg = $("#kd_brg").val();
		var dari = $("#dari").val();
		var sampai = $("#sampai").val();
		var hglevel = $("#hglevel").val();
		if (dari == '') {
			alert("dari tidak boleh kosong");
			$("#dari").focus();
		} else if (sampai == '') {
			alert("sampai tidak boleh kosong");
			$("#sampai").focus();
		} else if (hglevel == '') {
			alert("harga level tidak boleh kosong");
			$("#hglevel").focus();
		} else {
			$.ajax({
				type: 'post',
				url: 'inc/proses_tambah_level.php',
				data: 'dari=' + dari + '&sampai=' + sampai + '&hglevel=' + hglevel + '&kd_brg=' + kd_brg,
				success: function(msg) {
					$("#hasil_edit").html(msg);
				}
			});
		}
	});
</script>

<div id="hasil_edit"></div>