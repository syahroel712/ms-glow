<?php

echo"
<a href='inc/cetaklapmemberexpired.php' target='_blank'><button class=\"btn btn-warning btn-sm\">Cetak</button></a>";

?>
<div style="margin-top:10px;">
<?php
	date_default_timezone_set('Asia/Jakarta');
	$thn_skr=date('Y');

if(@$_GET['action'] == 'view')
{
	?>
	<title>Laporan Member Expired</title>
    <fieldset class="utama">
    <legend>Laporan Member Expired</legend>
  	<?php
		
		$nmbulan=array("","Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
	if($_POST[tahun]!="" and $_POST[bln]!=""){
	$thn_1="$_POST[tahun]";
	$bln_1="$_POST[bln]";
	$where="where month(tgl_daftar)='$_POST[bln]' and year(tgl_daftar)='$_POST[tahun]'";
	}else{
	$thn_1=date('Y');
	$bln_1=date('m');
	$where="where month(tgl_daftar)='$bln_1' and year(tgl_daftar)='$thn_1'";
	}
?>
	</form>
	<p>Member Expired Bulan : <?php echo"$bln_1-$thn_1"; ?></p>
        <table id="example1" class="table table-bordered table-striped">
        <thead>
        <tr>
        	<th>No</th>
        	<th>Id Member</th>
        	<th>Nama</th>
            <th>Jenis Kelamin</th>
            <th>Alamat </th>
            <th>No.Telp </th>
            <th>Tgl Daftar </th>
            <th>Tgl Expired </th>
            <th>Expired </th>
            
        </tr>
        </thead>
        <tbody id="laporan_keuangan">
        <?php
		if($_POST[tahun]!=""){
			if($_POST[bln]!=""){
				$qbln="and month(tgl_daftar) = '$_POST[bln]'";
				if($_POST[tgl]!=""){
				$qtgl="and day(tgl_daftar) = '$_POST[tgl]'";
				}
			}
			$qthn="where year(tgl_daftar)='$_POST[tahun]' $qbln $qtgl";
		}

		$sql = mysql_query("select *,TIMESTAMPDIFF(MONTH,tgl_diperbarui,now())as selisih from tb_member order by tgl_diperbarui asc") or die (mysql_error());
		$cek = mysql_num_rows($sql);
		if($cek < 1)
		{
			?>
            <tr>
            	<td colspan="9" style="padding:10px;">Member tidak ditemukan</td>
            </tr>
            <?php
		}
		else
		{
		$no=1;
			while($data = mysql_fetch_array($sql))
			{
			if($data['selisih']>0){
			$style="style='background-color:red;color:#fff;'";
			$ex="$data[selisih] Bulan yang lalu";
			}elseif($data['selisih']==0){
			$style="style='background-color:yellow;'";
			$ex="Bulan ini";
			}else{
			$style="";
			$ex="-";
			}
			?>
			<tr>
				<td <?php echo"$style"; ?>><?php echo $no; ?></td>
				<td <?php echo"$style"; ?>><?php echo $data[id_member]; ?></td>
				<td <?php echo"$style"; ?>><?php echo $data[nm]; ?></td>
				<td <?php echo"$style"; ?>><?php echo $data[jk]; ?></td>
				<td <?php echo"$style"; ?>><?php echo $data[almt]; ?></td>
				<td <?php echo"$style"; ?>><?php echo $data[notelp]; ?></td>
				<td <?php echo"$style"; ?>><?php echo tgl_indo($data[tgl_daftar]); ?></td>
				<td <?php echo"$style"; ?>><?php echo tgl_indo($data[tgl_diperbarui]); ?></td>
				<td <?php echo"$style"; ?>><?php echo"$ex"; ?></td>
					
			</tr>
			<?php
			$no++;
			}
			
		}
		?>
        </tbody>
		</table>
    </fieldset>
    <script>
	function cari() {
		var masukan = $("#pencarianlaporan_keuangan").val();
		var tgl = $("#cari_laporan_keuangan_dgn_tgl").val();
		$.ajax({
			data : 'masukanpencarian='+masukan+'&tglpencarian='+tgl,
			type : 'post',
			url : 'inc/proses_cari_laporan_keuangan.php',
			success : function(msg){
				$("tbody#laporan_keuangan").html(msg);
			} 
		});
	};
	
	$("#carilaporan_keuangan").click(function(){
		cari();
	});
	$("#pencarianlaporan_keuangan").keyup(function(e){
		if(e.keyCode == 13) {
			cari();
		}
	});
	</script>
    <?php
}
else if(@$_GET['action'] == 'edit')
{
	include "edit_kas.php";
}
else if(@$_GET['action'] == "hapus")
{
	include "delete_kas.php";
}
?>
</div>
	