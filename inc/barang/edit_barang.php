<?php
$id_brg = $_GET['id'];
$sql2 = mysql_query("SELECT * from tb_barang where kode_barang = '$id_brg'") or die(mysql_error());
$data2 = mysql_fetch_array($sql2);
?>

<section class="content">
	<div class="container-fluid">
		<!-- Small boxes (Stat box) -->
		<div class="row">
			<div class="col-lg-12">
				<div class="card">
					<div class="card-header">
						<h3 class="card-title">
							Edit Barang ( <b> <?= $data2['nama_barang'] ?> </b> )
						</h3>
					</div>
					<form action='inc/barang/proses_edit_barang.php' method='POST' class="form-horizontal">
						<div class="card-body">
							<div class="form-group row">
								<label for="kd_brg" class="col-sm-2 col-form-label">Kode Barang</label>
								<div class="col-sm-10">
									<input class='form-control' type="text" name='kd_brg' id="kd_brg" value="<?php echo "$data2[kode_barang]"; ?>" readonly=readonly />
								</div>
							</div>
							<div class="form-group row">
								<label for="nm_brg" class="col-sm-2 col-form-label">Nama Barang</label>
								<div class="col-sm-10">
									<input class='form-control' type="text" id="nm_brg" name='nm_brg' value="<?php echo $data2['nama_barang']; ?>" />
								</div>
							</div>
							<div class="form-group row">
								<label for="sup" class="col-sm-2 col-form-label">Supplier</label>
								<div class="col-sm-10">
									<select name="sup" id="sup" data-placeholder="Pilih Supplier..." class="form-control select2bs4">
										<option value=""></option>
										<?php
										$q5 = mysql_query("SELECT * from tb_supplier");
										while ($row = mysql_fetch_array($q5)) {
											if ($data2['idsup'] == $row['idsup']) {
												$selected = "selected";
											} else {
												$selected = "";
											}
										?>
											<option value="<?php echo $row['idsup']; ?>" <?= $selected ?>><?php echo "$row[nmsup]"; ?></option>
										<?php
										}
										?>
									</select>
								</div>
							</div>

							<div class="form-group row">
								<label for="satuan" class="col-sm-2 col-form-label">Satuan</label>
								<div class="col-sm-10">
								<select class="form-control" name="satuan" id="satuan">
									<option value="Pcs">PCS</option>
									<option value="Ctn">CTN</option>
									<option value="Pks">PKS</option>
									<option value="Bks">BKS</option>
								</select>
								</div>
							</div>

							<div class="form-group row">
								<label for="hb" class="col-sm-2 col-form-label">Harga Beli</label>
								<div class="col-sm-10">
									<input class='form-control' name='hb' type="text" id="hb" value="<?php echo $data2['harga_beli']; ?>" />
									<input class='form-control' type="hidden" id="hb2" value="<?php echo $data2['harga_beli']; ?>" />
								</div>
							</div>

							<div class="form-group row">
								<label for="kat" class="col-sm-2 col-form-label">Kategori</label>
								<div class="col-sm-10">
									<select name="prdId" id="kat" onchange="changeValue2(this.value)" data-placeholder="Pilih kategori..." class="form-control select2bs4">
										<?php
										$q5 = mysql_query("SELECT * FROM kategori ORDER BY nmkat");
										$jsArray = "var pel = new Array();\n";
										while ($row = mysql_fetch_array($q5)) {
											if ($data2['idkat'] == "$row[idkat]") {
												$sel = "selected";
											} else {
												$sel = "";
											}
										?>
											<option value="<?= $row['idkat'] ?>" <?= $sel ?>><?= $row['nmkat'] ?></option>
										<?php
											$jsArray .= "pel['" . $row['idkat'] . "'] = {name:'" . addslashes($row['nmkat']) . "',desc:'" . addslashes($row['persen']) . "'};\n";
										} ?>
									</select>

									<script type="text/javascript">
										<?php echo $jsArray; ?>

										function changeValue2(id) {
											document.getElementById('persen').value = pel[id].desc;
											var hb = parseInt($("#hb").val());
											$("#hj").val(hb + (hb * (pel[id].desc / 100)));
											$("#hj2").val(hb + (hb * (pel[id].desc / 100)));
											$("#hg").val(hb + (hb * (pel[id].desc / 100)));
											$("#hg2").val(hb + (hb * (pel[id].desc / 100)));

										};
									</script>

								</div>
							</div>
							<div class="form-group row">
								<label for="persen" class="col-sm-2 col-form-label">Persentase Keuntungan <i>%</i></label>
								<div class="col-sm-10">
									<input readonly=readonly class='form-control' type="text" name='persen' id="persen" />
								</div>
							</div>

							<div class="form-group row">
								<label for="hj" class="col-sm-2 col-form-label">Harga Jual</label>
								<div class="col-sm-10">
									<input class='form-control' name='hj' value="<?php echo $data2['harga_jual']; ?>" type="text" id="hj" />
									<input class='form-control' value="<?php echo $data2['harga_jual']; ?>" type="hidden" id="hj2" />
								</div>
							</div>

							<!-- <div class="form-group row">
								<label class="col-sm-2 col-form-label">Level Harga</label>
								<div class="col-sm-10">
									<table>
										<tr>
											<td>Dari</td>
											<td>Sampai</td>
											<td>Harga</td>
											<td>Aksi</td>
										</tr>
										<tr>
											<td><input class='form-control' placeholder='dari' id='dari' type='text' width='10px' /></td>
											<td><input class='form-control' placeholder='sampai' type='text' id='sampai' width='10px' /></td>
											<td><input class='form-control' type='text' placeholder='harga' id='hglevel' width='10px' /><input class='form-control' type='hidden' placeholder='harga' id='hglevel2' name='hglevel' width='10px' /></td>
											<td><input class='btn btn-primary' type='button' value='tambah' id='tambahlevel' /></td>
										</tr>
									</table><br />
									<div id='isi'></div>
								</div>
							</div> -->

							<div class="form-group row">
								<label for="s_awal" class="col-sm-2 col-form-label">Stok Sisa</label>
								<div class="col-sm-10">
									<input class='form-control' type="text" name='s_awal' id="s_awal" value="<?php echo $data2['stok_sisa']; ?>" />
								</div>
							</div>
							
							<div class="form-group row">
								<label for="disk" class="col-sm-2 col-form-label">Diskon</label>
								<div class="col-sm-10">
									<input class='form-control' type="text" name='disk' id="disk" value="<?php echo $data2['diskon']; ?>" />
								</div>
							</div>

							<div class="form-group row">
								<label for="tgl" class="col-sm-2 col-form-label">Tanggal Terakhir Masuk</label>
								<div class="col-sm-10">
									<input class='form-control' type="date" id="tgl" name='tgl' class="datepicker" value="<?php echo $data2['tanggal']; ?>" />
								</div>
							</div>
						</div>
						<div class="card-footer">
							<button type='submit' id="edit1" class="btn btn-primary">Simpan</button>
							<a href="index.php?page=barang&action=view" class="btn btn-default float-right">Cancel</a>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</section>