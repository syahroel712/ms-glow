<?php
$tanggal = date('Y-m-d');

$carikode = mysql_query("SELECT max(kode_barang) from tb_barang") or die(mysql_error());
$datakode = mysql_fetch_row($carikode);
if ($datakode) {
	$nilaikode = substr($datakode[0], 2);
	$kode = (int) $nilaikode;
	$kode = $kode + 1;
	$hasilkode = "B" . str_pad($kode, 4, "0", STR_PAD_LEFT);
} else {
	$hasilkode = "B001";
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
							Tambah Barang
						</h3>
					</div>

					<div class="card-body">
						<div class="form-group row">
							<label for="kd_brg" class="col-sm-2 col-form-label">Kode Barang</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" id="kd_brg" placeholder="Kode Barang">
							</div>
						</div>
						<div class="form-group row">
							<label for="nm_brg" class="col-sm-2 col-form-label">Nama Barang</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" id="nm_brg" placeholder="Nama Barang">
							</div>
						</div>
						<div class="form-group row">
							<label for="sup" class="col-sm-2 col-form-label">Suplier</label>
							<div class="col-sm-10">
								<select id="sup" class="form-control select2bs4" data-placeholder="Pilih Supplier...">
									<option value=""></option>
									<?php
									$sup = mysql_query("SELECT * FROM tb_supplier");
									while ($r = mysql_fetch_array($sup)) {
									?>
										<option value="<?= $r['idsup'] ?>"><?= $r['nmsup'] ?></option>
									<?php } ?>
								</select>
							</div>
						</div>
						<div class="form-group row">
							<label for="satuan" class="col-sm-2 col-form-label">Satuan</label>
							<div class="col-sm-10">
								<input class='form-control' type="text" name='satuan' id="satuan">
							</div>
						</div>
						<div class="form-group row">
							<label for="hb" class="col-sm-2 col-form-label">Harga Beli</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" id="hb" placeholder="Harga Beli" onkeyup="OnChange(this.value)" onKeyPress="return isNumberKey(event)">
							</div>
						</div>
						<div class="form-group row">
							<label for="kat" class="col-sm-2 col-form-label">Kategori</label>
							<div class="col-sm-10">
								<select id="kat" class="form-control select2bs4" data-placeholder="Pilih Kategori..." onchange="changeValue2(this.value)">
									<option value=""></option>
									<?php
									$kat = mysql_query("SELECT * FROM kategori order by nmkat");
									$jsArray = "var pel = new Array();\n";
									while ($row = mysql_fetch_array($kat)) {
									?>
										<option value="<?= $row['idkat'] ?>"><?= $row['nmkat'] ?></option>
									<?php
										$jsArray .= "pel['" . $row['idkat'] . "'] = {name:'" . addslashes($row['nmkat']) . "',desc:'" . addslashes($row['persen']) . "'};\n";
									}
									?>
								</select>
								<script type="text/javascript">
									<?php echo $jsArray; ?>

									function changeValue2(id) {
										document.getElementById('persen').value = pel[id].desc;
										var hb = parseInt($("#hb").val());
										$("#hj").val(hb + (hb * (pel[id].desc / 100)));
										$("#hg").val(hb + (hb * (pel[id].desc / 100)));

									};
								</script>
							</div>
						</div>
						<script type="text/javascript" language="Javascript">
							var total = ;
							hargabeli = document.formD.hb.value;
							document.formD.hj.value = hargabeli;
							bonus = document.formD.persen.value;
							document.formD.hj.value = bonus;

							function OnChange(value) {
								hargabeli = document.formD.hb.value;
								bonus = document.formD.persen.value;
								total = (hargabeli + ((hargabeli * bonus) / 100));
								document.formD.hj.value = total;
							}
						</script>
						<div class="form-group row">
							<label for="persen" class="col-sm-2 col-form-label">Persentase Keuntungan</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" id="persen" placeholder="Persentase Keuntungan">
							</div>
						</div>

						<script>
							$("#persen").keyup(function() {
								var hb = parseInt($("#hb").val());
								var bonus = parseInt($(this).val());

								total = hb + ((hb * bonus) / 100);
								$("#hj").val(total).number(true, 2);
							});
						</script>

						<div class="form-group row">
							<label for="hj" class="col-sm-2 col-form-label">Harga Jual</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" id="hj" value="" placeholder="Harga Jual">
							</div>
						</div>
						<div class="form-group row">
							<label for="s_awal" class="col-sm-2 col-form-label">Stok Awal</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" id="s_awal" placeholder="Stok Awal">
							</div>
						</div>
						<div class="form-group row">
							<label for="disk" class="col-sm-2 col-form-label">Diskon</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" id="disk" placeholder="Diskon %">
							</div>
						</div>
						<div class="form-group row">
							<label for="tgl" class="col-sm-2 col-form-label">Tanggal Barang Masuk</label>
							<div class="col-sm-10">
								<input type="date" class="form-control" id="tgl" value="<?php echo $tanggal; ?>">
							</div>
						</div>
					</div>
					<!-- /.card-body -->
					<div class="card-footer">
						<button id="tambah" class="btn btn-primary">Simpan</button>
						<a href="index.php?page=barang&action=view" class="btn btn-default float-right">Cancel</a>
					</div>
					<!-- /.card-footer -->

				</div>
			</div>
		</div>
		<!-- /.row -->
	</div><!-- /.container-fluid -->
</section>

<div id="hasil"></div>

<script>
	function cekKode(kode)
	{
		var kode = kode.value
		
	}

	$(function() {
		$("#kd_brg").focus();
		$("#hb").number(true, 2);
		$("#hj").number(true, 2);
		$("#min_hg").number(true, 0);
		$("#hg").number(true, 2);
	});

	$("#tambah").click(function() {
		var kd_brg = $("#kd_brg").val();
		var nm_brg = $("#nm_brg").val();
		var satuan = $("#satuan").val();
		var sup = $("#sup").val();
		var kat = $("#kat").val();

		var hj = $("#hj").val();
		var hb = $("#hb").val();
		var s_awal = $("#s_awal").val();
		var disk = $("#disk").val();
		var tgl = $("#tgl").val();
		if (kd_brg == '') {
			alert("Kode Barang tidak boleh kosong");
			$("#kd_brg").focus();
		} else if (nm_brg == '') {
			alert("Nama Barang tidak boleh kosong");
			$("#nm_brg").focus();
		} else if (satuan == '') {
			alert("Satuan tidak boleh kosong");
			$("#satuan").focus();
		} else if (hj == '') {
			alert("Harga jual tidak boleh kosong");
			$("#hj").focus();
		} else if (s_awal == '') {
			alert("Stok awal jual tidak boleh kosong");
			$("#s_awal").focus();
		} else if (tgl == '') {
			alert("Tanggal treakhir barang masuk tidak boleh kosong");
			$("#tgl").focus();
		} else {
		$.ajax({
			url: 'inc/barang/cekkode.php',
			type: 'POST',
			data: {'kode':kd_brg},
			dataType: 'JSON',
			success: function(res){
				if(res.value ==1)
				{
					alert(res.pesan)
				}else{
				$.ajax({
					type: 'post',
					url: 'inc/barang/proses_tambah_barang.php',
					data: 'kd_brg=' + kd_brg + '&nm_brg=' + nm_brg + '&satuan=' + satuan + '&hj=' + hj + '&hb=' + hb + '&s_awal=' + s_awal + '&disk=' + disk + '&tgl=' + tgl + '&sup=' + sup + '&kat=' + kat,
					success: function(msg) {
						$("#hasil_tambah").html(msg);
					}
				});
				}
			}
			
		})
			
		}
	});
</script>
<div id="hasil_tambah"></div>