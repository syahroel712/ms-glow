<?php
if ($_GET['action'] == 'input') {
	$tanggal = date('Y-m-d');
	$sekarang = date('ymd');
	$carikode = mysql_query("SELECT max(nota) from tb_pembelian") or die(mysql_error());
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
	mysql_query("DELETE from pengembalian_tmp where id_user='$kode_user'");

	$sql_user = mysql_query("SELECT * FROM tb_user where kode_user = '$kode_user'");
	$data_user = mysql_fetch_array($sql_user);

?>

	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0 text-dark">Pengembalian</h1>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="#">Home</a></li>
						<li class="breadcrumb-item active">Transaksi Pengembalian</li>
					</ol>
				</div>
			</div>
		</div>
	</div>

	<section class="content">
		<div class="container-fluid">
			<!-- Small boxes (Stat box) -->
			<div class="row">
				<div class="col-lg-12">
					<div class="card">
						<div class="card-header">
							<h3 class="card-title">Transaksi Return ( <span class="text-bold" id="kasir"><?= $data_user['nama_lengkap']; ?></span> )</h3>
						</div>
						<div class="card-body">
							<div class="row">
								<div class="col-lg-4">
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
											<select name="sup" id="sup" data-placeholder="Pilih Supplier..." class="select2bs4 form-control" onchange="changeValue2(this.value)">
												<option value="">Pilih</option>

												<?php
												$q5 = mysql_query("SELECT * from tb_supplier order by nmsup");

												while ($row = mysql_fetch_array($q5)) {
													echo '<option value="' . $row['idsup'] . '">' . $row['nmsup'] . '</option>';
												}
												?>
											</select>
										</div>
									</div>
								</div>
							</div>

							<div class="row mt-4">
								<div class="table-responsive-sm">
									<table style="clear:both; width:100%;" class='table table-condensed'>
										<tr>
											<td>Kode Barang</td>
											<td>Nama Barang</td>
											<td>Stok</td>
											<td>Qty</td>
											<!-- <td>Sub Total<i>(Rp.)</i></td> -->
											<td></td>
										</tr>
										<tr>
											<td style="width:200px;">
												<input type="text" name="kodebarang" id="kodebarang" class="form-control" />

											</td>
											<td style="width:200px;"><input class="form-control" type="text" id="namabarang" style="width:200px;" onkeyup="suggest(this.value);" />
												<div id="suggest"></div>

											</td>
											<td style="width:60px;"><input class="form-control" type="text" id="stokbarang" style="width:70px;" disabled="disabled" /></td>
											<td style="width:50px;"><input class="form-control" type="text" id="jumlahjual" style="width:50px;" /></td>
											<!-- <td><input class="form-control" type="text" id="hargaakhir" style="width:100px;" value="0" disabled="disabled" /></td> -->
											<td><input class="form-control" type="hidden" id="hargabarang" /></td>
											<td><input class="form-control" type="hidden" id="dc" style="width:80px;" /></td>
											<td colspan="3" align="right" style="padding-top:10px;">
												<button id="simpanitem" class="btn btn-primary btn-sm shadow">Simpan Item</button>
												<button class="btn btn-warning btn-sm shadow" id="batalitem">Batal Item</button>
												<button class="btn btn-danger btn-sm shadow" id="hapussemuaitem">Hapus Semua</button></td>

										</tr>
									</table>
								</div>
							</div>

							<div class="row mt-1">
								<div class="table-responsive-sm">
									<table class="data table table-bordered table-striped" id="barang_dijual">
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
												<th>
													<center>Qty</center>
												</th>
												<th colspan="2">
													<center>Harga Satuan</center>
												</th>

												<th colspan="2">
													<center>Harga Akhir</center>
												</th>
												<th>Opsi</th>
											</tr>
										</thead>
										<tbody id="isi">

										</tbody>
									</table>
								</div>
							</div>

							<div class="row mt-4">
								<div class="col-lg-5">
									<table class='table'>
										<tr>
											<td>Sub Total</td>
											<td>:</td>
											<td><i>Rp. </i><input class="form-control" type="text" id="subtotal" style="width:180px;" readonly=readonly /></td>
										</tr>

										<input class="form-control" type="hidden" id="bayar" style="width:180px;" />
										<input class="form-control" type="hidden" id="kembalian" style="width:180px;" disabled="disabled" />
										<tr>
											<td colspan="3" style="padding:20px 0 0 0;" align="right"><button id="simpan" class="btn btn-primary shadow">Simpan</button> <button class="btn btn-danger shadow" id="batal">Batal</button></td>
										</tr>
									</table>
								</div>
							</div>

							</fieldset>
						</div>
					</div>
				</div>
			</div>
			<!-- /.row -->
		</div><!-- /.container-fluid -->
	</section>

	<!--<input type="text" id="jml"/>-->

	<div id="hasil"></div>
	<script src="assets/js/suggest_penjualan.js"></script>

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

			$('#isi').load("inc/tmp_pengembalian.php");
		});

		$("#ppn").keyup(function(e) {
			var diskonpersen = $("#persen").val();
			var subtotal = $("#subtotal").val();
			$("#diskonharga").val(subtotal * diskonpersen / 100);

			var diskonharga = $("#diskonharga").val();
			var ppn = parseInt($("#ppn").val());
			var tot = parseInt($("#totalharga").val());

			//$("#totalharga").val((subtotal-diskonharga)+((subtotal-diskonharga)*(ppn/100))).number(true, 0);
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

		$("#kdbarang").keyup(function() {

			$("#namabarang").val("");
			var kdbarang = $("#kdbarang").val();

			$.ajax({
				url: 'inc/cari_barang.php',
				type: 'post',
				data: 'kdbarang=' + kdbarang,
				success: function(msg) {
					$("#hasil").html(msg);
				}
			});

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
					url: 'inc/proses_simpan_pengembalian.php',
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
						url: 'inc/proses_simpan_barang_pengembalian.php',
						type: 'post',
						data: 'kodebarang=' + kodebarang + '&namabarang=' + namabarang + '&jumlahjual=' + jumlahjual + '&hargasatuan=' + hargasatuan + '&hargasatuan2=' + hargasatuan2 + '&hargaakhir=' + hargaakhir + '&nonota=' + nonota + '&diskon=' + diskon + '&diskonpersen=' + diskonpersen + '&ppn=' + ppn,
						success: function(msg) {
							$("#hasil").html(msg);
						}
					});
				}

				alert("Pengembalian telah tersimpan");
				window.location.href = "?page=pengembalian&action=input";
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
				url: 'inc/cari_barang_pengembalian.php',
				type: 'post',
				data: 'kodebarang=' + kodebarang,
				success: function(msg) {
					$("#hasil").html(msg);
				}
			});
			if (e.keyCode == 13) {
				//document.body.scrollTop = document.body.scrollHeight;
				window.scrollBy(0, 300);
				$("#jumlahjual").focus();
				//$("#simpan").focus();
			}
			if (e.keyCode == 40) {
				//document.body.scrollTop = document.body.scrollHeight;
				window.scrollBy(0, 400);
				//$("#hargabarang").focus();
				//$("#persen").focus();
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
				//document.body.scrollTop = document.body.scrollHeight;
				window.scrollBy(0, 300);
				$("#jumlahjual").focus();
				//$("#simpanitem").click();
				//$("#batalitem").click();
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
					url: 'inc/simpan_tmp_pengembalian.php',
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
					$("#simpanitem").click();
					$("#dc").focus();
				} else if (jumlahjual == "") {
					alert('Qty kosong');
					$("#jumlahjual").focus();
				} else {
					alert('Qty kosong');
					$("#jumlahjual").focus();
				}
				//$("#batalitem").click();
				//$("#kodebarang").val("");
				//$("#kodebarang").focus();
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
					//$("#dc").focus();
				}
				$("#batalitem").click();
				//$("#kodebarang").val("");
				//$("#kodebarang").focus();
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
} else if (@$_GET['action'] == 'view') {
	include "data_pengembalian.php";
}
else if (@$_GET['action'] == 'edit') {
	include "edit_pengembalian.php";
}
else if (@$_GET['action'] == "delete") {
	include "delete_pengembalian.php";
}
else if (@$_GET['action'] == "delete_detail") {
	include "delete_detail_pengembalian.php";
}
?>
</div>