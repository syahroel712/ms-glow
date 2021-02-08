<?php
$tanggal = date('Y-m-d');
$sekarang = date('ymd');

if (@$_SESSION['admin']) {
	$kode_user = @$_SESSION['admin'];
} else if (@$_SESSION['kasir']) {
	$kode_user = @$_SESSION['kasir'];
}

$nota = @$_GET['nota'];
$sql2 = mysql_query("select * from tb_penjualan where no_nota='$nota'") or die(mysql_error());
$data2 = mysql_fetch_array($sql2);
//hapus item tmp
?>

<div class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1 class="m-0 text-dark">Penjualan</h1>
			</div><!-- /.col -->
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="#">Home</a></li>
					<li class="breadcrumb-item active">Transaksi Penjualan</li>
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
						<h3 class="card-title">Transaksi Jual (<span class="text-bold" id="kasir"><?php echo $data2['no_nota']; ?></span>)</h3>
					</div>
					<div class="card-body">
						<div class="row">
							<div class="col-lg-4">
								<form class="form-horizontal">
									<div class="card-body">
										<div class="form-group row">
											<label for="nonota" class="col-sm-4 col-form-label">No Nota</label>
											<div class="col-sm-8">
												<input class="form-control" type="text" id="nonota" value="<?php echo "$data2[no_nota]"; ?>" disabled="disabled" />
											</div>
										</div>
										<div class="form-group row">
											<label for="tgljual" class="col-sm-4 col-form-label">Tanggal</label>
											<div class="col-sm-8">
												<input class="form-control" type="date" id="tgljual" value="<?php echo $tanggal; ?>" />
											</div>
										</div>
										<div class="form-group row">
											<label for="pelanggan" class="col-sm-4 col-form-label">Pelanggan</label>
											<div class="col-sm-8">
												<input class="form-control" type="text" id="pelanggan" value="<?php echo $data2['pelanggan'] ?>" />
											</div>
										</div>
										<div class="form-group clearfix">
											<div class="icheck-primary d-inline">
												<input type="checkbox" name="manual" id="manual" value="Y" checked>
												<label for="manual">
													Input Manual
												</label>
											</div>
											<div class="icheck-primary d-inline">
												<input type="checkbox" name="print-struk" id="print-struk" checked value="Y">
												<label for="print-struk">
													Print Struk
												</label>
											</div>

											<!-- <input type="checkbox" checked name="manual" id="manual" value="Y" /> Input Manual
												<input type="checkbox" checked name="print-struk" id="print-struk" value="Y" /> Print Struk -->
										</div>
									</div>
								</form>
							</div>
						</div>

						<div class="row">
							<div class="table-responsive-sm">
								<table class="table table-condensed">
									<thead>
										<tr>
											<td>Kode Barang</td>
											<td>Nama Barang</td>
											<td>Stok</td>
											<td>Qty</td>
											<td></td>
										</tr>
									</thead>

									<tbody>
										<tr>
											<form action="" method="post" enctype="multipart/form-data">
												<td><input type="text" name="kodebarang" placeholder="Kode Barang" id="kodebarang" class="form-control" /></td>
												<td><input class="form-control" type="text" name="namabarang" id="namabarang" placeholder="nama" onkeyup="suggest(this.value);" />
													<div id="suggest"></div>
												</td>
												<td><input class="form-control" type="text" id="stokbarang" placeholder="stok" disabled="disabled" /></td>
												<input class="form-control" type="hidden" name="hargabeli" id="hargabeli" placeholder="beli" />
												<input class="form-control" type="hidden" name="hargasatuan" id="hargasatuan" placeholder="beli" />

												<input class="form-control" type="hidden" id="hargabarang" style="width:100px;" placeholder="harga" disabled="disabled" />

												<td><input class="form-control" type="text" name="jumlahjual" id="jumlahjual" placeholder="qty" style="width:50px;" value="1" readonly /></td>

												<input class="form-control" type="hidden" name="hargaakhir" id="hargaakhir" style="width:100px;" value="0" placeholder="sub total" />
												<td>
													<button type="submit" name="save" value="simpan" class="btn btn-primary btn-sm">Simpan Item</button>
												</td>
											</form>
										</tr>
									</tbody>
								</table>
							</div>
						</div>

						<div class="container">
							<div class="table-responsive-sm">
								<table class="table table-bordered table-striped" id="barang_dijual">
									<thead>
										<tr>
											<th>
												<center>No</center>
											</th>
											<th>
												<center>Kode Barang</center>
											</th>
											<th>
												<center>Nama Barang</center>
											</th>
											<th colspan="2">
												<center>Harga Satuan</center>
											</th>
											<th>
												<center>Qty</center>
											</th>
											<th colspan="2">
												<center>Harga Akhir</center>
											</th>
										</tr>
									</thead>
									<tbody>
										<?php
										$sql5 = mysql_query("select * from tb_barang_terjual where no_nota='$_GET[nota]'") or die(mysql_error());
										$cek = mysql_num_rows($sql5);
										if ($cek < 1) {
										?><tr>
												<td colspan="13" style="padding:10px;">Data tidak ditemukan</td>
											</tr><?php
													} else {


														$no = 1;
														while ($data5 = mysql_fetch_array($sql5)) {
														?><tr>
													<td><?php echo "$no"; ?></td>
													<td><?php echo $data5['kode_barang']; ?></td>
													<td><?php echo $data5['nama_barang']; ?></td>
													<td align="right" style="border-left:0;"><?php echo number_format($data5['modal'], 0, ".", ","); ?></td>
													<td align="right" style="border-left:0;"><?php echo number_format($data5['harga_satuan'], 0, ".", ","); ?></td>
													<td align="right" style="border-left:0;"><?php echo number_format($data5['jumlah_jual'], 0, ".", ","); ?></td>
													<td align="right" style="border-left:0;"><?php echo number_format($data5['harga_akhir'], 0, ".", ","); ?></td>
												</tr><?php
															$no++;
														}
													} ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- /.row -->
	</div><!-- /.container-fluid -->
