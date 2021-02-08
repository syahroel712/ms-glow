<?php
include "koneksi.php";

$nonota = mysql_real_escape_string($_POST['nonota']);
$tgljual = mysql_real_escape_string($_POST['tgljual']);
$pelanggan = mysql_real_escape_string($_POST['pelanggan']);
$kasir = mysql_real_escape_string($_POST['kasir']);
$subtotal = mysql_real_escape_string($_POST['subtotal']);
$diskonpersen = mysql_real_escape_string($_POST['diskonpersen']);
$diskonharga = mysql_real_escape_string($_POST['diskonharga']);
$totalharga = mysql_real_escape_string($_POST['totalharga']);
$jns = mysql_real_escape_string($_POST['jns']);
$bayar = mysql_real_escape_string($_POST['bayar']);
$kembalian = mysql_real_escape_string($_POST['kembalian']);
$kodeuser = mysql_real_escape_string($_POST['kode_user']);
$pembayaran = mysql_real_escape_string($_POST['pembayaran']);

mysql_query("INSERT INTO tb_penjualan VALUES ('$nonota', NOW(), '$pelanggan', '$kasir', '$subtotal', '$diskonpersen', '$diskonharga', '$totalharga','$bayar','$kembalian','$kodeuser', '$pembayaran')");

mysql_query("insert into tb_kas values('','Penjualan','Pendapatan','$tgljual', '$totalharga','')") or die(mysql_error());
