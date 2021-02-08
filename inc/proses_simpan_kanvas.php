
<?php
include "koneksi.php";

$nonota = @mysql_real_escape_string($_POST['nonota']);
$tgljual = @mysql_real_escape_string($_POST['tgljual']);
$pelanggan = @mysql_real_escape_string($_POST['pelanggan']);
$kasir = @mysql_real_escape_string($_POST['kasir']);
$subtotal = @mysql_real_escape_string($_POST['subtotal']);
$diskonpersen = @mysql_real_escape_string($_POST['diskonpersen']);
$diskonharga = @mysql_real_escape_string($_POST['diskonharga']);
$ppn = @mysql_real_escape_string($_POST['ppn']);
$totalharga = @mysql_real_escape_string($_POST['totalharga']);
$jns = @mysql_real_escape_string($_POST['jns']);
$bayar = @mysql_real_escape_string($_POST['bayar']);
$kembalian = @mysql_real_escape_string($_POST['kembalian']);
$nm = @mysql_real_escape_string($_POST['nm']);
$kode_user = @mysql_real_escape_string($_POST['kode_user']);

mysql_query("insert into tb_kanvas values('$nonota', now(), '$kasir', '$totalharga', '$diskonpersen', '$ppn', '$nm','$kode_user')") or die(mysql_error());

//mysql_query("insert into tb_kas values('','Pembelian','Pengeluaran','$tgljual', '','$totalharga')") or die(mysql_error());



?>