</section>


<?php
if (@$_POST['save'] == "simpan") {
	$nota = $_GET['nota'];
	$kd_brg = $_POST['kodebarang'];
	$namabarang = $_POST['namabarang'];
	$hargabeli = @mysql_real_escape_string($_POST['hargabeli']);
	$hargasatuan = @mysql_real_escape_string($_POST['hargasatuan']);
	$jumlahjual = @mysql_real_escape_string($_POST['jumlahjual']);
	$hargaakhir = $hargasatuan * $jumlahjual;
	// var_dump($jumlahjual);

	$save = mysql_query("INSERT INTO tb_barang_terjual(kode_barang, nama_barang,modal, harga_satuan, jumlah_jual, harga_akhir, no_nota) values('" . $kd_brg . "', '" . $namabarang . "','" . $hargabeli . "','" . $hargasatuan . "','" . $jumlahjual . "','" . $hargaakhir . "','" . $nota . "') ");
	if ($save) {
		echo "<script>
							alert('Tambah Data Berhasil');
							window.location='?page=penjualan&action=view&no=$nota';
							</script>";
		exit;
	} else {
		echo "<script>alert('Gagal');
							</script>";
	}
}
?>

<div id="hasil"></div>
<script src="prmajax.js"></script>
<script>
	$("#manual").click(function() {
		if ($("#manual:checked").val()) {
			document.getElementById("jumlahjual").disabled = '';
			$("#jumlahjual").val("");
			$("#kodebarang").focus();
		} else {
			document.getElementById("jumlahjual").disabled = 'true';
			$("#jumlahjual").val(1);
			$("#kodebarang").focus();
		}
	});
	$("#print-struk").click(function() {
		$("#kodebarang").focus();
	});

	$("#kdbarang").keyup(function() {


				$("#simpan").click(function() {
					var bayar = parseInt($("#bayar").val());
					var tot = parseInt($("#totalharga").val());
					var kembalian = $("#kembalian").val(bayar - $("#totalharga").val()).number(true, 0);
					//if(bayar < tot){
					//	alert('Bayar harus >= Total Harga');
					//}else
					{
						//$("#simpan").disabled=true;
						//}
						var ke = $('#barang_dijual tr').length;

						var nonota = $("#nonota").val();
						var tgljual = $("#tgljual").val();
						var pelanggan = $("#pelanggan").val();
						var jns = $("#jns").val();
						var kasir = $("#kasir").text();
						var subtotal = $("#subtotal").val();
						var diskonpersen = $("#persen").val();
						var diskonharga = $("#diskonharga").val();
						var totalharga = $("#totalharga").val();
						var bayar = $("#bayar").val();
						var kembalian = $("#kembalian").val();
						var jenis_pelanggan = $("#jenis_pelanggan").val();
						var kode_user = <?php echo "$kode_user"; ?>;
						if (nonota == "") {
							alert("No. Nota tidak boleh kosong");
							$("#nonota").focus();
						} else if (pelanggan == "") {
							alert("Pelanggan tidak boleh kosong");
							$("#pelanggan").focus();
						} else if (tgljual == "") {
							alert("Tanggal jual tidak boleh kosong");
							$("#tgljual").focus();
						} else if (ke == 1) {
							alert("Belum ada barang yang dijual di dalam daftar");
						} else if (totalharga == "") {
							alert("Total harga tidak boleh kosong");
							$("#totalharga").focus();
						} else if (bayar == "") {
							alert("Uang pembayaran kosong");
							$("#bayar").focus();
						} else {
							$.ajax({
								url: 'inc/proses_simpan_penjualan.php',
								data: 'nonota=' + nonota + '&tgljual=' + tgljual + '&pelanggan=' + pelanggan + '&jns=' + jns + '&kasir=' + kasir + '&subtotal=' + subtotal + '&diskonpersen=' + diskonpersen + '&diskonharga=' + diskonharga + '&totalharga=' + totalharga + '&bayar=' + bayar + '&kembalian=' + kembalian + '&jenis_pelanggan=' + jenis_pelanggan + '&kode_user=' + kode_user,
								type: 'POST',
								success: function(msg) {
									$("#hasil").html(msg);
								}
							});


							for (var i = 1; i < ke; i++) {
								var kodebarang = $("#kodebarang-" + i).text();
								var namabarang = $("#namabarang-" + i).text();
								var hargasatuan = $("#hargasatuan-" + i).text();
								var jumlahjual = $("#jumlahjual-" + i).text();
								var hargaakhir = $("#hargaakhir-" + i).text();
								$.ajax({
									url: 'inc/proses_simpan_barang_terjual.php',
									type: 'post',
									data: 'kodebarang=' + kodebarang + '&namabarang=' + namabarang + '&jumlahjual=' + jumlahjual + '&hargasatuan=' + hargasatuan + '&hargaakhir=' + hargaakhir + '&nonota=' + nonota,
									success: function(msg) {
										$("#hasil").html(msg);
									}
								});
							}

							alert("Penjualan telah tersimpan");
							window.location.href = "?page=penjualan&action=input";
							if ($("#print-struk:checked").val()) {
								window.open("cetak_struk_baru.php?id=<?php echo "$hasilkode"; ?>", "Struk Pembelian", "height=700,width=700,scrollbars=yes");
							}
						}

					}
				});

				$("#kodebarang").keyup(function(e) {
					var kodebarang = $("#kodebarang").val();
					$.ajax({
						url: 'inc/cari_barang_penjualan.php',
						type: 'post',
						data: 'kodebarang=' + kodebarang,
						success: function(msg) {
							$("#hasil").html(msg);
						}
					});

					if (e.keyCode == 13) {
						//document.body.scrollTop = document.body.scrollHeight;
						window.scrollBy(0, 300);
						if ($("#manual:checked").val()) {
							$("#jumlahjual").focus();
						} else {
							$("#simpanitem").click();
							//$("#namabarang").val("");
							//$("#batalitem").click();
							//alert("tes");
							//$("#kodebarang").val("");
							//$("#namabarang").val("");
							//$("#kodebarang").focus();
						}

					}
					if (e.keyCode == 40) {
						//document.body.scrollTop = document.body.scrollHeight;
						window.scrollBy(0, 400);
						//$("#jumlahjual").focus();
						$("#bayar").focus();
					}

				});

				$("#simpanitem").click(function() {
					var kodebarang = $("#kodebarang").val();
					var hargabeli = $("#hargabeli").val();
					var jumlahjual = $("#jumlahjual").val();
					if (kodebarang == "") {
						alert("Kode barang kosong");
						$("#kodebarang").focus();
					} else if (jumlahjual == "") {
						alert("Jumlah Jual kosong");
						$("#jumlahjual").focus();
					} else {
						var kodebarang = $("#kodebarang").val();
						$.ajax({
							url: 'inc/simpan_tmp_jual.php',
							type: 'post',
							data: 'kodebarang=' + kodebarang + '&jumlahjual=' + jumlahjual,
							success: function(msg) {
								$("#hasil").html(msg);
							}
						});
					}

				});

				$("#barang_dijual").on("click", ".hapus", function() {
					$(event.target).closest("tr").remove();

					var ha_tbl = 0;
					$(".harga-akhir-tabel").each(function(index, element) {
						ha_tbl += parseInt($(element).text());
					});
					$("#subtotal").val(ha_tbl).number(true, 0) - $(this).attr("ha");

					$("#totalharga").val($("#subtotal").val()).number(true, 0);
					$("#tagihan").text($("#subtotal").val()).number(true, 0);
				});

				$("#jumlahjual").keyup(function(e) {
					var hargabarang = $("#hargabarang").val();
					var stok = parseInt($("#stokbarang").val());
					var hargabeli = parseInt($("#hargabeli").val());
					var jumlahjual = parseInt($(this).val());


					$("#hargaakhir").val(hargabarang * jumlahjual).number(true, 0);
					if (e.keyCode == 13) {
						if (jumlahjual <= 0 || jumlahjual == "") {
							alert('Jumlah jual tidak boleh kosong');
						} else {
							$("#simpanitem").click();
							//$("#batalitem").click();
							$("#jumlahjual").val("");
							//$("#kodebarang").focus();
						}
					}
				});

				$("#persen").keyup(function() {
					var diskonpersen = $(this).val();
					var subtotal = $("#subtotal").val();
					$("#diskonharga").val(subtotal * diskonpersen / 100);

					var diskonharga = $("#diskonharga").val();
					$("#totalharga").val(subtotal - diskonharga);
					$("#tagihan").text(subtotal - diskonharga).number(true, 0);
				});

				$("#diskonharga").keyup(function() {
					var diskonharga = $(this).val();
					var subtotal = $("#subtotal").val();
					$("#persen").val(diskonharga / subtotal * 100);

					$("#totalharga").val(subtotal - diskonharga);
					$("#tagihan").text(subtotal - diskonharga).number(true, 0);
				});

				$("#bayar").keyup(function(e) {
					var bayar = parseInt($(this).val());
					var tot = parseInt($("#totalharga").val());
					var kembalian = $("#kembalian").val(bayar - $("#totalharga").val()).number(true, 0);
					$("#kemb").text(bayar - $("#totalharga").val()).number(true, 0);
					if (bayar >= tot) {
						$("#simpan").disabled = "";
					} else {
						$("#simpan").disabled = true;
					}
					if (e.keyCode == 13) {
						if (bayar >= tot) {
							$("#simpan").focus();
						} else {
							alert("Bayar harus >= Total Transaksi");
						}
					}
				});

				$("#batal").click(function() {
					$("#kodebarang").val("");
					$("#namabarang").val("");
					$("#stokbarang").val("");
					$("#hargabeli").val("");
					$("#hargabarang").val("");
					//$("#jumlahjual").val("");
					$("#hargaakhir").val("0");

					$("#barang_dijual td").parent().remove();

					$("#subtotal").val("");
					$("#totalharga").val("");
					$("#tagihan").text("0");

					$("#pelanggan").val("");
					$("#persen").val("");
					$("#diskonharga").val("");
					$("#bayar").val("");
					$("#kembalian").val("");
				});
</script>