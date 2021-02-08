<?php
include "koneksi.php";
$kode_barang = $_SESSION['kode_barang_terpilih'];
$nama_satuan = @mysql_real_escape_string($_POST['nama_satuan']);
$harga_satuan = @mysql_real_escape_string($_POST['harga_satuan']);
$konversi_stok = @mysql_real_escape_string($_POST['konversi_stok']);

$simpan = mysql_query("insert into tb_satuan values('','$kode_barang', '$nama_satuan', '$harga_satuan','$konversi_stok')") or die(mysql_error());

if ($simpan) {
?>
    <script>
        alert("Penambahan data satuan sukses");
        window.location.href = "?page=lihat_satuan&kode_barang=<?= $kode_barang ?>";
    </script>
<?php
} else {
?>
    <script>
        alert("Gagal menambah satuan");
        window.location.href = '?page=input_satuan';
    </script>
<?php
}
?>