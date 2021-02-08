<?php
$BulanIndo = array("", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");

$tgl = date("Y-m-d");
$bln = date('m');
$thn = date('Y');

if ($_POST['th'] != "") {
	$where = "and (month(p.tgl_jual)>='$_POST[dari]' and month(p.tgl_jual)<='$_POST[sampai]') and year(tgl_jual)='$_POST[th]'";
	$ket = "Dari bulan : " . getBulan($_POST[dari]) . " s/d " . getBulan($_POST[sampai]) . " $_POST[th]";
} else {
	$where = "and month(p.tgl_jual)='$bln' and year(p.tgl_jual)='$thn'";
	$ket = "Bulan ini";
}
?>

<!-- Content Header (Page header) -->
<div class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1 class="m-0 text-dark">Laporan Penjualan</h1>
			</div><!-- /.col -->
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="#">Home</a></li>
					<li class="breadcrumb-item active">Laporan Penjualan</li>
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
						<h3 class="card-title">Laporan Perbulan (<b> <?php echo "$ket"; ?> </b>)</h3>
					</div>
					<div class="card-body">
						<div class="row">
							<form action="" method="post" class="form-inline">
								<div class="form-group mx-sm-3 mb-2">
									<label>Dari :</label>
									<div class="input-group ml-3">
										<div class="input-group-prepend">
											<span class="input-group-text">
												<i class="far fa-calendar-alt"></i>
											</span>
										</div>
										<select name='dari' class="form-control">
											<option value="">- Pilih Bulan -</option>
											<?php
											for ($b = 1; $b <= 12; $b++) {
												echo "<option value='$b'>" . getBulan($b) . "</option>";
											}
											?>
										</select>
									</div>
								</div>
								<div class="form-group mx-sm-3 mb-2">
									<label>Sampai :</label>
									<div class="input-group ml-3">
										<div class="input-group-prepend">
											<span class="input-group-text">
												<i class="far fa-calendar-alt"></i>
											</span>
										</div>
										<select name='sampai' class="form-control">
											<option value="">- Pilih Bulan -</option>
											<?php
											for ($b2 = 1; $b2 <= 12; $b2++) {
												echo "<option value='$b2'>" . getBulan($b2) . "</option>";
											}
											?>
										</select>
									</div>
								</div>
								<div class="form-group mx-sm-3 mb-2">
									<label>Tahun :</label>
									<div class="input-group ml-3">
										<div class="input-group-prepend">
											<span class="input-group-text">
												<i class="far fa-calendar-alt"></i>
											</span>
										</div>
										<select name='th' class="form-control">
											<option value="">- Pilih Tahun -</option>
											<?php
											for ($t = 2017; $t <= $thn; $t++) {
												echo "<option value='$t'>$t</option>";
											}
											?>
										</select>
									</div>
								</div>

								<div class="form-group mx-sm-3 mb-2 ml-3">
									<label>&nbsp;</label>
									<div class="input-group ml-3">
										<div class="input-group-prepend">
											<button type="submit" name="cari" class="btn btn-danger shadow mr-2"><i class="fa fa-search"></i> Cari</button>
											<a href="inc/laporan/cetakperbulan.php?th=<?php echo "$_POST[th]"; ?>&dari=<?php echo "$_POST[dari]"; ?>&sampai=<?php echo "$_POST[sampai]"; ?>" target="_Blank" class="btn btn-success shadow"><i class="fa fa-print"></i> Cetak</a>
										</div>
									</div>
								</div>
							</form>
						</div>

						<div class="container mt-4">
							<div class="table-responsive-sm">
								<table id="example1" class="table table-bordered">
									<thead>
										<tr>
											<th>No</th>
											<th>Tanggal</th>
											<th>Nota</th>
											<th>Kasir</th>
											<th>Modal</th>
											<th>Total Harga</th>
											<th>Pendapatan</th>
										</tr>
									</thead>
									<tbody id="penjualan">
										<?php
										$sql = mysql_query("SELECT *,date(p.tgl_jual)as tgl,month(p.tgl_jual)as bln,year(p.tgl_jual)as thn,sum(d.modal*d.jumlah_jual)as modal2,sum(d.harga_satuan*d.jumlah_jual)as pend from tb_penjualan p,tb_barang_terjual d where p.no_nota=d.no_nota $where group by p.no_nota") or die(mysql_error());
										$cek = mysql_num_rows($sql);
										if ($cek < 1) {
										?>
											<tr>
												<td colspan="13" style="padding:10px;">Data tidak ditemukan</td>
											</tr>
											<?php
										} else {
											$no = 1;
											while ($data = mysql_fetch_array($sql)) {
											?>
												<tr>
													<td><?php echo "$no"; ?></td>
													<td><?php echo $data['tgl']; ?></td>
													<td><?php echo $data['no_nota']; ?></td>
													<td><?php echo $data['kasir']; ?></td>
													<td align="right" style="border-left:0;"><?php echo number_format($data['modal2'], 0, ".", ","); ?></td>
													<td align="right" style="border-left:0;"><?php echo number_format($data['pend'], 0, ".", ","); ?></td>
													<td align="right" style="border-left:0;"><?php echo number_format($data['pend'] - $data['modal2'], 0); ?></td>

												</tr>
										<?php
												$tot1 = $tot1 + $data['modal2'];
												$tot2 = $tot2 + $data['pend'];
												$no++;
											}
										}
										?>
									</tbody>
									<tr>
										<td colspan=4><b>TOTAL</b></td>
										<td align='right'><b><?= number_format($tot1, 0) ?></b></td>
										<td align='right'><b><?= number_format($tot2, 0) ?></b></td>
										<td align='right'><b><?= number_format($tot2 - $tot1, 0) ?></b></td>
									</tr>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>