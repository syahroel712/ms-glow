<?php
if ($_GET['action'] == 'input') {
	$tanggal = date('Y-m-d');
	$sekarang = date('ymd');
	$carikode = mysql_query("SELECT max(nota) from tb_pembelian");
	$datakode = mysql_fetch_row($carikode);
	if ($datakode) {
		$nilaikode = substr($datakode[0], 7);
		$kode = (int) $nilaikode;
		$kode = $kode + 1;
		$hasilkode = $sekarang . str_pad($kode, 3, "0", STR_PAD_LEFT);
	} else {
		$hasilkode = $sekarang . "001";
	}

	if ($_SESSION['admin']) {
		$kode_user = $_SESSION['admin'];
	} else if ($_SESSION['kasir']) {
		$kode_user = $_SESSION['kasir'];
	}

	//hapus item tmp
	mysql_query("DELETE from beli_tmp where id_user='$kode_user'");

	$sql_user = mysql_query("SELECT * from tb_user where kode_user = '$kode_user'");
	$data_user = mysql_fetch_array($sql_user);

?>

	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0 text-dark">Pembelian</h1>
				</div><!-- /.col -->
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="#">Home</a></li>
						<li class="breadcrumb-item active">Transaksi Pembelian</li>
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
							<h3 class="card-title">Transaksi Pembelian ( <span class="text-bold" id="kasir"><?= $data_user['nama_lengkap']; ?></span> )</h3>
						</div>
						<div class="card-body">
							<div class="row">
								<div class="col-lg-6">
									<form class="form-horizontal">
										<div class="card-body">
											<div class="form-group row">
												<label for="nonota" class="col-sm-4 col-form-label">No Nota</label>
												<div class="col-sm-8">
													<input class="form-control" type="text" id="nonota" />
												</div>
											</div>
											<div class="form-group row">
												<label for="tgljual" class="col-sm-4 col-form-label">Tanggal</label>
												<div class="col-sm-8">
													<input class="form-control" type="date" id="tgljual" value="<?php echo $tanggal; ?>" />
												</div>
											</div>

											<div class="form-group row">
												<label for="sup" class="col-sm-4 col-form-label">Supplier</label>
												<div class="col-sm-8">
													<select name="sup" id="sup" data-placeholder="Pilih Supplier" class="select2bs4" onchange="changeValue2(this.value)" style="width: 100%;">
														<option value=""></option>
														<?php
														$q5 = mysql_query("SELECT * FROM tb_supplier ORDER BY nmsup");
														while ($row = mysql_fetch_array($q5)) { ?>
															<option value="<?= $row['idsup'] ?>"><?= $row['nmsup'] ?></option>
														<?php
														}
														?>
													</select>
												</div>
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
												<td>Harga Beli<i>(Rp.)</i></td>
												<td>Qty</td>
												<td>Dc</td>
												<td>Sub Total<i>(Rp.)</i></td>
												<td></td>
											</tr>
										</thead>

										<tbody>
											<tr>
												<td>
													<input type="text" name="kodebarang" id="kodebarang" class="form-control" />
												</td>
												<td>
													<input class="form-control" type="text" id="namabarang" onkeyup="suggest(this.value);" />
													<div id="suggest"></div>
												</td>
												<td><input class="form-control" type="text" id="stokbarang" disabled="disabled" style="width:50px;" /></td>
												<td><input class="form-control" type="text" id="hargabarang" /></td>
												<td><input class="form-control" type="text" id="jumlahjual" style="width:50px;" /></td>
												<td><input class="form-control" type="text" id="dc" style="width:80px;" /></td>
												<td><input class="form-control" type="text" id="hargaakhir" value="0" readonly /></td>
												<td align="right">
													<button id="simpanitem" class="btn btn-primary btn-sm shadow">Simpan Item</button>
													<button class="btn btn-warning btn-xs shadow" id="batalitem">Batal Item</button>
													<button class="btn btn-danger btn-xs shadow" id="hapussemuaitem">Hapus Semua</button></td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>

							<div class="row overflow-auto">
								<div class="table-responsive-sm">
									<table class="data table table-bordered table-striped" id="barang_dijual">
										<thead>
											<tr>
												<th>No</th>
												<th>Kode Barang</th>
												<th>Nama Barang</th>
												<th>Qty</th>
												<th colspan="2">Harga Satuan</th>
												<th>Dc</th>
												<th colspan=2>Hrg Sth Dc</th>
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

									<input class="form-control" type="hidden" id="bayar" />
									<input class="form-control" type="hidden" id="kembalian" disabled="disabled" />

									<div class="form-group row">
										<label class="col-md-4 col-form-label">Sub Total</label>
										<div class="col-sm-8">
											<input class="form-control" type="text" id="subtotal" readonly=readonly />
										</div>
									</div>
									<div class="form-group row">
										<label class="col-md-4 col-form-label">Diskon (%)</label>
										<div class="col-sm-8">
											<input class="form-control" type="text" id="persen" maxlength='6' value="0" />
											<i>Rp. </i><input class="form-control" type="text" id="diskonharga" value="0" style="width:82px;" />
										</div>
									</div>
									<div class="form-group row">
										<label class="col-md-4 col-form-label">PPN(%)</label>
										<div class="col-sm-8">
											<input class='form-control' type='text' maxlength='6' value='0' id='ppn' />
										</div>
									</div>
									<div class="form-group row">
										<label class="col-md-4 col-form-label">Total Harga</label>
										<div class="col-sm-8">
											<input class="form-control" type="text" id="totalharga" style="width:180px;" readonly />
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
										<div id="info" class="text-red" style="padding:10px; font-size:30px; font-weight:bold;">
											Tagihan : Rp. <span id="tagihan">0</span><br />
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

	<script src="assets/js/suggest_pembelian.js"></script>
	<script>
		$(function() {
			$("#nonota").focus();
			$("#subtotal").val(0);
			$("#diskonharga").number(true, 0);
			$("#bayar").number(true, 0);
			$("#hargabarang").number(true, 0);
			$("#dc").number(true, 2);
			$("#persen").number(true, 2);
			$("#ppn").number(true, 2);
			$("#totalharga").number(true, 0);
			$('#isi').load("inc/tmp_beli.php");
		});

		$("#ppn").keyup(function(e) {
			var diskonpersen = $("#persen").val();
			var subtotal = $("#subtotal").val();
			$("#diskonharga").val(subtotal * diskonpersen / 100);

			var diskonharga = $("#diskonharga").val();
			var ppn = parseInt($("#ppn").val());
			var tot = parseInt($("#totalharga").val());

			$("#totalharga").val((subtotal - diskonharga) + ((subtotal - diskonharga) * (ppn / 100))).number(true, 0);
			$("#tagihan").text((subtotal - diskonharga) + ((subtotal - diskonharga) * (ppn / 100))).number(true, 0);

		});

		$("#nonota").blur(function() {
			var nonota = $("#nonota").val();
			$.ajax({
				url: 'inc/cari_nota.php',
				type: 'post',
				data: 'nonota=' + nonota,
				success: function(msg) {
					$("#hasil").html(msg);
				}
			});

		});

		$("#nonota").keyup(function(e) {
			if (e.keyCode == 13) {
				$("#kodebarang").focus();
			}
		});

		$("#simpan").click(function() {
			var ke = $('#barang_dijual tr').length;

			var nonota = $("#nonota").val();
			var tgljual = $("#tgljual").val();
			var pelanggan = $("#pelanggan").val();
			var jns = $("#jns").val();
			var kasir = $("#kasir").text();
			var subtotal = $("#subtotal").val();
			var diskonpersen = $("#persen").val();
			var ppn = $("#ppn").val();
			var diskonharga = $("#diskonharga").val();
			var totalharga = $("#totalharga").val();
			var bayar = $("#bayar").val();
			var kembalian = $("#kembalian").val();
			var sup = $("#sup").val();
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
			} else {
				$.ajax({
					url: 'inc/proses_simpan_pembelian.php',
					data: 'nonota=' + nonota + '&tgljual=' + tgljual + '&pelanggan=' + pelanggan + '&jns=' + jns + '&kasir=' + kasir + '&subtotal=' + subtotal + '&diskonpersen=' + diskonpersen + '&diskonharga=' + diskonharga + '&totalharga=' + totalharga + '&bayar=' + bayar + '&kembalian=' + kembalian + '&ppn=' + ppn + '&sup=' + sup,
					type: 'POST',
					success: function(msg) {
						$("#hasil").html(msg);
					}
				});


				for (var i = 1; i < ke; i++) {
					var kodebarang = $("#kodebarang-" + i).text();
					var namabarang = $("#namabarang-" + i).text();
					var hargasatuan2 = $("#hargasatuan2-" + i).text();
					var hargasatuan = $("#hargasatuan-" + i).text();
					var jumlahjual = $("#jumlahjual-" + i).text();
					var hargaakhir = $("#hargaakhir-" + i).text();
					var diskon = $("#diskon-" + i).text();
					$.ajax({
						url: 'inc/proses_simpan_barang_terbeli.php',
						type: 'post',
						data: 'kodebarang=' + kodebarang + '&namabarang=' + namabarang + '&jumlahjual=' + jumlahjual + '&hargasatuan=' + hargasatuan + '&hargasatuan2=' + hargasatuan2 + '&hargaakhir=' + hargaakhir + '&nonota=' + nonota + '&diskon=' + diskon + '&diskonpersen=' + diskonpersen + '&ppn=' + ppn,
						success: function(msg) {
							$("#hasil").html(msg);
						}
					});
				}

				alert("Pembelian telah tersimpan");
				window.location.href = "?page=pembelian&action=input";
				//window.open("cetak_struk_beli.php?id="+nonota,"Struk Pembelian","height=700,width=700,scrollbars=yes");
			}
		});

		$("#caribarang").click(function() {
			$("#bg-popup").fadeIn(700, function() {
				$("#popup").fadeIn(600);
			});
		});

		$("#kodebarang").keyup(function(e) {
			var kodebarang = $("#kodebarang").val();
			$.ajax({
				url: 'inc/cari_barang_pembelian.php',
				type: 'post',
				data: 'kodebarang=' + kodebarang,
				success: function(msg) {
					$("#hasil").html(msg);
				}
			});
			if (e.keyCode == 13) {
				window.scrollBy(0, 300);
				$("#hargabarang").focus();
			}
			if (e.keyCode == 40) {
				window.scrollBy(0, 400);
				$("#persen").focus();
			}

		});
		$("#hargabarang").keyup(function(e) {
			var hargabarang = $("#hargabarang").val();
			var stok = parseInt($("#stokbarang").val());
			var dc = parseInt($("#dc").val());
			var jumlahjual = parseInt($("#jumlahjual").val());

			var hrg = hargabarang - (hargabarang * (dc / 100));
			$("#hargaakhir").val(hrg * jumlahjual).number(true, 0);
			if (e.keyCode == 13) {
				window.scrollBy(0, 300);
				$("#jumlahjual").focus();
			}

		});

		function keluar() {
			$("#popup").fadeOut(400, function() {
				$("#bg-popup").fadeOut(600);
			});
		}

		$("#keluar").click(function() {
			keluar();
		});

		$('.pilih').click(function() {
			var kd = $(this).attr("kd");
			var nm = $(this).attr("nm");
			var stok = $(this).attr("stok");
			var hs = $(this).attr("hs");
			$("#kodebarang").val(kd);
			$("#namabarang").val(nm);
			$("#stokbarang").attr("value", stok);
			$("#stokbarang").val(stok);
			$("#hargabarang").val(hs).number(true, 0);
			keluar();
			$("#jumlahjual").val("");
			$("#hargaakhir").val("0");
			$("#jumlahjual").focus();
		});

		$("#simpanitem").click(function() {
			var kodebarang = $("#kodebarang").val();
			var hrg = $("#hargabarang").val();
			var jml = $("#jumlahjual").val();
			var dc = $("#dc").val();
			if (kodebarang == "") {
				alert("Kode barang kosong");
				$("#kodebarang").focus();
			} else if (jml == "") {
				alert("Qty kosong");
				$("#jumlahjual").focus();
			} else {
				var kodebarang = $("#kodebarang").val();
				$.ajax({
					url: 'inc/simpan_tmp_beli.php',
					type: 'post',
					data: 'kodebarang=' + kodebarang + '&hrg=' + hrg + '&jml=' + jml + '&dc=' + dc,
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
			$('#hasil').load("inc/delete_tmp_beli.php");
			$("#totalharga").val("");
			$("#batalitem").click();
		});

		$("#batalitem").click(function() {
			$("#kodebarang").val("");
			$("#namabarang").val("");
			$("#stokbarang").val("");
			$("#hargabarang").val("");
			$("#hargaakhir").val("");
			$("#jumlahjual").val("");
			$("#hargaakhir").val("0");
			$("#kodebarang").val("");
			$("#kodebarang").focus();
		});

		$("#jumlahjual").keyup(function(e) {
			var hargabarang = $("#hargabarang").val();
			var stok = parseInt($("#stokbarang").val());
			var dc = parseInt($("#dc").val());
			var jumlahjual = parseInt($(this).val());

			if (e.keyCode == 13) {
				if (jumlahjual != 0) {
					//$("#simpanitem").click();					
					$("#dc").focus();
				} else if (jumlahjual == "") {
					alert('Qty kosong');
					$("#jumlahjual").focus();
				} else {
					alert('Qty kosong');
					$("#jumlahjual").focus();
				}
			}

			var hrg = hargabarang - (hargabarang * (dc / 100));
			$("#hargaakhir").val(hrg * jumlahjual).number(true, 0);
		});

		$("#dc").keyup(function(e) {
			var hargabarang = $("#hargabarang").val();
			var stok = parseInt($("#stokbarang").val());
			var dc = parseInt($("#dc").val());
			var jumlahjual = parseInt($("#jumlahjual").val());

			if (e.keyCode == 13) {
				if (jumlahjual != 0) {
					$("#simpanitem").click();
				}
				$("#batalitem").click();
			}

			var hrg = hargabarang - (hargabarang * (dc / 100));
			$("#hargaakhir").val(hrg * jumlahjual).number(true, 0);
		});

		$("#persen").keyup(function() {
			var diskonpersen = $("#persen").val();
			var subtotal = $("#subtotal").val();
			$("#diskonharga").val(subtotal * diskonpersen / 100);

			var diskonharga = $("#diskonharga").val();
			var ppn = parseInt($("#ppn").val());
			var tot = parseInt($("#totalharga").val());

			$("#totalharga").val((subtotal - diskonharga) + ((subtotal - diskonharga) * (ppn / 100))).number(true, 0);
			$("#tagihan").text((subtotal - diskonharga) + ((subtotal - diskonharga) * (ppn / 100))).number(true, 0);

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
			$("#jumlahjual").val("");
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
<?php
} else if ($_GET['action'] == 'view') {
	include "data_pembelian.php";
} else if ($_GET['action'] == 'edit') {
	include "edit_pembelian.php";
} else if ($_GET['action'] == "delete") {
	include "delete_pembelian.php";
} else if ($_GET['action'] == "delete_detail") {
	include "delete_detail_pembelian.php";
}
?>