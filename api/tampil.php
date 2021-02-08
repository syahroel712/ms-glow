

<?php
require_once('koneksi.php');
$kode = $_POST['kode'];
class emp
{
}

$data = mysqli_query($con, "SELECT * FROM `tb_barang` WHERE `kode_barang`='$kode'");
// $response = array();

if (mysqli_num_rows($data) > 0) {


    $z = mysqli_fetch_array($data);
    $response = new emp();
    $response->sisa = $z['stok_sisa'];
    $response->nama = $z['nama_barang'];
    $response->cod = 1;
    die(json_encode($response));
    // $h['sisa'] = $z['stok_sisa'];
    // $h['nama'] = $z['nama_barang'];
} else {
    $response = new emp();
    $response->response = "Gagal! Membuat Pesanan";
    $response->cod = 0;
    die(json_encode($response));
}

// array_push($response, $h);
// echo strip_tags(json_encode($response));
