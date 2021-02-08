<?php
include "koneksi.php";
$kd_brg = @mysql_real_escape_string($_POST['kd_brg']);
$dari = @mysql_real_escape_string($_POST['dari']);
$sampai = @mysql_real_escape_string($_POST['sampai']);
$hglevel = @mysql_real_escape_string($_POST['hglevel']);

$simpan=mysql_query("insert into tb_level values('', '$kd_brg','$dari', '$sampai', '$hglevel')") or die (mysql_error());

if($simpan){
?>
<script>
alert("Penambahan data level sukses");
//window.location.href='?page=barang&action=view';

$("#dari").val("");
$("#sampai").val("");
$("#hglevel").val("");
$("#isi").load("inc/isi_level.php?kode=<?php echo"$kd_brg"; ?>");
</script>
<?php
}else{
?>
<script>
alert("Gagal menambah level");
//window.location.href='?page=barang&action=view';
$("#dari").val("");
$("#sampai").val("");
$("#hglevel").val("");
</script>
<?php
}
?>