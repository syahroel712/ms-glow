

<?php
require_once('koneksi.php');
$tgl = date('Y-m-d H:i:s');
$kode = $_POST['kode'];
$input = $_POST['input'];

$data = mysqli_query($con, "SELECT * FROM `tb_barang` WHERE `kode_barang`='$kode'");
if (mysqli_num_rows($data) > 0) {
    $response = array();

    $z = mysqli_fetch_array($data);
    $h['sisa'] = $z['stok_sisa'];
    $h['nama'] = $z['nama_barang'];
    $sisa = $h['sisa'];
    mysqli_query($con, "UPDATE tb_barang SET stok_sisa='$input' WHERE kode_barang='$kode'");
    $selisih = $input - $sisa;


    $query = mysqli_query($con, "INSERT INTO tb_so (tgl_input, kode_barang, stok_sisa, stok_input, selisih) VALUES ('$tgl', '$kode', '$sisa', '$input', '$selisih')");


    array_push($response, $h);
    echo strip_tags(json_encode($response));
}
