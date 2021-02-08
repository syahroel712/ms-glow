<table class='table table-bordered'>
	<tr>
		<th>Level</th>
		<th>Dari</th>
		<th>Sampai</th>
		<th colspan=2>Harga</th>
		<th>Aksi</th>
	</tr>
	<?php
	session_start();
	error_reporting(0);
	include "koneksi.php";
	if ($_SESSION['admin']) {
		$kode_user = $_SESSION['admin'];
	} else if ($_SESSION['kasir']) {
		$kode_user = $_SESSION['kasir'];
	}
	$qi = mysql_query("select * from tb_level where kode_barang='$_GET[kode]' order by hrg asc");
	$no = 1;
	while ($item = mysql_fetch_array($qi)) {
		$hs = $item['hrg'];
		echo "
				<tr>
					<td>$no</td>
					<td><span id='dari-$no'>$item[dari]</span></td>
					<td><span id='sampai-$no'>$item[sampai]</span></td>
					<td>Rp.</td>
					<td><span id='hglevel-$no'>" . $hs . "</span></td>
					<td>
					";
	?>
		<a href="inc/hapus_level.php?id=<?php echo "$item[id_level]"; ?>&kode=<?php echo "$_GET[kode]"; ?>">
			<button class='btn btn-danger btn-xs' title='Delete Data'><span class='fa fa-trash-alt'></span></button>
		</a>
	<?php
		echo "</td>
				</tr>
				";
		$no++;
	}
	?>
</table>
<script type="text/javascript">
	$(function() {

		$('#isi a').click(function() {
			var url = $(this).attr('href');
			$('#hasil_edit').load(url);
			$('#isi').load("inc/isi_level.php");
			return false;
		});
	});
</script>