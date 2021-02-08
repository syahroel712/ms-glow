<?php
session_start();
include"koneksi.php";
if(@$_SESSION['admin']) {
	$kode_user = @$_SESSION['admin'];
} else if(@$_SESSION['kasir']) {
	$kode_user = @$_SESSION['kasir'];
}
$brg=mysql_query("select * from tb_barang where kode_barang='$_POST[kodebarang]'");
if(mysql_num_rows($brg)>0){
	$cr=mysql_query("select * from beli_tmp where kode_barang='$_POST[kodebarang]' and id_user='$kode_user'");
	if(mysql_num_rows($cr)>0){
		$rcr=mysql_fetch_array($cr);

?>
<script type="text/javascript">
		alert("Duplikat data");
$("#kodebarang").focus();
</script>
<?php
		//mysql_query("update beli_tmp set qty=qty+$_POST[jml],hrg='$_POST[hrg]' where id_beli_tmp='$rcr[id_beli_tmp]'");
	}else{
		mysql_query("insert into beli_tmp values('','$kode_user','$_POST[kodebarang]','$_POST[hrg]','$_POST[jml]','$_POST[dc]')");
	}
	
}else{
?>
<script type="text/javascript">
		alert("Kode barang tidak ditemukan");
</script>
<?php
}
?>
<script type="text/javascript">
			//alert("Kode barang kosong");
	$("#dc").val("");
	$("#hargaakhir").val("");
	$("#batalitem").click();
	$('#isi').load("inc/tmp_beli.php");
</script>