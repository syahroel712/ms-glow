<?php
if ($_GET['action'] == 'view') {
	include "data_penjualan.php";
} else if ($_GET['action'] == 'input') {
	$tanggal = date('Y-m-d');
	$sekarang = date('ymd');

	if ($_SESSION['admin']) {
		$kode_user = $_SESSION['admin'];
	} else if ($_SESSION['kasir']) {
		$kode_user = $_SESSION['kasir'];
	}

	$thn_skr = date('Y');
	$bln_skr = date('m');
	$carikode = mysql_query("SELECT * FROM tb_penjualan WHERE id_user='$kode_user' AND YEAR(tgl_jual)='$thn_skr' AND MONTH(tgl_jual)='$bln_skr' ORDER BY tgl_jual DESC");
	$datakode = mysql_fetch_row($carikode);
	if ($datakode) {
		$tambah = 6 + strlen($kode_user);
		$nilaikode = substr($datakode[0], $tambah);
		$kode = (int) $nilaikode;
		$kode = $kode + 1;
		$hasilkode = $sekarang . $kode_user . str_pad($kode, 3, "0", STR_PAD_LEFT);
	} else {
		$hasilkode = $sekarang . $kode_user . "001";
	}

	//hapus item tmp
	mysql_query("DELETE FROM jual_tmp WHERE id_user='$kode_user'");

	$sql_user = mysql_query("SELECT * FROM tb_user WHERE kode_user = '$kode_user'");
	$data_user = mysql_fetch_array($sql_user);

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
							<h3 class="card-title">Transaksi Jual (<span class="text-bold" id="kasir"><?= $data_user['nama_lengkap']; ?></span>)</h3>
						</div>
						<div class="card-body">
							<div class="row">
								<div class="col-lg-4">
									<form class="form-horizontal">
										<div class="card-body">
											<div class="form-group row">
												<label for="nonota" class="col-sm-4 col-form-label">No Nota</label>
												<div class="col-sm-8">
													<input class="form-control" type="text" id="nonota" value="<?php echo "$hasilkode"; ?>" disabled="disabled" />
												</div>
											</div>
											<div class="form-group row">
												<label for="tgljual" class="col-sm-4 col-form-label">Tanggal</label>
												<div class="col-sm-8">
													<input class="form-control" type="date" id="tgljual" value="<?php echo $tanggal; ?>" />
												</div>
											</div>
											<!--<div class="form-group row">-->
											<!--	<label for="pelanggan" class="col-sm-4 col-form-label">Pelanggan</label>-->
											<!--	<div class="col-sm-8">-->
											<!--		<input class="form-control" type="text" value="Pelanggan" id="pelanggan" />-->
											<!--	</div>-->
											<!--</div>-->
											<div class="form-group clearfix">
												<div class="icheck-primary d-inline">
													<input type="checkbox" name="manual" id="manual" value="Y">
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
												<!--<td>Nama Satuan</td>-->
												<td>Harga Satuan <i>(Rp.)</i></td>
												<td>Qty</td>
												<td>DISC (Rp)</td>
												<td></td>
											</tr>
										</thead>

										<tbody>
											<tr>
												<td>
													<input type="text" name="kodebarang" placeholder="Kode Barang" id="kodebarang" class="form-control" />
												</td>
												<td>
													<input class="form-control" type="text" id="namabarang" placeholder="nama" onkeyup="suggest(this.value);" />
													<div id="suggest"></div>
													<input type="hidden" name="kp" id="kp" value="<?php echo $_GET['kp'] ?>">
													*ketikkan huruf awalan
												</td>
												<td>
													<input class="form-control" type="text" id="stokbarang" placeholder="stok" disabled="disabled" style="width:100px;" />
												</td>
												<!--<td>-->
												<!--	<select type="text" name="nama_satuan" id="nama_satuan" class="form-control">-->
												<!--	</select>-->
												<!--</td>-->
												<td><input class="form-control" name="harga_satuan" type="text" id="harga_satuan" style="width:100px;" readonly /></td>

												<td><input class="form-control" type="text" id="jumlahjual" placeholder="qty" style="width:50px;" value="1" disabled=disabled /></td>


												<input class="form-control" type="hidden" id="hargabarang" style="width:100px;" placeholder="harga" disabled="disabled" />

												<td>
													<input class="form-control" type="text" id="diskonharga" placeholder="Dscount" style="width:100px;" value="0" />
													<input class="form-control" type="hidden" id="disko" style="width:50px;" value="0" />
												</td>

												<input class="form-control" type="hidden" id="hargaakhir" style="width:100px;" value="0" placeholder="sub total" disabled="disabled" />
												<td>
													<button id="simpanitem" class="btn btn-primary btn-sm shadow">Simpan Item</button>
													<button class="btn btn-warning btn-sm shadow" id="batalitem">Batal Item</button>
													<button class="btn btn-danger btn-sm shadow" id="hapussemuaitem">Hapus Semua</button>
												</td>
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
												<th>No</th>
												<th>Kode Barang</th>
												<th>Nama Barang</th>
												<th colspan="2">Harga Satuan</th>
												<th>Qty</th>
												<th>DISC (Rp)</th>
												<th colspan="2">Harga Akhir</th>
												<th>Opsi</th>
											</tr>
										</thead>
										<tbody id="isi">

										</tbody>
									</table>
								</div>
							</div>

							<div class="row">
								<div class="col-lg-5">
									<input class="form-control" type="hidden" id="subtotal" disabled="disabled" />

									<div class="form-group row">
										<label class="col-md-4 col-form-label">Total Harga</label>
										<div class="col-sm-8">
											<input class="form-control" type="text" id="totalharga" disabled="disabled" />
										</div>
									</div>
									<!--member area -->
									<div class="form-group row">
										<label class="col-md-4 col-form-label">Kode Member</label>
										<div class="col-sm-8">
											<input class="form-control" type="text" id="kodemember" style="width:120px; margin-bottom: 15px;" />

											<input class="form-control" type="text" id="namamember" disabled=disabled style="margin-bottom: 15px;" />

											<input class="form-control" type="text" id="persen" value="0" style="width:50px; display: inline-block;" /> <span>%</span>
										</div>
									</div>
									<!-- end member area -->
									<div class="form-group row">
										<label class="col-md-4 col-form-label">Bayar</label>
										<div class="col-sm-8">
											<input class="form-control" type="text" id="bayar" />
										</div>
									</div>
									<div class="form-group row">
										<label class="col-md-4 col-form-label">Kembalian</label>
										<div class="col-sm-8">
											<input class="form-control" type="text" id="kembalian" disabled="disabled" />
										</div>
									</div>
									<div class="form-group row">
										<label class="col-md-4 col-form-label">Pembayaran</label>
										<div class="col-sm-8">
											<select name="pembayaran" id="pembayaran" class="form-control">
												<option value="">Pilih Metode Pembayaran</option>
												<option value="cash">Cash</option>
												<option value="transfer">Transfer</option>
												<option value="debit">Debit</option>
											</select>
										</div>
									</div>
									<div class="form-group row">
										<div class="col-md-8 offset-md-4">
											<button id="simpan" class="btn btn-primary mr-1 shadow">Simpan</button>
											<button class="btn btn-danger shadow" id="batal">Batal</button>
										</div>
									</div>
								</div>

								<div class="col-lg-7">
									<div class="card p-4">
										<div id="info" class="text-red" style="padding:10px; font-size:40px; font-weight:bold;">
											Tagihan : Rp. <span id="tagihan">0</span><br />
											Kembalian : Rp. <span id="kemb">0</span><br />
										</div>
									</div>
								</div>

							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- /.row -->
		</div><!-- /.container-fluid -->
	</section>

	<div id="hasil"></div>

	<script src="assets/js/suggest_penjualan.js"></script>
	<script>
		$(function() {
			$("#kodebarang").focus();
			$("#bayar").number(true, 0);
			$("#hargabarang").number(true, 0);
			$("#diskonharga").number(true, 0);

			$('#isi').load("inc/tmp_jual.php");
		});

		$("#manual").click(function() {
			if ($("#manual:checked").val()) {
				document.getElementById("jumlahjual").disabled = '';
				$("#jumlahjual").val(1);
				$("#diskonharga").val("");
				$("#kodebarang").focus();
			} else {
				document.getElementById("jumlahjual").disabled = 'true';
				$("#jumlahjual").val(1);
				$("#kodebarang").focus();
				$("#diskonharga").val("");
			}
		});

		$("#print-struk").click(function() {
			$("#kodebarang").focus();
		});

		$("#simpan").click(function() {
			var bayar = parseInt($("#bayar").val());
			var tot = parseInt($("#totalharga").val());
			var kembalian = $("#kembalian").val(bayar - $("#totalharga").val()).number(true, 0);
			if (bayar < tot) {
				alert('Bayar harus >= Total Harga');
			} else {
				var ke = $('#barang_dijual tr').length;
				var nonota = $("#nonota").val();
				var tgljual = $("#tgljual").val();
				var nama_satuan = $("#nama_satuan").val();
				var jns = $("#jns").val();

				var pelanggan = $("#kodemember").val();


				var kasir = $("#kasir").text();
				var subtotal = $("#subtotal").val();
				var diskonpersen = $("#persen").val();
				var diskonharga = $("#diskonharga").val();
				var totalharga = $("#totalharga").val();
				var bayar = $("#bayar").val();
				var kembalian = $("#kembalian").val();
				var kode_user = <?php echo "$kode_user"; ?>;
				var pembayaran = $("#pembayaran").val();
				if (nonota == "") {
					alert("No. Nota tidak boleh kosong");
					$("#nonota").focus();
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
				} else if (pembayaran == "") {
					alert("Metode pembayaran tidak boleh kosong");
					$("#pembayaran").focus();
				} else {
					$.ajax({
						url: 'inc/proses_simpan_penjualan.php',
						data: 'nonota=' + nonota + '&tgljual=' + tgljual + '&pelanggan=' + pelanggan + '&jns=' + jns + '&kasir=' + kasir + '&subtotal=' + subtotal + '&diskonpersen=' + diskonpersen + '&diskonharga=' + diskonharga + '&totalharga=' + totalharga + '&bayar=' + bayar + '&kembalian=' + kembalian + '&kode_user=' + kode_user + '&pembayaran=' + pembayaran,
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
						var disc = $("#disc-" + i).text();
						$.ajax({
							url: 'inc/proses_simpan_barang_terjual.php',
							type: 'post',
							data: 'kodebarang=' + kodebarang + '&namabarang=' + namabarang + '&jumlahjual=' + jumlahjual + '&hargasatuan=' + hargasatuan + '&hargaakhir=' + hargaakhir + '&nonota=' + nonota + '&nama_satuan=' + nama_satuan + '&disc=' + disc,
							success: function(msg) {
								$("#hasil").html(msg);
							}
						});
					}

					alert("Penjualan telah tersimpan");
					window.location.href = "?page=penjualan&action=input";
					if ($("#print-struk:checked").val()) {
						window.open("cetak_struk.php?id=<?php echo "$hasilkode"; ?>", "Struk Pembelian", "height=700,width=700,scrollbars=yes");
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
					if (e.keyCode == 13) {
						window.scrollBy(0, 300);
						if ($("#manual:checked").val()) {
							$("#jumlahjual").focus();
						} else {
							$("#simpanitem").click();
							// window.scrollBy(0, 100);
						}
					}
				}
			});

			if (e.keyCode == 40) {
				window.scrollBy(0, 400);
				$("#bayar").focus();
			}

		});


		$("#kodemember").keyup(function(e) {

			var kodemember = $("#kodemember").val();

			$.ajax({

				url: 'inc/cari_member.php',

				type: 'post',

				data: 'kodemember=' + kodemember,

				success: function(msg) {

					$("#hasil").html(msg);

				}

			});

		});


		$("#simpanitem").click(function() {
			var kodebarang = $("#kodebarang").val();
			var jumlahjual = $("#jumlahjual").val();
			var id_satuan = $("#nama_satuan").val();
			var harga_barang = $("#harga_satuan").val();
			var disc = $("#diskonharga").val();
			if (kodebarang == "") {
				alert("Kode barang kosong");
				$("#kodebarang").focus();
			} else if (jumlahjual == "") {
				alert("Jumlah Jual kosong");
				$("#jumlahjual").focus();
			} else if (disc == "") {
				alert("Diskon kosong");
				$("#disc").focus();
			} else {
				var kodebarang = $("#kodebarang").val();
				$.ajax({
					url: 'inc/simpan_tmp_jual.php',
					type: 'post',
					data: 'kodebarang=' + kodebarang + '&jumlahjual=' + jumlahjual + '&kp=' + kp + '&id_satuan=' + id_satuan + '&harga_barang=' + harga_barang + '&disc=' + disc,
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

		$("#hapussemuaitem").click(function() {
			$('#hasil').load("inc/delete_tmp_jual.php");
			$("#totalharga").val("");
			$("#kodebarang").focus();
		});

		$("#batalitem").click(function() {
			$("#kodebarang").val("");
			$("#namabarang").val("");
			$("#stokbarang").val("");
			$("#hargabarang").val("");
			$("#diskonharga").val("");
			$("#hargaakhir").val("");
			$("#hargaakhir").val("0");
			$("#kodebarang").val("");
			$("#harga_satuan").val("");
			$("#kodebarang").focus();
		});

		$("#jumlahjual").keyup(function(e) {
			var hargabarang = $("#hargabarang").val();
			var stok = parseInt($("#stokbarang").val());
			var disk = $("#disko").val();
			var jumlahjual = parseInt($(this).val());


			$("#hargaakhir").val(hargabarang * jumlahjual).number(true, 0);
			$("#diskonharga").val(jumlahjual * disk).number(true, 0);
			if (e.keyCode == 13) {
				if (jumlahjual <= 0 || jumlahjual == "") {
					alert('Jumlah jual tidak boleh kosong');
				} else {
					$("#simpanitem").click();
					$("#jumlahjual").val("");
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

		$("#diskonharga").keyup(function(e) {
			var hargabarang = $("#hargabarang").val();

			var disc = parseInt($(this).val());
			if (e.keyCode == 13) {
				$("#simpanitem").click();
				$("#diskonharga").val("");
			}
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
			$("#hargabarang").val("");
			$("#harga_satuan").val("");
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
	<script type="text/javascript">
		<?php echo $jsArray2; ?>

		function changeValue2(id_satuan) {
			document.getElementById('harga_satuan').value = dtpgjj[id_satuan].harga_satuan;
		};
	</script>


<?php
} else if ($_GET['action'] == "delete") {
	include "delete_penjualan.php";
} else if ($_GET['action'] == "delete_detail") {
	include "delete_detail_penjualan.php";
}
?>