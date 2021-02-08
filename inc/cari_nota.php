<?php
include "koneksi.php";
$cek=mysql_query("select * from tb_pembelian where nota='$_POST[nonota]'");
if(mysql_num_rows($cek)>0){
?>
<script>
	alert("No.Nota Pembelian Sudah Ada");
	$("#nonota").val("");
	$("#nonota").focus();
</script>
<?php
}
?>