<?php
include "koneksi.php";
$id = $_GET['id'];
mysql_query("DELETE FROM tb_satuan WHERE id_satuan='$id'");
echo "<script>alert('Data Berhasil Di Hapus')
			window.location='?page=data_satuan'</script>";
