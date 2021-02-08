<?php
 //menggunakan class phpExcelReader
 include "excel_reader2.php";
 
//koneksi ke db mysql
 include_once("inc/koneksi.php");
 
//membaca file excel yang diupload
 $data = new Spreadsheet_Excel_Reader($_FILES['userfile']['tmp_name']);
 //membaca jumlah baris dari data excel
 $baris = $data->rowcount($sheet_index=0);
 
//nilai awal counter jumlah data yang sukses dan yang gagal diimport
 $sukses = 0;
 $gagal = 0;
 
//import data excel dari baris kedua, karena baris pertama adalah nama kolom
 for ($i=2; $i<= $baris; $i++) {
 //membaca data kode (kolom ke-2)
 $kode = $data->val($i,1);
 
 //membaca data nama barang
 $namabarang = $data->val($i,2);
 //membaca data brand
 $satuan = $data->val($i,3);
 //membaca data lengan
 $hargajual = $data->val($i,4);
 //membaca data warna
 $hargabeli = $data->val($i,5);
 //membaca data ukuran
 $stokawal = $data->val($i,6);
 //membaca data harga jual
 $stokterjual = $data->val($i,7);
 //membaca data harga beli
  $stoksisa = $data->val($i,8);
 //membaca data stok awal
  $tanggal = $data->val($i,9);
   //membaca data stok awal
  $idkategori = $data->val($i,10);
   //membaca data stok awal
  $idsup = $data->val($i,11);
   //membaca data diskon
  $diskon = $data->val($i,12);
  //membaca data hpp
  $hpp = $data->val($i,13);
 
 
//setelah data dibaca, sisipkan ke dalam tabel pegawai
if ($kode!=''){
mysql_query("insert into tb_satuan values ('','$kode','$satuan','$hargajual','')") or die (mysql_error());

$id_satuan_sementara = mysql_fetch_assoc(mysql_query("SELECT LAST_INSERT_ID() AS id"));

$id_satuan = $id_satuan_sementara['id'];

 $query = "INSERT INTO tb_barang values ('$kode','$namabarang','$satuan','$hargajual','','','','$hargabeli','$stokawal','$stokterjual','$stoksisa','$tanggal','$idkategori','$idsup','$diskon','$hpp','$id_satuan')";
 $hasil = mysql_query($query);
 
//menambah counter jika berhasil atau gagal
 if($hasil) $sukses++;
 else $gagal++;
}
}
 //tampilkan report hasil import
 echo "<h4> Proses Import Data Selesai</h4>";
 echo "<p>Jumlah data sukses diimport : ".$sukses."<br><br>";
 echo "Jumlah data gagal diimport : ".$gagal."<p>";

 
?>

<a href="./" class="btn btn-warning">Kembali</a>