<?php
/** if ($_POST['tahun'] != "") {
	$thn = "$_POST[tahun]";
	if ($_POST['bln'] != "") {
		$bln = "$_POST[bln]";
		if ($_POST['tgl'] != "") {
			$tgl = "$_POST[tgl]";
		}
	}
} **/

if ($_POST['tahun'] != "") {
	$thn = "$_POST[tahun]";
}
if ($_POST['bln'] != "") {
	$bln = "$_POST[bln]";	
}
if ($_POST['tgl'] != "") {
	$tgl2 = "$_POST[tgl]";
}

date_default_timezone_set('Asia/Jakarta');
$thn_skr = date('Y');

?>

<div class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1 class="m-0 text-dark">Kas</h1>
			</div><!-- /.col -->
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="#">Home</a></li>
					<li class="breadcrumb-item active">Kas</li>
				</ol>
			</div><!-- /.col -->
		</div><!-- /.row -->
	</div><!-- /.container-fluid -->
</div>

<?php
if ($_GET['action'] == 'inputpenerimaan') {
	include "tambah_kas_penerimaan.php";
} else if ($_GET['action'] == 'inputpengeluaran') {
	include "tambah_kas_pengeluaran.php";
} else if ($_GET['action'] == 'view') {
?>

	<section class="content">
		<div class="container-fluid">
			<!-- Small boxes (Stat box) -->
			<div class="row">
				<div class="col-lg-12">
					<div class="card">

						<div class="card-header">
							<h3 class="card-title">
								Data Kas
							</h3>
						</div>
						<div class="card-body">
							<a href='?page=kas&action=inputpenerimaan' class='btn btn-primary shadow'><span class='fa fa-plus'></span> Input Penerimaan</a>
							<a href='?page=kas&action=inputpengeluaran' class='btn btn-primary shadow'><span class='fa fa-plus'></span> Input Pengeluaran</a>
							<a href='inc/kas/cetaklapkas.php?tahun=<?= $thn ?>&bln=<?= $bln ?>&tgl=<?= $tgl2 ?>' target='_blank' class='btn btn-success shadow'><span class='fa fa-print'></span> Cetak Keseluruhan</a>
							<a href='inc/kas/cetaklapkas_akhir.php?tahun=<?= $thn ?>&bln=<?= $bln ?>&tgl=<?= $tgl2 ?>' target='_blank' class='btn btn-info shadow'><span class='fa fa-print'></span> Cetak Akhir</a>


							<div class="row pt-4 pb-2">
								<div class="table-responsive-sm">
									<form action="" method="post" class="form-inline">
										<div class='form-group mx-sm-3 mb-2'>
											<label> Tanggal : </label>
											<select name='tgl' class='form-control ml-4'>
												<option value=''>Pilih</option>
												<?php
												for ($h = 1; $h <= 31; $h++) { ?>
													<option value="<?= $h ?>"><?= $h ?></option>
												<?php
												}
												?>
											</select>
										</div>

										<div class='form-group mx-sm-3 mb-2'>
											<label>Bulan : </label>
											<select name='bln' class='form-control ml-4'>
												<option value=''>Pilih</option>
												<?php
												$nmbulan = array("", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
												for ($b = 1; $b <= 12; $b++) { ?>
													<option value="<?= $b ?>"><?= $nmbulan[$b] ?></option>
												<?php
												}
												?>
											</select>
										</div>

										<div class="form-group mx-sm-3 mb-2">
											<label>Tahun :</label>
											<select name="tahun" class="form-control ml-4">
												<option value="">Pilih</option>
												<?php
												for ($t = 2015; $t <= $thn_skr; $t++) {
												?>
													<option value="<?= $t ?>"><?= $t ?></option>
												<?php
												}
												?>
											</select>
										</div>

										<div class="form-group mx-sm-3 mb-2 ml-4">
											<button type='submit' value='Cari' class="btn btn-danger shadow"><span class='fa fa-search'></span> Cari</button>
										</div>
									</form>
								</div>
							</div>

							<div class="table-responsive-sm">
								<table id="example2" class="table table-bordered">
									<thead>
										<tr>
											<th>No</th>
											<th>Tanggal</th>
											<th>Uraian</th>
											<th colspan="2">Pemasukan</th>
											<th colspan="2">Pengeluaran</th>
											<th colspan="2">Saldo</th>
											<th>Opsi</th>
										</tr>
									</thead>
									<tbody id="laporan_keuangan">
										<?php
										if ($_POST['tahun'] != "") {
											if ($_POST['bln'] != "") {
												$qbln = "and month(tgl) = '$_POST[bln]'";
												if ($_POST['tgl'] != "") {
													$qtgl = "and day(tgl) = '$_POST[tgl]'";
												}
											}
											$qthn = "where year(tgl)='$_POST[tahun]' $qbln $qtgl";
										}
										$i = 1;
										$sql = mysql_query("SELECT * FROM tb_kas $qthn ORDER BY tgl ASC");
										$cek = mysql_num_rows($sql);
										if ($cek < 1) {
										?>
											<tr>
												<td colspan="10" class="p-3">Kas tidak ditemukan</td>
											</tr>
											<?php
										} else {
											$no = 1;
											while ($data = mysql_fetch_array($sql)) {
												if ($data['jenis'] == "Pengeluaran") {
													$sub_tot1 = $sub_tot1 - $data['kredit'];
												} else {
													$sub_tot1 = $sub_tot1 + $data['debit'];
												}

												$tdebit = $tdebit + $data['debit'];
												$tkredit = $tkredit + $data['kredit'];
												$tot_semua = $sub_tot1 + $total;

												$subtot = $subtot + $sub_tot1;
											?>

												<tr>
													<td><?= $no; ?></td>
													<td><?= $data['tgl']; ?></td>
													<td><?= $data['ket']; ?></td>
													<td style="border-right: 0;">
														<?php if ($data['debit'] != "" and $data['debit'] != 0) {
															echo "Rp.";
														}
														?>
													</td>
													<td align="right" style="border-left:0;">
														<?php if ($data['debit'] != "" and $data['debit'] != 0) {
															echo number_format($data['debit'], 2, ".", ",");
														}
														?>
													</td>

													<td style="border-right: 0;">
														<?php if ($data['jmlhkredit'] != "" and $data['kredit'] != 0) {
															echo "Rp.";
														}
														?>
													</td>
													<td align="right" style="border-left:0;">
														<?php if ($data['kredit'] != "" and $data['kredit'] != 0) {
															echo number_format($data['kredit'], 2, ".", ",");
														}
														?>
													</td>

													<td style="border-right: 0;">Rp. </td>
													<td align="right" style="border-left:0;">
														<?= number_format($tot_semua, 2, ".", ","); ?></td>
													<td>
														<a href="?page=kas&action=edit&id=<?php echo $data['idkas']; ?>" class="btn btn-warning shadow">Edit</a>
														<a onclick="return confirm('Yakin ingin menghapus data ?');" href="?page=kas&action=hapus&id=<?php echo $data['idkas']; ?>" class="btn btn-danger shadow">Hapus</a>
													</td>
												</tr>

												</tr>
											<?php
												$no++;
												$totjum += $tot['jml'];
												$toth += $data['total_harga'];
												$totb += $data['bayar'];
												$totk = $data['bayar'] - $data['total_harga'];
												$totakh += $totk;
											}
											?>

										<?php } ?>
									</tbody>
									<tr>
										<td colspan=3><b>TOTAL</b></td>
										<td style="border-right: 0;">Rp. </td>
										<td align="right" style="border-left:0;"><?= number_format($tdebit + $data2[masuk], 2, ".", ","); ?></td>
										<td style="border-right: 0;">Rp. </td>
										<td align="right" style="border-left:0;"><?= number_format($tkredit + $data2[keluar], 2, ".", ","); ?></td>
										<td style="border-right: 0;">Rp. </td>
										<td align="right" style="border-left:0;"><?= number_format($tot_semua, 2, ".", ","); ?></td>
										<td></td>
									</tr>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

<?php
} else if ($_GET['action'] == 'edit') {
	include "edit_kas.php";
} else if ($_GET['action'] == "hapus") {
	include "delete_kas.php";
}
?>